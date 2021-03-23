<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incomevisitor extends Model {
    public $timestamps = false;

    public function visitor() {
        return $this->belongsTo('App\Models\Visitor');
    }

    public function security() {
        return $this->belongsTo('App\Models\Security');
    }

    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    public function currentdate() {
        return $this->belongsTo('App\Models\Currentdate');
    }

    public function card() {
        return $this->belongsTo('App\Models\Card');
    }
}
