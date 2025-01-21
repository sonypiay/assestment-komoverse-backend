<?php

namespace App\Services;

use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ResponseStatusException;
use App\Http\Requests\SubmitScoreRequest;
use App\Http\Resources\UsersResource;
use App\Http\Resources\ScoreLeaderboardResource;
use App\Repositories\UserRepository;
use App\Repositories\HistoryScoreRepository;
use App\Repositories\ScoreLeaderboardRepository;

class UsersService
{
    /**
     * @var UserRepository $userRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var HistoryScoreRepository $historyScoreRepository
     */
    protected HistoryScoreRepository $historyScoreRepository;

    /**
     * @var ScoreLeaderboardRepository $scoreLeaderboardRepository
     */
    protected ScoreLeaderboardRepository $scoreLeaderboardRepository;

    public function __construct() {
        $this->userRepository = new UserRepository;
        $this->historyScoreRepository = new HistoryScoreRepository;
        $this->scoreLeaderboardRepository = new ScoreLeaderboardRepository;
    }

    /**
     * @var Illuminate\Http\Request
     */
    public function findAll(Request $request)
    {
        return UsersResource::collection(
            $this->userRepository->findAll($request)
        );
    }

    /**
     * @var Illuminate\Http\Request
     */
    public function getLeaderboard(Request $request)
    {
        return ScoreLeaderboardResource::collection(
            $this->scoreLeaderboardRepository->findAll($request)
        );
    }

    /**
     * @var App\Http\Requests\SubmitScoreRequest
     */
    public function submitScore(SubmitScoreRequest $request)
    {
        if( ! $this->userRepository->existsByUserId($request->user_id) ) {
            throw new ResponseStatusException("User not found", HttpStatus::NOT_FOUND->value);
        }

        $result = DB::transaction(function() use ($request) {
            $submitScore = $this->historyScoreRepository->submitScore([
                'user_id' => $request->user_id,
                'level' => $request->level,
                'score' => $request->score,
            ]);

            $this->scoreLeaderboardRepository->saveScore(
                $request->user_id,
                $request->level,
                $request->score
            );
            
            return [
                'user_id' => $submitScore->user_id,
                'score' => $submitScore->score,
            ];
        });

        return $result;
    }
}