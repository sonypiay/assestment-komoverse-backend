<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;

class UsersService
{
    /**
     * @var UserRepositoryInterface $userRepository
     */

    public function __construct(
        protected UserRepository $userRepository
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
}