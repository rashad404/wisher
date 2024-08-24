<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEvent;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Fetch events based on the selected date or date range
        $startDate = $request->input('start_date') ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->input('end_date') ?? Carbon::now()->endOfMonth()->toDateString();

        $events = UserEvent::where('user_id', $user->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();

        return view('user.calendar.index', compact('events', 'startDate', 'endDate'));
    }
}
