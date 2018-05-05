<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $timestamps = true;

    protected $table = 'organizations';
    protected $fillable = [
        'title'
    ];
}
