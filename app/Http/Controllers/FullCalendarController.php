<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventModel;

class FullCalendarController extends Controller
{
    public function full_calendar(Request $request)
    {
        if ($request->ajax()) {
            $data = EventModel::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }

        return view('admin.full_calendar.list');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $event = EventModel::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end
                ]);
                return response()->json($event);
            }
            if ($request->type == 'update') {
                $event = EventModel::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end
                ]);
                return response()->json($event);
            }
            if ($request->type == 'delete') {
                $event = EventModel::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }
}
