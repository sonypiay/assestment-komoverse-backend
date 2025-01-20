<?php

namespace App\Repositories;

use App\Models\HistoryScore;

class HistoryScoreRepository
{
    /**
     * @var HistoryScore $model
     */
    public function __construct(protected HistoryScore $model)
    {
    }

    /**
     * @var Illuminate\Http\Request
     */
    public function submitScore($request)
    {
        return $this->model->create([
            'user_id' => $request->user_id,
            'score' => $request->score,
            'level' => $request->level,
        ]);
    }
}