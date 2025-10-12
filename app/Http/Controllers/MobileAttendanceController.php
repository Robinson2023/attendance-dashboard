<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileAttendance;
use Illuminate\Support\Facades\Auth;

class MobileAttendanceController extends Controller
{
    public function index()
    {
        return view('attendances.mark');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:entrada,salida',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        MobileAttendance::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'fecha' => now()->toDateString(),
            'hora' => now()->toTimeString(),
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);

        return back()->with('success','Marcación registrada correctamente.');
    }
}
