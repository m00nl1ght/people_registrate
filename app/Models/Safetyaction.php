<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Safetyaction extends Model {
    public function checkbox() {
        return $this->belongsTo('App\Models\Checkbox');
    }
}
