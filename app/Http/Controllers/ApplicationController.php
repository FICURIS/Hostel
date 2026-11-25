<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Bed;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['bed.room'])->where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('applications.index', compact('applications'));
    }
    public function create(Request $request)
    {
        $bed = Bed::with('room')->findOrFail($request->query('bed_id'));

        $checkIn = $request->query('check_in');
        $checkOut = $request->query('check_out');

        $availableBeds = Bed::where('room_id', $bed->room_id)
            ->whereDoesntHave('applications', function ($query) use ($checkIn, $checkOut) {
                if ($checkIn && $checkOut) {
                    $query->whereIn('status', ['Новая', 'Подтверждена', 'Заселение'])
                          ->where('check_in', '<', $checkOut)
                          ->where('check_out', '>', $checkIn);
                }
            })
            ->orderBy('number')
            ->get();

        return view('applications.create', compact('bed', 'availableBeds', 'checkIn', 'checkOut'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'bed_id' => 'required|exists:beds,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'payment_method' => 'required|string',
        ]);

        $isOccupied = Application::where('bed_id', $request->bed_id)->whereIn('status', ['Новая','Подтверждена','Заселение'])->where(function ($query) use ($request) {
            $query->where('check_in', '<', $request->check_out)
            ->where('check_out', '>', $request->check_in);
        })
        -> exists();

        if ($isOccupied) {
            return back()->withErrors(['bed_id' => 'К сожалению, это место уже занято на выбранные даты.'])->withInput();
        }

        if ($request->payment_method === 'Картой онлайн') {
        return redirect()->route('applications.payment', [
            'bed_id' => $request->bed_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);
    }

        Application::create([
            'user_id' => Auth::id(),
            'bed_id' => $request->bed_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Новая',
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('applications.index')->with('success', 'Заявка успешно создана и отправлена на рассмотрение!');
    }

    public function showPayment(Request $request)
    {
        $bed = Bed::with('room')->findOrFail($request->bed_id);
        $check_in = $request->check_in;
        $check_out = $request->check_out;
    
        return view('applications.payment', compact('bed', 'check_in', 'check_out'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'bed_id' => 'required|exists:beds,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'card_number' => 'required|string|min:16',
            'card_expiry' => 'required',
            'card_cvc' => 'required',
        ]);

        Application::create([
            'user_id' => Auth::id(),
            'bed_id' => $request->bed_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Новая',
            'payment_method' => 'Картой онлайн',
        ]);

        return redirect()->route('applications.index')->with('success', 'Оплата прошла успешно! Заявка подтверждена.');
    }
}
