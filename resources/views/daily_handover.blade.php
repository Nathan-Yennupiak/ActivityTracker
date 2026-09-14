@extends('layouts.app')

@section('content')
<div class="dashboard-header mb-8">
    <h1 class="page-title">Daily Handover</h1>
    <p class="page-description">Activities updated today ({{ now()->format('M d, Y') }}).</p>
</div>

<div class="activities-list flex gap-4" style="flex-direction: column;">
    @foreach($activities as $activity)
        <div class="shad-card activity-item" style="border-left: 4px solid {{ $activity->status === 'done' ? 'var(--status-done)' : 'var(--status-pending)' }};">
            <div class="flex justify-between items-center mb-4 pb-4" style="border-bottom: 1px solid var(--card-border);">
                <div>
                    <h4 class="mb-1" style="font-size: 1.125rem;">{{ $activity->title }}</h4>
                    <span style="font-size: 0.85rem; color: var(--text-muted);">
                        Current Status: <strong style="color: {{ $activity->status === 'done' ? 'var(--status-done)' : 'var(--status-pending)' }}">{{ strtoupper($activity->status) }}</strong>
                    </span>
                </div>
            </div>

            <!-- Activity History Log for Today -->
            <div>
                <h5 class="mb-2" style="color: var(--text-muted); font-size: 0.85rem;">Updates Made Today</h5>
                <div class="flex" style="flex-direction: column; gap: 0.5rem;">
                    @foreach($activity->updates as $update)
                        <div class="history-item">
                            <div class="flex justify-between mb-1">
                                <strong>{{ $update->user->name }} ({{ $update->user->email }})</strong>
                                <span style="color: var(--text-muted);">{{ $update->created_at->format('h:i A') }}</span>
                            </div>
                            <p class="mb-1">Set status to <strong>{{ strtoupper($update->status) }}</strong></p>
                            @if($update->remark)
                                <p style="color: var(--text-muted); font-style: italic;">"{{ $update->remark }}"</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    
    @if($activities->isEmpty())
        <div class="shad-card" style="text-align: center; padding: 4rem 2rem;">
            <p style="color: var(--text-muted);">No activities have been updated today.</p>
        </div>
    @endif
</div>
@endsection
