<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\SubmitScoreRequest;
use Illuminate\Http\Request;
use App\Services\UsersService;

class UsersController extends Controller
{
    /**
     * @var UsersService $usersService
     */
    protected UsersService $usersService;

    public function __construct()
    {
        $this->usersService = new UsersService;
    }

    public function findAll(Request $request)
    {
        try {
            $response = [
                'data' => $this->usersService->findAll($request),
                'message' => 'OK',
            ];

            return response()->json($response, HttpStatus::OK->value);
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

    public function getLeaderboard(Request $request)
    {
        try {
            $response = [
                'data' => $this->usersService->getLeaderboard($request),
                'message' => 'OK',
            ];
            return response()->json($response, HttpStatus::OK->value);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
