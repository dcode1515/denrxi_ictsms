@extends('layout.template')
@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                 <h4 class="fs-16 mb-1">
                                    @php
                                        $hour = now()->hour;
                                        if ($hour < 12) {
                                            $greeting = 'Good Morning';
                                        } elseif ($hour < 17) {
                                            $greeting = 'Good Afternoon';
                                        } elseif ($hour < 20) {
                                            $greeting = 'Good Evening';
                                        } else {
                                            $greeting = 'Good Night';
                                        }
                                    @endphp
                                    {{ $greeting }}, {{ Auth::user()->name ?? 'User' }}!
                                </h4>
                                    <p class="text-muted mb-0">Here's what's happening with your helpdesk today.</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-sm-auto">
                                                <div class="input-group">
                                                    <input type="text" class="form-control border-0 dash-filter-picker shadow" 
                                                           data-provider="flatpickr" data-range-date="true" 
                                                           data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                    <div class="input-group-text bg-primary border-primary text-white">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Total Tickets Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Tickets</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            @php
                                                $totalTickets = \App\Models\Ticket::count();
                                                $previousTickets = \App\Models\Ticket::whereDate('created_at', '<', now()->subDays(7))->count();
                                                $ticketPercentage = $previousTickets > 0 ? (($totalTickets - $previousTickets) / $previousTickets) * 100 : 0;
                                            @endphp
                                            <h5 class="{{ $ticketPercentage >= 0 ? 'text-success' : 'text-danger' }} fs-14 mb-0">
                                                <i class="ri-arrow-right-{{ $ticketPercentage >= 0 ? 'up' : 'down' }}-line fs-13 align-middle"></i> 
                                                {{ number_format(abs($ticketPercentage), 2) }} %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span class="counter-value" data-target="{{ $totalTickets }}">0</span>
                                            </h4>
                                            <a href="{{ route('ticket') }}" class="text-decoration-underline">View all tickets</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                <i class="bx bx-task text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Tickets Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending Tickets</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            @php
                                                $pendingTickets = \App\Models\Ticket::where('status', 'pending')->count();
                                                $previousPending = \App\Models\Ticket::where('status', 'pending')
                                                    ->whereDate('created_at', '<', now()->subDays(7))
                                                    ->count();
                                                $pendingPercentage = $previousPending > 0 ? (($pendingTickets - $previousPending) / $previousPending) * 100 : 0;
                                            @endphp
                                            <h5 class="{{ $pendingPercentage >= 0 ? 'text-success' : 'text-danger' }} fs-14 mb-0">
                                                <i class="ri-arrow-right-{{ $pendingPercentage >= 0 ? 'up' : 'down' }}-line fs-13 align-middle"></i> 
                                                {{ number_format(abs($pendingPercentage), 2) }} %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span class="counter-value" data-target="{{ $pendingTickets }}">0</span>
                                            </h4>
                                            <a href="{{ route('ticket', ['status' => 'pending']) }}" class="text-decoration-underline">View pending</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                <i class="bx bx-time-five text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Resolved Tickets Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Resolved Tickets</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            @php
                                                $resolvedTickets = \App\Models\Ticket::where('status', 'resolved')->count();
                                                $previousResolved = \App\Models\Ticket::where('status', 'resolved')
                                                    ->whereDate('created_at', '<', now()->subDays(7))
                                                    ->count();
                                                $resolvedPercentage = $previousResolved > 0 ? (($resolvedTickets - $previousResolved) / $previousResolved) * 100 : 0;
                                            @endphp
                                            <h5 class="{{ $resolvedPercentage >= 0 ? 'text-success' : 'text-danger' }} fs-14 mb-0">
                                                <i class="ri-arrow-right-{{ $resolvedPercentage >= 0 ? 'up' : 'down' }}-line fs-13 align-middle"></i> 
                                                {{ number_format(abs($resolvedPercentage), 2) }} %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span class="counter-value" data-target="{{ $resolvedTickets }}">0</span>
                                            </h4>
                                            <a href="{{ route('ticket', ['status' => 'resolved']) }}" class="text-decoration-underline">View resolved</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                <i class="bx bx-check-circle text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Office-Specific Tickets Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">My Office Tickets</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            @php
                                                $userOfficeId = Auth::user()->office_id ?? null;
                                                $officeTickets = $userOfficeId ? \App\Models\Ticket::where('office_id', $userOfficeId)->count() : 0;
                                                $previousOffice = $userOfficeId ? \App\Models\Ticket::where('office_id', $userOfficeId)
                                                    ->whereDate('created_at', '<', now()->subDays(7))
                                                    ->count() : 0;
                                                $officePercentage = $previousOffice > 0 ? (($officeTickets - $previousOffice) / $previousOffice) * 100 : 0;
                                            @endphp
                                            <h5 class="{{ $officePercentage >= 0 ? 'text-success' : 'text-danger' }} fs-14 mb-0">
                                                <i class="ri-arrow-right-{{ $officePercentage >= 0 ? 'up' : 'down' }}-line fs-13 align-middle"></i> 
                                                {{ number_format(abs($officePercentage), 2) }} %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span class="counter-value" data-target="{{ $officeTickets }}">0</span>
                                            </h4>
                                            @if($userOfficeId)
                                                <a href="{{ route('ticket', ['office' => $userOfficeId]) }}" class="text-decoration-underline">View office tickets</a>
                                            @else
                                                <span class="text-muted">No office assigned</span>
                                            @endif
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                                <i class="bx bx-building text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Bar Chart - Monthly Tickets Overview -->
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Monthly Tickets Overview</h4>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-soft-secondary btn-sm" onclick="updateChart('year')">Year</button>
                                        <button class="btn btn-soft-primary btn-sm" onclick="updateChart('month')">Month</button>
                                        <button class="btn btn-soft-secondary btn-sm" onclick="updateChart('week')">Week</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="monthly-tickets-chart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart - Tickets by Status -->
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Tickets by Status</h4>
                                    <div>
                                        <button type="button" class="btn btn-soft-primary btn-sm" onclick="updatePieChart('all')">ALL</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="tickets-status-pie-chart" class="apex-charts" dir="ltr"></div>
                                    <div class="mt-3" id="pie-chart-legend"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tickets by Type Table -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Tickets by Type</h4>
                                    <div>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">ALL</button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">1M</button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">6M</button>
                                        <button type="button" class="btn btn-soft-primary btn-sm">1Y</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th scope="col">Ticket Type</th>
                                                    <th scope="col">Tickets</th>
                                                    <th scope="col">Percentage</th>
                                                    <th scope="col">Trend</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $ticketTypes = \DB::table('ticket_type_tbl')
                                                        ->select(
                                                            'ticket_type_tbl.id',
                                                            'ticket_type_tbl.ticket_type',
                                                            \DB::raw('COUNT(ticket_tbl.id) as tickets_count')
                                                        )
                                                        ->leftJoin('ticket_tbl', 'ticket_type_tbl.id', '=', 'ticket_tbl.ticket_type_id')
                                                        ->whereNull('ticket_type_tbl.deleted_at')
                                                        ->groupBy('ticket_type_tbl.id', 'ticket_type_tbl.ticket_type')
                                                        ->get();
                                                    $totalTicketsForType = $ticketTypes->sum('tickets_count');
                                                @endphp
                                                @foreach($ticketTypes as $type)
                                                @php
                                                    $percentage = $totalTicketsForType > 0 ? ($type->tickets_count / $totalTicketsForType) * 100 : 0;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title bg-{{ $loop->index % 2 == 0 ? 'primary' : 'success' }}-subtle rounded">
                                                                        <i class="bx bx-category text-{{ $loop->index % 2 == 0 ? 'primary' : 'success' }} font-size-18"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">{{ $type->ticket_type }}</div>
                                                        </div>
                                                    </td>
                                                    <td><h5 class="fs-14 mb-0">{{ $type->tickets_count }}</h5></td>
                                                    <td>
                                                        <div class="text-center">{{ number_format($percentage, 1) }}%</div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">{{ number_format($percentage, 1) }}%</span>
                                                            <div class="flex-shrink-0">
                                                                @php
                                                                    $trendUp = $percentage > 20;
                                                                @endphp
                                                                <h5 class="fs-14 mb-0 {{ $trendUp ? 'text-success' : 'text-danger' }}">
                                                                    <i class="ri-arrow-right-{{ $trendUp ? 'up' : 'down' }}-line fs-13 align-middle"></i>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Tickets Table -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Recent Tickets</h4>
                                    <div>
                                        <a href="{{ route('ticket.request') }}" class="btn btn-soft-primary btn-sm">
                                            <i class="ri-add-line align-middle me-1"></i> Create Ticket
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th scope="col">Helpdesk No</th>
                                                    <th scope="col">Requester</th>
                                                    <th scope="col">Date Created</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $recentTickets = \App\Models\Ticket::with('office')
                                                        ->orderBy('created_at', 'desc')
                                                        ->limit(5)
                                                        ->get();
                                                @endphp
                                                @foreach($recentTickets as $ticket)
                                                <tr>
                                                    <td>
                                                      
                                                            {{ $ticket->helpdesk_no }}
                                                       
                                                    </td>
                                                    <td>{{ $ticket->firstname }} {{ $ticket->lastname }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('M d, Y') }}</td>
                                                    <td>
                                                        @php
                                                            $statusColors = [
                                                                'pending' => 'warning',
                                                                'in_progress' => 'info',
                                                                'resolved' => 'success',
                                                                'closed' => 'secondary',
                                                                'cancelled' => 'danger'
                                                            ];
                                                            $color = $statusColors[$ticket->status] ?? 'secondary';
                                                        @endphp
                                                        <span class="badge bg-{{ $color }}-subtle text-{{ $color }}">
                                                            {{ ucfirst($ticket->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


