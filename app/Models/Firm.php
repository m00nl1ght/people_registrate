<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model {
    public $timestamps = false;
    
    public function visitor() {
        return $this->hasMany('App\Models\Visitor');
    }
}