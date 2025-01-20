<?php

namespace App\Http\Controllers;

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
            $response = $this->usersService->findAll($request);
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
