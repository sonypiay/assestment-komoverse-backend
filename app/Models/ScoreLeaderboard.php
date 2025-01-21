<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ScoreLeaderboard extends Model
{
    protected $table = "tbl_score_leaderboard";
    protected $primaryKey = "id";
    protected $guarded = [];
    protected $keyType = "string";
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id = (string) Str::uuid();
            $model->created_at = now();
            $model->updated_at = now();
        });

        static::saving(function($model) {
            $model->updated_at = now();
        });
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
