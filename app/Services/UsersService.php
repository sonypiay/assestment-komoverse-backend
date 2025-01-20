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

class UsersService
{
    /**
     * @var UserRepositoryInterface $userRepository
     * @var HistoryScoreRepository $historyScoreRepository
     */

    public function __construct(
        protected UserRepository $userRepository,
        protected HistoryScoreRepository $historyScoreRepository
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
            return $this->historyScoreRepository->submitScore($request);
        });

        return $result;
    }
}