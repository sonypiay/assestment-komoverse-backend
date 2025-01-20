<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\SubmitScoreRequest;
use Illuminate\Http\Request;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function __construct(protected UsersService $usersService)
    {
    }

    public function findAll(Request $request)
    {
        try {
            return response()->json($this->usersService->findAll($request), HttpStatus::OK->value);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function submitScore(SubmitScoreRequest $request)
    {
        try {
            return response()->json($this->usersService->submitScore($request), HttpStatus::CREATED->value);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
