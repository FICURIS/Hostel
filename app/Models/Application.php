<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    
    protected $fillable = [
        'user_id',
        'bed_id',
        'check_in',
        'check_out',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }
}
