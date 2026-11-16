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

        return view('applications.create', compact('bed'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bed_id' => 'required|exists:beds,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $isOccupied = Application::where('bed_id', $request->bed_id)->whereIn('status', ['Новая','Подтверждена','Заселение'])->where(function ($query) use ($request) {
            $query->where('check_in', '<', $request->check_out)
            ->where('check_out', '>', $request->check_in);
        })
        -> exists();

        if ($isOccupied) {
            return back()->withErrors(['bed_id' => 'К сожалению, это место уже занято на выбранные даты.'])->withInput();
        }

        Application::create([
            'user_id' => Auth::id(),
            'bed_id' => $request->bed_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Новая', // По умолчанию
        ]);

        return redirect()->route('applications.index')->with('success', 'Заявка успешно создана и отправлена на рассмотрение!');
    }
}
