<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\HistoryScore;

class HistoryScoreRepository
{
    /**
     * @var HistoryScore $historyScore
     */
    protected HistoryScore $historyScore;

    public function __construct()
    {
        $this->historyScore = new HistoryScore;
    }

    /**
     * @var Illuminate\Http\Request
     */
    public function submitScore($request)
    {
        return $this->historyScore->create([
            'user_id' => $request->user_id,
            'score' => $request->score,
        ]);
    }

    /**
     * @var string userId
     */
    public function getTotalScoreByUser(string $userId)
    {
        return $this->historyScore
            ->select([
                DB::raw("SUM(score) AS total_score")
            ])
            ->where('user_id', $userId)
            ->first();
    }
}