<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class HistoryScore extends Model
{
    /** @use HasFactory<\Database\Factories\UserLevelFactory> */
    use HasFactory;

    protected $table = "tbl_history_score";
    protected $primaryKey = "id";
    protected $guarded = [];
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id = (string) Str::uuid();
            $model->created_at = now();
        });
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id')->withDefault();
    }

    public function levels(): BelongsTo
    {
        return $this->belongsTo(Levels::class, 'level_id')->withDefault();
    }
}
