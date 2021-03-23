<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    public $timestamps = false;
    protected $fillable = ['position'];
    
    public function incomevisitor() {
        return $this->hasMany('App\Models\Incomevisitor');
    }

    public function incomecar() {
        return $this->hasMany('App\Models\Incomecar');
    }

    public function incomecard() {
        return $this->belongsToMany('App\Models\Incomecard');
    }

    public function act() {
        return $this->belongsToMany('App\Models\Act');
    }
}
