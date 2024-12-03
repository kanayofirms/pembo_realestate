<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventModel;

class FullCalendarController extends Controller
{
    public function full_calendar(Request $request)
    {
        return view('admin.full_calendar.list');
    }
}
