<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model {
    public $timestamps = false;

    public function incomevisitor() {
        return $this->hasMany('App\Models\Incomevisitor');
    }

    public function incomecar() {
        return $this->hasMany('App\Models\Incomecar');
    }

    public function firm() {
        return $this->belongsTo('App\Models\Firm');
    }

    public function car() {
        return $this->belongsTo('App\Models\Car');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function act() {
        return $this->hasMany('App\Models\Act');
    }

    public function document() {
        return $this->hasMany('App\Models\Document');
    }

    public function docs() {
        return $this->belongsToMany('App\Models\Act');
    }
}
