<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function act() {
        return $this->belongsTo('App\Models\Act');
    }
}
