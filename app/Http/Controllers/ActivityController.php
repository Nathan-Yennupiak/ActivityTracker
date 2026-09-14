<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        // For the dashboard, we want to see activities and their updates
        $activities = Activity::with(['creator', 'updates' => function ($query) {
            $query->with('user')->latest();
        }])->latest()->get();
        
        return view('dashboard', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $activity = Activity::create([
            'title' => $request->title,
            'status' => 'pending',
            'created_by' => Auth::id(),
        ]);

        ActivityUpdate::create([
            'activity_id' => $activity->id,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'remark' => 'Activity created.'
        ]);

        return back()->with('success', 'Activity added successfully.');
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'status' => 'required|in:pending,done',
            'remark' => 'nullable|string'
        ]);

        $activity->update([
            'status' => $request->status
        ]);

        ActivityUpdate::create([
            'activity_id' => $activity->id,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'remark' => $request->remark
        ]);

        return back()->with('success', 'Activity status updated successfully.');
    }

    public function dailyHandover()
    {
        $activities = Activity::whereHas('updates', function ($query) {
            $query->whereDate('created_at', now()->toDateString());
        })->with(['creator', 'updates' => function ($query) {
            $query->whereDate('created_at', now()->toDateString())->with('user')->latest();
        }])->latest()->get();

        return view('daily_handover', compact('activities'));
    }

    public function reporting(Request $request)
    {
        $activities = collect();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $activities = Activity::whereHas('updates', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })->with(['creator', 'updates' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->with('user')->latest();
            }])->latest()->get();
        }

        return view('reporting', compact('activities', 'startDate', 'endDate'));
    }
}
