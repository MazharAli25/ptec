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
        'password',
        'status',
        'institute_id', // ✅ foreign key to institutes table
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
        // ✅ foreign key = institute_id, local key = id
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }
}
