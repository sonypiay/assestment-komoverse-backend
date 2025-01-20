<?php

namespace App\Services;

use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ResponseStatusException;
use App\Http\Requests\SubmitScoreRequest;
use App\Http\Resources\UsersResource;
use App\Repositories\UserRepository;
use App\Repositories\HistoryScoreRepository;
use App\Repositories\LevelsRepository;

class UsersService
{
    /**
     * @var UserRepositoryInterface $userRepository
     * @var HistoryScoreRepository $historyScoreRepository
     * @var LevelsRepository $levelsRepository
     */

    public function __construct(
        protected UserRepository $userRepository,
        protected HistoryScoreRepository $historyScoreRepository,
        protected LevelsRepository $levelsRepository
    ) {}

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
     * @var App\Http\Requests\SubmitScoreRequest
     */
    public function submitScore(SubmitScoreRequest $request)
    {
        if( ! $this->userRepository->existsByUserId($request->user_id) ) {
            throw new ResponseStatusException("User not found", HttpStatus::NOT_FOUND->value);
        }

        $result = DB::transaction(function() use ($request) {
            $getTotalScore = $this->historyScoreRepository->getTotalScoreByUser($request->user_id);
            $matchLevel = $this->levelsRepository->matchLevel($request->score);
            return $this->historyScoreRepository->submitScore($request);
        });

        return $result;
    }
}