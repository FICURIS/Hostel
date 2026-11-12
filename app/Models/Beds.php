<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beds extends Model
{
    protected $fillable = ['room_id', 'number', 'status'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
