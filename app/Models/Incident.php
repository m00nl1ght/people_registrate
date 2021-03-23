<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Incident extends Model {
    public $timestamps = false;
    
    public function currentdate() {
        return $this->belongsTo('App\Models\Currentdate');
    }

    public function getMyTimeFormatAttribute() {
        if (isset($this->attributes['in_time'])) {
            return Carbon::parse($this->attributes['in_time'])->setTimezone('Europe/Moscow')->isoFormat('HH:mm');
        }
    }
}