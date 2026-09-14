@extends('layouts.app')

@section('content')
<div class="dashboard-header mb-8">
    <h1 class="page-title">Reporting & History</h1>
    <p class="page-description">Query activity histories based on custom durations.</p>
</div>

<div class="shad-card mb-8">
    <form method="GET" action="{{ route('reporting') }}" class="flex gap-4" style="align-items: flex-end;">
        <div class="form-group flex-1" style="flex: 1; margin-bottom: 0;">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" style="width: 100%;" required>
        </div>
        <div class="form-group flex-1" style="flex: 1; margin-bottom: 0;">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" style="width: 100%;" required>
        </div>
        <button type="submit" class="btn-primary">Generate Report</button>
    </form>
</div>

@if($startDate && $endDate)
    <h3 class="mb-6" style="font-size: 1.25rem; font-weight: 600;">Results for {{ $startDate }} to {{ $endDate }}</h3>
    
    <div class="activities-list flex gap-4" style="flex-direction: column;">
        @foreach($activities as $activity)
            <div class="shad-card activity-item">
                <div class="flex justify-between items-center mb-4 pb-4" style="border-bottom: 1px solid var(--card-border);">
                    <div>
                        <h4 class="mb-1" style="font-size: 1.125rem;">{{ $activity->title }}</h4>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">
                            Created by {{ $activity->creator->name }} on {{ $activity->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>

                <!-- Filtered Activity History Log -->
                <div>
                    <h5 class="mb-2" style="color: var(--text-muted); font-size: 0.85rem;">Updates in this period</h5>
                    <div class="flex" style="flex-direction: column; gap: 0.5rem;">
                        @foreach($activity->updates as $update)
                            <div class="history-item" style="border-left-color: {{ $update->status === 'done' ? 'var(--status-done)' : 'var(--status-pending)' }};">
                                <div class="flex justify-between mb-1">
                                    <strong>{{ $update->user->name }}</strong>
                                    <span style="color: var(--text-muted);">{{ $update->created_at->format('M d, Y h:i A') }}</span>
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
                <p style="color: var(--text-muted);">No activity updates found for this period.</p>
            </div>
        @endif
    </div>
@endif
@endsection
