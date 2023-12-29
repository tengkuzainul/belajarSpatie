<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use HasFactory;

    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'email_verified_at',
    ];
}
