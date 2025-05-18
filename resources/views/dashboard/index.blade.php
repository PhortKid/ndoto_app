@extends('dashboard_layouts.app')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <!-- Balance Card -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-8 text-start">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                <i class="fas fa-wallet text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0 mt-3">
                            {{$mywallet->currency ?? 'TZS'}} {{ number_format($mywallet->balance ?? 0.00, 2) }}
                            </h5>
                            <span class="text-white text-sm">Total Balance</span>
                        </div>
                        <div class="col-4">
                            <div class="dropdown text-end mb-6">
                                {{--<a href="javascript:;" class="cursor-pointer" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h text-white"></i>
                                </a>--}}
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remaining Balance Card -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-8 text-start">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                <i class="fas fa-credit-card text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                ${{ number_format($remainingBalance ?? 0, 2) }}
                            </h5>
                            <span class="text-white text-sm">Withdraw Balance</span>
                        </div>
                        <div class="col-4">
                            <div class="dropstart text-end mb-6">
                            {{-- <a href="javascript:;" class="cursor-pointer" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h text-white"></i>
                                </a>--}}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Count Card -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-success opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-8 text-start">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                <i class="fas fa-shopping-cart text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                {{ $totalItems ?? 6 }}
                            </h5>
                            <span class="text-white text-sm">Total Items</span>
                        </div>
                        <div class="col-4">
                            <div class="dropdown text-end mb-6">
                            {{--<a href="javascript:;" class="cursor-pointer" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h text-white"></i>
                                </a>--}}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Items Card -->
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-warning opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-8 text-start">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                <i class="fas fa-star text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                {{ $activeItems ?? 0 }}
                            </h5>
                            <span class="text-white text-sm">Active Items</span>
                        </div>
                        <div class="col-4">
                            <div class="dropstart text-end mb-6">
                            {{-- <a href="javascript:;" class="cursor-pointer" id="dropdownUsers4" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h text-white"></i>
                                </a>--}}
                            </div>
                            <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">{{ $activeItemsGrowth ?? '+5' }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mt-4">
        <!-- Monthly Progress Chart -->
        <div class="col-lg-8 col-md-12">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Monthly Progress</h6>
                    <p class="text-sm">
                        <i class="fas fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in {{ date('F') }}
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                    <canvas id="chart-line" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Recent Activity</h6>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        @forelse($recentActivities ?? [] as $activity)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fas fa-bell text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $activity->title ?? 'New item added' }}</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $activity->created_at ?? '22 DEC 7:20 PM' }}</p>
                            </div>
                        </div>
                        @empty
                        @for($i = 0; $i < 4; $i++)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fas fa-bell text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Item {{ $i + 1 }} updated</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ date('d M g:i A', strtotime("-{$i} days")) }}</p>
                            </div>
                        </div>
                        @endfor
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
        // Create the chart
        var ctx = document.getElementById("chart-line").getContext("2d");

        // Assuming gradientStroke1 is already defined as a gradient color
        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradientStroke1.addColorStop(0, "rgba(94, 114, 228, 0.2)");
        gradientStroke1.addColorStop(1, "rgba(94, 114, 228, 0)");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Items",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>



@endsection