<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Levels extends Model
{
    protected $table = 'tbl_levels';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->id = (string) Str::uuid();
            $model->created_at = now();
            $model->updated_at = now();
        });
    }
}
