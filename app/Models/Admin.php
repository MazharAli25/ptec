<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'institute_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function institute() 
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }
}
