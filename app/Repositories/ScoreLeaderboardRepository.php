<?php

namespace App\Repositories;

use App\Models\ScoreLeaderboard;

class ScoreLeaderboardRepository
{
    /**
     * @var ScoreLeaderboard $scoreLeaderboard
     */
    protected ScoreLeaderboard $scoreLeaderboard;

    public function __construct()
    {
        $this->scoreLeaderboard = new ScoreLeaderboard;
    }

    /**
     * @var string $userId
     * @var int $level
     * @var int $score
     */
    public function saveScore(string $userId, int $level, int $score)
    {
        $model = $this->scoreLeaderboard
            ->where('user_id', $userId)
            ->where('level', $level);

        if( $model->exists() ) {
            $leaderBoard = $model->first();
            $leaderBoard->score = $score > $leaderBoard->score ? $score : $leaderBoard->score;
        } else {
            $leaderBoard = $this->scoreLeaderboard;
            $leaderBoard->user_id = $userId;
            $leaderBoard->score = $score;
        }

        $leaderBoard->level = $level;
        return $leaderBoard->save();
    }

    /**
     * @var Illuminate\Http\Request $request
     */
    public function findAll($request): mixed
    {
        return $this->scoreLeaderboard
            ->when($request->username, fn($query) => $query->where('username', 'like', '%' . $request->username . '%'))
            ->orderBy('score', 'desc')
            ->paginate($request->rows ?? 10)
            ->appends($request->all());
    }
}