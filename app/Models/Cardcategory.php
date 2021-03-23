<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cardcategory extends Model {
    public function card() {
        return $this->hasMany('App\Models\Card');
    }
}
