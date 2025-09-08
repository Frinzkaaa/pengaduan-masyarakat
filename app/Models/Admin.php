<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'password'];

    public $timestamps = false; // kalau tabel gak ada kolom created_at & updated_at
}
