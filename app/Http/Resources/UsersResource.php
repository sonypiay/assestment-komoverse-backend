<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'username' => $this->username,
            'history_score' => HistoryScoreResource::collection($this->historyScore),
            'highest_score' => $this->scoreLeaderboard->score ?? 0,
        ];
    }
}
