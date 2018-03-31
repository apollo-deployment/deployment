<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = true;

    protected $table = 'projects';
    protected $fillable = ['name', 'repository_url'];
}
