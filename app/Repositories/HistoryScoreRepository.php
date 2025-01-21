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
    public function submitScore(array $data)
    {
        return $this->historyScore->create($data);
    }

    /**
     * @var string $userId
     */
    public function getLastLevel(string $userId)
    {
        $result = $this->historyScore
            ->select('level')
            ->where('user_id', $userId)
            ->orderBy('level', 'desc')
            ->first();

        return $result ? (int) $result->level : 1;
    }

    /**
     * @var Illuminate\Http\Request $request
     */
    public function findAll($request): mixed
    {
        return $this->historyScore
            ->select([
                'user_id',
                DB::raw('MAX(score) AS highscore'),
                DB::raw('MAX(level) AS last_level'),
                DB::raw('SUM(score) AS total_score')
            ])
            ->when($request->username, fn($query) => $query->whereHas('users', fn($query) => $query->where('username', $request->username)))
            ->groupBy('user_id')
            ->orderBy('score', 'desc')
            ->paginate($request->rows ?? 10)
            ->appends($request->all());
    }
}