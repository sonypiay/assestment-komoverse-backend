<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\HistoryScore;
use App\Models\Users;

class UserRepository
{
    public function __construct(
        protected Users $users,
        protected HistoryScore $historyScore
    ) {}

    /**
     * @var Illuminate\Http\Request $request
     */
    public function findAll($request): mixed
    {
        return $this->users
            ->when($request->username, fn($query) => $query->where('username', 'like', '%' . $request->username . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate($request->rows ?? 100)
            ->appends($request->all());
    }

    /**
     * @var string $userId
     */
    public function existsByUserId(string $userId): bool
    {
        return $this->users->where('id', $userId)->exists();
    }

    /**
     * @var string $userId
     */
    public function findById(string $userId)
    {
        return $this->users->find($userId);
    }

    /**
     * @var string $userId
     */
    public function getLastScore(string $userId)
    {
        $result = $this->historyScore->where('user_id', $userId)->orderBy('date_created', 'desc')->first();
        return $result ? $result->score : 0;
    }
}