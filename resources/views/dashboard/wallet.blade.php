@extends('dashboard_layouts.app')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <!-- Main Balance Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="text-center mb-4">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3 mx-auto">
                            <i class="fas fa-wallet text-dark text-gradient" style="font-size: 30px;"></i>
                        </div>
                        <h5 class="text-white font-weight-bolder mb-0">Total Balance</h5>
                        <h2 class="text-white font-weight-bolder mb-0 mt-3">{{ number_format($balance ?? 328020.00, 2) }}</h2>
                        <p class="text-white text-sm mb-0">Available for withdrawal</p>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn btn-sm bg-white text-dark mb-0">
                            <i class="fas fa-money-bill-wave me-2"></i> Withdraw Funds
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="col-lg-8 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-arrow-down text-success text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ number_format($totalIncome ?? 15420.00, 2) }}</h5>
                            <span class="text-white text-sm">Total Income</span>
                        </div>
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-arrow-up text-danger text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ number_format($totalWithdrawn ?? 5240.00, 2) }}</h5>
                            <span class="text-white text-sm">Total Withdrawn</span>
                        </div>
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-clock text-warning text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ number_format($pendingBalance ?? 1200.00, 2) }}</h5>
                            <span class="text-white text-sm">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction History & Actions -->
    <div class="row mt-4">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Transaction History</h6>
                        <button class="btn btn-link text-secondary ms-auto mb-0">
                            <i class="fas fa-filter text-xs"></i> Filter
                        </button>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions ?? [] as $transaction)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="icon icon-shape icon-sm {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }} text-white text-center me-2">
                                                <i class="fas fa-{{ $transaction->type == 'income' ? 'arrow-down' : 'arrow-up' }} text-xs opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ ucfirst($transaction->type ?? 'Income') }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">${{ number_format($transaction->amount ?? 1250.00, 2) }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-{{ $transaction->status == 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($transaction->status ?? 'Completed') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{ $transaction->created_at ?? '23 Mar 2024' }}</span>
                                    </td>
                                </tr>
                                @empty
                                @for($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="icon icon-shape icon-sm {{ $i % 2 == 0 ? 'bg-success' : 'bg-danger' }} text-white text-center me-2">
                                                <i class="fas fa-{{ $i % 2 == 0 ? 'arrow-down' : 'arrow-up' }} text-xs opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $i % 2 == 0 ? 'Income' : 'Withdrawal' }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">${{ number_format(rand(100, 2000), 2) }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-{{ $i % 3 == 0 ? 'warning' : 'success' }}">
                                            {{ $i % 3 == 0 ? 'Pending' : 'Completed' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{ date('d M Y', strtotime("-$i days")) }}</span>
                                    </td>
                                </tr>
                                @endfor
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body pt-4">
                    <a href="#" class="btn bg-gradient-primary w-100 mb-3">
                        <i class="fas fa-money-bill-wave me-2"></i> Withdraw Funds
                    </a>
                    <button class="btn bg-gradient-info w-100 mb-3">
                        <i class="fas fa-history me-2"></i> View All Transactions
                    </button>
                    <button class="btn bg-gradient-dark w-100">
                        <i class="fas fa-download me-2"></i> Download Statement
                    </button>

                    <hr class="horizontal dark my-4">

                    <!-- Payment Methods -->
                    <div class="text-center">
                        <h6 class="mb-3">Payment Methods</h6>
                        <div class="d-flex justify-content-center gap-3">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                <i class="fab fa-cc-visa text-info" style="font-size: 24px;"></i>
                            </div>
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                <i class="fab fa-cc-mastercard text-danger" style="font-size: 24px;"></i>
                            </div>
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                <i class="fab fa-paypal text-primary" style="font-size: 24px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 