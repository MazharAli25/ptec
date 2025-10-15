<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mysession extends Model
{
    public $table= 'mysessions';
    protected $fillable=[
        'sessionStart',
        'sessionEnd'
    ];

    protected $casts = [
        'sessionStart' => 'date',
        'sessionEnd' => 'date',
    ];
}
