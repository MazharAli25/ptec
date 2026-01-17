<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
    protected $fillable= [
        'image1',
        'image2',
        'image3',
        'status',
    ];
}
