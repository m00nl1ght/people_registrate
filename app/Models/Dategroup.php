<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dategroup extends Model {
    public $timestamps = false;

    public function security() {
        return $this->belongsToMany('App\Models\Security');
    }

    public function currentdate() {
        return $this->belongsTo('App\Models\Currentdate');
    }
}
