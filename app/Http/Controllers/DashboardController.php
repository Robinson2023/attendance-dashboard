<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Cumpleaños del mes (a partir de hoy)
        $upcoming = Employee::whereNotNull('birth_date')
            ->whereMonth('birth_date', $today->month)
            ->whereDay('birth_date', '>=', $today->day)
            ->orderByRaw('MONTH(birth_date), DAY(birth_date)')
            ->get();

        // Eventos del día
        $todayEvents = Event::whereDate('event_date', $today)->get();

        // Próximo evento (futuro más cercano)
        $nextEvent = Event::whereDate('event_date', '>=', $today)
            ->orderBy('event_date', 'asc')
            ->first();

        return view('dashboard', compact('upcoming', 'todayEvents', 'nextEvent'));
    }
}

