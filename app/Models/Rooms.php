<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    public function beds()
{
    return $this->hasMany(Bed::class);
}
}
