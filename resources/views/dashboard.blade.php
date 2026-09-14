@extends('layouts.app')

@section('content')
<div class="dashboard-header mb-8 flex justify-between items-center">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-description">Welcome, {{ Auth::user()->name }}! Manage team activities below.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- New Activity Form -->
<div class="shad-card mb-8">
    <h3 class="mb-4">Add New Activity</h3>
    <form method="POST" action="{{ route('activities.store') }}" class="flex gap-4 items-center">
        @csrf
        <div class="flex-1" style="flex: 1;">
            <input type="text" name="title" placeholder="e.g. Daily SMS count in comparison to SMScount from logs..." style="width: 100%;" required>
        </div>
        <button type="submit" class="btn-primary">Add Activity</button>
    </form>
</div>

<!-- List of Activities -->
<div class="activities-list flex gap-4" style="flex-direction: column;">
    @foreach($activities as $activity)
        <div class="shad-card activity-item">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h4 class="mb-1" style="font-size: 1.125rem;">{{ $activity->title }}</h4>
                    <span style="font-size: 0.85rem; color: var(--text-muted);">
                        Created by {{ $activity->creator->name }} on {{ $activity->created_at->format('M d, Y h:i A') }}
                    </span>
                </div>
                <div>
                    <span class="badge {{ $activity->status === 'done' ? 'badge-done' : 'badge-pending' }}">
                        {{ strtoupper($activity->status) }}
                    </span>
                </div>
            </div>

            <!-- Update Status Form -->
            <form method="POST" action="{{ route('activities.update', $activity) }}" class="mb-6 flex gap-4" style="background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 6px; border: 1px solid var(--card-border);">
                @csrf
                @method('PATCH')
                <div class="flex gap-4 items-center" style="flex: 1;">
                    <select name="status" style="width: 130px;">
                        <option value="pending" {{ $activity->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="done" {{ $activity->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                    <input type="text" name="remark" placeholder="Add a remark (optional)" style="flex: 1;">
                </div>
                <button type="submit" class="btn-secondary">Update Status</button>
            </form>
            
            <!-- Activity History Log -->
            @if($activity->updates->count() > 0)
                <div>
                    <h5 class="mb-2" style="color: var(--text-muted); font-size: 0.85rem;">Update History</h5>
                    <div style="max-height: 200px; overflow-y: auto; display: flex; flex-direction: column; gap: 0.5rem; padding-right: 0.5rem;">
                        @foreach($activity->updates as $update)
                            <div class="history-item" style="border-left-color: {{ $update->status === 'done' ? 'var(--status-done)' : 'var(--status-pending)' }};">
                                <div class="flex justify-between mb-1">
                                    <strong>{{ $update->user->name }}</strong>
                                    <span style="color: var(--text-muted);">{{ $update->created_at->format('M d h:i A') }}</span>
                                </div>
                                <p class="mb-1">Changed status to <strong>{{ strtoupper($update->status) }}</strong></p>
                                @if($update->remark)
                                    <p style="color: var(--text-muted); font-style: italic;">"{{ $update->remark }}"</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endforeach
    
    @if($activities->isEmpty())
        <div class="shad-card" style="text-align: center; padding: 4rem 2rem;">
            <p style="color: var(--text-muted);">No activities found. Start by adding one above!</p>
        </div>
    @endif
</div>
@endsection
