<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // ✅ Correct table name (make sure it matches your DB)
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

    /**
     * ✅ Each Admin belongs to one Institute.
     */
    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }
}
