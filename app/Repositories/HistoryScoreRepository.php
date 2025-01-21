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
}