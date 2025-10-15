<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'institutes';

    protected $fillable = [
        'institute_name',
        'address'
    ];

    /**
     * ✅ One institute can have many admins.
     */
    public function admins()
    {
        // ✅ foreign key = institute_id in admins table
        return $this->hasMany(Admin::class, 'institute_id', 'id');
    }
}
