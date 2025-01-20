<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLevel extends Model
{
    protected $table = 'tbl_user_level';
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    protected $guarded = [];
    public $incrementing = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id')->withDefault();
    }

    public function levels(): BelongsTo
    {
        return $this->belongsTo(Levels::class, 'level_id')->withDefault();
    }
}
