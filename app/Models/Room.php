<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['title', 'description', 'size', 'price', 'image'];

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
