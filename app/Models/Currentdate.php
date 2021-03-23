<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Currentdate extends Model {
    public $timestamps = false;

    public function dategroup() {
        return $this->hasOne('App\Models\Dategroup');
    }

    public function incomevisitor() {
        return $this->hasMany('App\Models\Incomevisitor');
    }

    public function incomecar() {
        return $this->hasMany('App\Models\Incomecar');
    }

    public function incomecard() {
        return $this->hasMany('App\Models\Incomecard');
    }

    public function fault() {
        return $this->hasMany('App\Models\Fault');
    }

    public function incident() {
        return $this->hasMany('App\Models\Incident');
    }

    public function getMyDateFormatAttribute() {
        if (isset($this->attributes['currentdate'])) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['currentdate'])->format('d/m/Y');
        }
    }
}