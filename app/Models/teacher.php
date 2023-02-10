<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class teacher extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "teacher";

    protected $fillable = [
        'nick',
        'email',
        'password',
        'name',
        'surname',
        'study_center'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
