<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Security extends Model {
    public $timestamps = false;
  
    public function dategroup() {
        return $this->belongsToMany('App\Models\Dategroup');
    }

    public function incomevisitor() {
        return $this->hasMany('App\Models\Incomevisitor');
    }

    public function incomecar() {
        return $this->hasMany('App\Models\Incomecar');
    }
}
