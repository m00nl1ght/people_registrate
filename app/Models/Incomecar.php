<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incomecar extends Model {
    public $timestamps = false;

    public function currentdate() {
        return $this->belongsTo('App\Models\Currentdate');
    }

    public function visitor() {
        return $this->belongsTo('App\Models\Visitor');
    }

    public function security() {
        return $this->belongsTo('App\Models\Security');
    }

    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }
}
