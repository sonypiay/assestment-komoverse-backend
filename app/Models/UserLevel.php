<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLevel extends Model
{
    /** @use HasFactory<\Database\Factories\UserLevelFactory> */
    use HasFactory;

    protected $table = "tbl_user_level";
    protected $primaryKey = ["user_id", "level"];
    protected $guarded = [];
    public $incrementing = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'id')->withDefault();
    }
}
