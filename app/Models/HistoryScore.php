<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryScore extends Model
{
    /** @use HasFactory<\Database\Factories\UserLevelFactory> */
    use HasFactory;

    protected $table = "tbl_history_score";
    protected $primaryKey = "id";
    protected $guarded = [];
    protected $keyType = "string";
    public $incrementing = false;

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'id')->withDefault();
    }
}
