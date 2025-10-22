<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'requested_by');
    }
}
