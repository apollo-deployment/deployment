<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebServer extends Model
{
    public $timestamps = true;

    protected $table = 'web_servers';
    protected $fillable = ['name', 'ip_address', 'server_username', 'server_password', 'private_key_path'];
}
