<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'email',
        'password',
        'url'
      ];

    protected $hidden = [
    'password',
    'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
      ];
      
}
