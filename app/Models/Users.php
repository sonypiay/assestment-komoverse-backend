<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Users extends Model
{
    /** @use HasFactory<\Database\Factories\UsersFactory> */
    use HasFactory;

    protected $table = "tbl_users";
    protected $primaryKey = "id";
    protected $guarded = [];
    protected $keyType = "string";
    public $incrementing = false;

    public function userLevel(): HasOne
    {
        return $this->hasOne(UserLevel::class, 'user_id', 'id')->withDefault();
    }
}
