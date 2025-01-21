<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use App\Services\UnisyncService;

class ThirdPartyController extends Controller
{
    /**
     * @var UnisyncService $unisyncService
     */
    protected UnisyncService $unisyncService;

    public function __construct()
    {
        $this->unisyncService = new UnisyncService;
    }

    public function assessment()
    {
        try {
            $response = $this->unisyncService->assessment();
            $statusCode = $response['success'] === true ? HttpStatus::OK->value : HttpStatus::BAD_REQUEST->value;
            return response()->json($response, $statusCode);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
