<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mysession extends Model
{
    public $table= 'mysessions';
    
    protected $fillable=[
        'session',
    ];

    public function students() {
        return $this->hasMany(Student::class);
    }

    public function diplomas() {
        return $this->hasMany(Diploma::class, 'SessionID');
    }
}
