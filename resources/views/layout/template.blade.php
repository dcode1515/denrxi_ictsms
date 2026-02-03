<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:44:28 GMT -->
<head>

    <meta charset="utf-8" />
    <title>DENR XI | ICT Service Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/libs/jsvectormap/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/libs/swiper/swiper-bundle.min.css') }}">
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/js/layout.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/app.min.css') }}">   
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/custom.min.css') }}">
    <style>
   .card-animate {
        transition: all 0.3s ease;
    }
    .card-animate:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .avatar-title {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .counter-value {
        font-size: 1.75rem;
        font-weight: 600;
    }
    .table-card {
        border-radius: 8px;
    }
    .apexcharts-tooltip {
        box-shadow: 0 4px 14px rgba(0,0,0,0.15) !important;
        border-radius: 8px !important;
    }
    .apexcharts-menu {
        border-radius: 8px !important;
        box-shadow: 0 4px 14px rgba(0,0,0,0.15) !important;
    }
    .apexcharts-legend-series {
        margin: 0 10px !important;
    }
    .apexcharts-datalabels-group text {
        font-weight: 600 !important;
    }
        </style>


</head>


<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

            @include('layout.navbar')

            @include('layout.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

                @yield('content')
            <!-- End Page-content -->

                @include('layout.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    
    

    <!-- Theme Settings -->
   
    <!-- JAVASCRIPT -->
    <script src="{{ asset('public/js/app.js') }}?v={{ config('app.version') }}"></script>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/js/app.js') }}"></script>

    

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter animation
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.innerText = Math.floor(current);
                    setTimeout(updateCounter, 10);
                } else {
                    counter.innerText = target;
                }
            };
            
            updateCounter();
        });

        // Data for charts
        @php
            // Get last 6 months data for bar chart
            $barMonths = [];
            $barTicketCounts = [];
            $barResolvedCounts = [];
            
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $barMonths[] = $month->format('M Y');
                
                $total = \App\Models\Ticket::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
                $barTicketCounts[] = $total;
                
                $resolved = \App\Models\Ticket::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->where('status', 'resolved')
                    ->count();
                $barResolvedCounts[] = $resolved;
            }
            
            // Data for pie chart - Tickets by Status
            $statusData = [];
            $statusLabels = [];
            $statusColors = [];
            
            $statuses = \App\Models\Ticket::select('status', \DB::raw('COUNT(*) as count'))
                ->groupBy('status')
                ->get();
            
            foreach($statuses as $status) {
                $statusLabels[] = ucfirst($status->status);
                $statusData[] = $status->count;
                
                // Assign colors based on status
                switch($status->status) {
                    case 'pending':
                        $statusColors[] = '#f7b84b'; // Warning
                        break;
                    case 'in_progress':
                        $statusColors[] = '#299cdb'; // Info
                        break;
                    case 'resolved':
                        $statusColors[] = '#0ab39c'; // Success
                        break;
                    case 'closed':
                        $statusColors[] = '#405189'; // Primary
                        break;
                    case 'cancelled':
                        $statusColors[] = '#f06548'; // Danger
                        break;
                    default:
                        $statusColors[] = '#878a99'; // Secondary
                }
            }
        @endphp

        // Bar Chart - Monthly Tickets Overview
        var barChartOptions = {
            series: [{
                name: 'Total Tickets',
                data: @json($barTicketCounts)
            }, {
                name: 'Resolved',
                data: @json($barResolvedCounts)
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true
                    }
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all',
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($barMonths),
                labels: {
                    style: {
                        colors: '#878a99',
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Number of Tickets',
                    style: {
                        color: '#878a99',
                        fontSize: '14px'
                    }
                },
                labels: {
                    style: {
                        colors: '#878a99',
                        fontSize: '12px'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " tickets"
                    }
                }
            },
            colors: ['#405189', '#0ab39c'],
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 4
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontSize: '14px',
                labels: {
                    colors: '#878a99'
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 5
                }
            }
        };

        var barChart = new ApexCharts(document.querySelector("#monthly-tickets-chart"), barChartOptions);
        barChart.render();

        // Pie Chart - Tickets by Status
        var pieChartOptions = {
            series: @json($statusData),
            chart: {
                type: 'pie',
                height: 320,
            },
            labels: @json($statusLabels),
            colors: @json($statusColors),
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex] + " (" + val.toFixed(1) + "%)"
                },
                dropShadow: {
                    enabled: false
                },
                style: {
                    fontSize: '12px',
                    fontWeight: '500',
                    colors: ['#fff']
                }
            },
            legend: {
                show: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '16px',
                                fontWeight: 600,
                                color: '#878a99'
                            },
                            value: {
                                show: true,
                                fontSize: '24px',
                                fontWeight: 700,
                                color: '#343a40',
                                formatter: function (val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                color: '#878a99',
                                fontSize: '14px',
                                fontWeight: 500,
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 280
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#tickets-status-pie-chart"), pieChartOptions);
        pieChart.render();

        // Create custom legend for pie chart
        function createPieChartLegend() {
            const legendContainer = document.getElementById('pie-chart-legend');
            let legendHTML = '<div class="row">';
            
            @foreach($statuses as $index => $status)
            const color = @json($statusColors)[{{ $index }}];
            legendHTML += `
                <div class="col-6 mb-2">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <div class="avatar-xs">
                                <span class="avatar-title rounded" style="background-color: ${color}"></span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <span class="text-muted">{{ ucfirst($status->status) }}</span>
                            <h6 class="mb-0">{{ $status->count }} tickets</h6>
                        </div>
                    </div>
                </div>
            `;
            @endforeach
            
            legendHTML += '</div>';
            legendContainer.innerHTML = legendHTML;
        }
        
        createPieChartLegend();

        // Function to update chart based on timeframe
        window.updateChart = function(timeframe) {
            // Update button states
            document.querySelectorAll('#monthly-tickets-chart').closest('.card').querySelectorAll('.btn').forEach(btn => {
                btn.classList.remove('btn-soft-primary');
                btn.classList.add('btn-soft-secondary');
            });
            event.target.classList.remove('btn-soft-secondary');
            event.target.classList.add('btn-soft-primary');
            
            // In a real application, you would fetch new data based on timeframe
            // For now, we'll just update the chart title
            let title = 'Monthly Tickets Overview';
            if (timeframe === 'year') title = 'Yearly Tickets Overview';
            if (timeframe === 'week') title = 'Weekly Tickets Overview';
            
            barChart.updateOptions({
                title: {
                    text: title,
                    align: 'left',
                    style: {
                        fontSize: '16px',
                        fontWeight: '600'
                    }
                }
            });
        };

        // Function to update pie chart
        window.updatePieChart = function(filter) {
            // Update button state
            document.querySelectorAll('#tickets-status-pie-chart').closest('.card').querySelectorAll('.btn').forEach(btn => {
                btn.classList.remove('btn-soft-primary');
                btn.classList.add('btn-soft-secondary');
            });
            event.target.classList.remove('btn-soft-secondary');
            event.target.classList.add('btn-soft-primary');
            
            // In a real application, you would filter data based on the filter parameter
            // For demonstration, we'll keep the same data
        };
    });
</script>



</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:45:33 GMT -->
</html>