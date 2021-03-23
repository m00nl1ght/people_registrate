<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model {
    public $timestamps = false;
    
    public function incomecard() {
        return $this->hasMany('App\Models\Incomecard');
    }

    public function cardcategory() {
        return $this->belongsTo('App\Models\Cardcategory');
    }

    public function incomevisitor() {
        return $this->hasMany('App\Models\Incomevisitor');
    }
}
