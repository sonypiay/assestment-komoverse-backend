<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class UnisyncService
{
    /**
     * @var string $secretKey
     */
    private string $secretKey;

    /**
     * @var string $endpoint
     */
    private string $endpoint;

    public function __construct()
    {
        $this->secretKey = env('UNISYNC_SECRET_KEY');
        $this->endpoint = env('UNISYNC_ENDPOINT');
    }

    private function createSignature($timestamp, string $nonce)
    {
        $data = "{$nonce}{$timestamp}{$this->secretKey}";
        return hash('sha256', $data);
    }

    public function assessment()
    {
        $nonce = Str::random(8);
        $timestamp = round(microtime(true) * 1000);
        $signature = $this->createSignature($timestamp, $nonce);

        return Http::withHeaders([
            'X-Nonce' => $nonce,
            'X-API-Signature' => $signature
        ])
        ->post($this->endpoint, [
            'timestamp' => $timestamp
        ])
        ->json();
    }
}