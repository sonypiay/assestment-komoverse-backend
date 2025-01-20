<?php

namespace App\Repositories;

use App\Models\Levels;

class LevelsRepository
{
    /**
     * @var Levels $levels
     */
    protected Levels $levels;

    public function __construct()
    {
        $this->levels = new Levels;
    }

    public function findById(string $levelId)
    {
        return $this->levels->find($levelId);
    }

    public function matchLevel(int $score)
    {
        $result = $this->levels->whereRaw("{$score} BETWEEN min_score AND max_score")->first();
        if( $result ) return $result;

        $result = $this->levels->whereRaw("{$score} >= max_score")->first();
        return $result;
    }
}