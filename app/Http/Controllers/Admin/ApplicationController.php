<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'bed.room'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|string|in:Новая,Подтверждена,Заселение,Завершена,Отменена'
        ]);

        $application->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Статус заявки №' . $application->id . ' изменен на "' . $request->status . '"');
    }
}
