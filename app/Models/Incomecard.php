<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incomecard extends Model {
    public $timestamps = false;
  
    public function employee() {
        return $this->belongsToMany('App\Models\Employee');
    }

    public function currentdate() {
        return $this->belongsTo('App\Models\Currentdate');
    }

    public function card() {
        return $this->belongsTo('App\Models\Card');
    }
}
