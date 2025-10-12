<?php

namespace App\Http\Controllers;

use App\Models\MobileAttendance;

class AttendanceMapController extends Controller
{
    public function index()
    {
        // Traer las últimas marcaciones del día
        $attendances = MobileAttendance::with('user')
            ->whereDate('fecha', now()->toDateString())
            ->get();

        return view('attendances.map', compact('attendances'));
    }
}
