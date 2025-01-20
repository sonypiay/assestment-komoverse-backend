<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Levels extends Model
{
    protected $table = 'tbl_levels';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    public $incrementing = false;
}
