<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'check_in' => 'nullable|date|after_or_equal:today',
            'check_out' => 'nullable|date|after:check_in',
        ], [
            'check_in.after_or_equal' => 'Дата заезда не может быть в прошлом.',
            'check_out.after' => 'Дата выезда должна быть позже даты заезда.',
        ]);
        $rooms = Room::with('beds')->get();

        $query = \App\Models\Room::with('beds');

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn = $request->check_in;
            $checkOut = $request->check_out;

            $query->whereHas('beds', function ($bedQuery) use ($checkIn, $checkOut) {
                $bedQuery->whereDoesntHave('applications', function ($appQuery) use ($checkIn, $checkOut){
                    $appQuery->whereIn('status', ['Новая', 'Подтверждена', 'Заселение'])
                    ->where('check_in', '<', $checkOut)
                    ->where('check_out', $checkIn);
                });
            });
        }

        $rooms = $query->get();

        return view('rooms.index', compact('rooms'));
    }
}