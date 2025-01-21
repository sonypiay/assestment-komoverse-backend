<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\HistoryScore;
use App\Models\Users;

class UserRepository
{
    /**
     * @var Users $users
     */
    protected Users $users;

    /**
     * @var HistoryScore $historyCore
     */
    protected HistoryScore $historyCore;

    public function __construct() {
        $this->users = new Users;
        $this->historyCore = new HistoryScore;
    }

    /**
     * @var Illuminate\Http\Request $request
     */
    public function findAll($request): mixed
    {
        return $this->users
            ->when($request->username, fn($query) => $query->where('username', 'like', '%' . $request->username . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate($request->rows ?? 10)
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
}