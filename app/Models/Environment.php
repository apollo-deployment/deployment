<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    public $timestamps = true;

    protected $table = 'environments';
    protected $fillable = ['name', 'ip_address', 'ssh_port', 'authentication_type', 'ssh_username', 'ssh_password', 'private_key_path'];
    protected $hidden = ['ssh_username', 'ssh_password', 'private_key_path'];
}