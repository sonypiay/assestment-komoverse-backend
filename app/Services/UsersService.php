<?php

namespace App\Services;

use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ResponseStatusException;
use App\Http\Requests\SubmitScoreRequest;
use App\Http\Resources\HistoryScoreResource;
use App\Http\Resources\UsersResource;
use App\Repositories\UserRepository;
use App\Repositories\HistoryScoreRepository;
use Illuminate\Support\Facades\Cache;

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

    public function __construct() {
        $this->userRepository = new UserRepository;
        $this->historyScoreRepository = new HistoryScoreRepository;
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
        $cacheKey = "leaderboard";
        $page = $request->page ?? 1;

        $leaderboard = Cache::remember("{$cacheKey}_page_{$page}", 120, function() use ($request) {
            return $this->historyScoreRepository->findAll($request);
        });

        if( $request->has('username') AND ! empty( $request->username ) ) {
            $users = $this->userRepository->findByUsername($request->username);
            if( ! $users ) throw new ResponseStatusException("User not found", HttpStatus::NOT_FOUND->value);

            $leaderboard = $leaderboard->where('user_id', $users->id);
        }

        return HistoryScoreResource::collection($leaderboard);
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
            $getLastLevel = $this->historyScoreRepository->getLastLevel($request->user_id);
            $userLevel = $request->level < $getLastLevel ? $getLastLevel : $request->level;

            $submitScore = $this->historyScoreRepository->submitScore([
                'user_id' => $request->user_id,
                'level' => $userLevel,
                'score' => $request->score,
            ]);
            
            return [
                'user_id' => $submitScore->user_id,
                'score' => $submitScore->score,
                'level' => $userLevel,
            ];
        });

        return $result;
    }
}