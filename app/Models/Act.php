<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Act extends Model {
    public function checkbox() {
        return $this->hasOne('App\Models\Checkbox');
    }

    public function map() {
        return $this->hasOne('App\Models\Map');
    }

    public function employee() {
        return $this->belongsToMany('App\Models\Employee');
    }

    public function visitor() {
        return $this->belongsTo('App\Models\Visitor');
    }

    public function approve() {
        return $this->hasOne('App\Models\Approve');
    }

    public function workers() {
        return $this->belongsToMany('App\Models\Visitor', 'act_visitor');
    }
}
