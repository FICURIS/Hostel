<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::with('beds')->get();

        return view('rooms.index', compact('rooms'));
    }
}