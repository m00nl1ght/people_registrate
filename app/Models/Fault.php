<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fault extends Model {
    public $timestamps = false;
    
    public function currentdate() {
        return $this->belongsTo('App\Models\Currentdate');
    }
}
