<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    public function visitor() {
        return $this->hasMany(Visitor::class);
    }
}
