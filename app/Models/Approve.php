<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approve extends Model {
    public function act() {
        return $this->belongsTo('App\Models\Act');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
