<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Users;

class UserRepository
{
    public function __construct(protected Users $model)
    {
    }

    /**
     * @var Illuminate\Http\Request $request
     */
    public function findAll($request): mixed
    {
        return $this->model
            ->when($request->username, fn($query) => $query->where('username', 'like', '%' . $request->username . '%'))
            ->when($request->name, fn($query) => $query->where(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', '%' . $request->name . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate($request->rows ?? 100)
            ->appends($request->all());
    }
}