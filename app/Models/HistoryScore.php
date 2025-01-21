<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class HistoryScore extends Model
{
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
            $model->date_created = now();
        });
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id')->withDefault();
    }
}
