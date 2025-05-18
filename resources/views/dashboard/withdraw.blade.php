@extends('dashboard_layouts.app')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <!-- Available Balance Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="text-center mb-4">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3 mx-auto">
                            <i class="fas fa-money-bill-wave text-dark text-gradient" style="font-size: 30px;"></i>
                        </div>
                        <h5 class="text-white font-weight-bolder mb-0">Available Balance</h5>
                        <h2 class="text-white font-weight-bolder mb-0 mt-3">${{ number_format($balance ?? 328020.00, 2) }}</h2>
                        <p class="text-white text-sm mb-0">Minimum withdrawal: $100.00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdrawal Stats -->
        <div class="col-lg-8 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-check-circle text-success text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ $completedWithdrawals ?? 12 }}</h5>
                            <span class="text-white text-sm">Completed</span>
                        </div>
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-clock text-warning text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ $pendingWithdrawals ?? 2 }}</h5>
                            <span class="text-white text-sm">Pending</span>
                        </div>
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-calendar text-info text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ $lastWithdrawal ?? '5 days' }}</h5>
                            <span class="text-white text-sm">Last Withdrawal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawal Form & History -->
    <div class="row mt-4">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Make a Withdrawal</h6>
                </div>
                <div class="card-body pt-4">
                    <form action="#" method="POST">
                        @csrf
                        <!-- Amount -->
                        <div class="form-group">
                            <label class="form-control-label">Amount to Withdraw</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" name="amount" min="100" max="{{ $balance ?? 328020.00 }}" step="0.01" required>
                            </div>
                            <small class="text-muted">Minimum: $100.00 | Maximum: ${{ number_format($balance ?? 328020.00, 2) }}</small>
                        </div>

                        <!-- Payment Method -->
                        <div class="form-group mt-4">
                            <label class="form-control-label">Payment Method</label>
                            <select class="form-control" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="paypal">PayPal</option>
                                <option value="crypto">Cryptocurrency</option>
                            </select>
                        </div>

                        <!-- Bank Details (shown/hidden based on selection) -->
                        <div class="bank-details mt-4" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Account Number</label>
                                        <input type="text" class="form-control" name="account_number">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-control-label">Account Holder Name</label>
                                <input type="text" class="form-control" name="account_holder">
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-control-label">Swift/BIC Code</label>
                                <input type="text" class="form-control" name="swift_code">
                            </div>
                        </div>

                        <!-- PayPal Details -->
                        <div class="paypal-details mt-4" style="display: none;">
                            <div class="form-group">
                                <label class="form-control-label">PayPal Email</label>
                                <input type="email" class="form-control" name="paypal_email">
                            </div>
                        </div>

                        <!-- Crypto Details -->
                        <div class="crypto-details mt-4" style="display: none;">
                            <div class="form-group">
                                <label class="form-control-label">Wallet Address</label>
                                <input type="text" class="form-control" name="wallet_address">
                            </div>
                            <div class="form-group mt-3">
                                <label class="form-control-label">Network</label>
                                <select class="form-control" name="crypto_network">
                                    <option value="btc">Bitcoin (BTC)</option>
                                    <option value="eth">Ethereum (ETH)</option>
                                    <option value="usdt">USDT (TRC20)</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-gradient-primary mt-4">Request Withdrawal</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Recent Withdrawals -->
        <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Recent Withdrawals</h6>
                </div>
                <div class="card-body pt-4">
                    <div class="timeline timeline-one-side">
                        @forelse($recentWithdrawals ?? [] as $withdrawal)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fas fa-money-bill-wave text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">${{ number_format($withdrawal->amount ?? 1000, 2) }}</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $withdrawal->created_at ?? '23 Mar 2024' }}</p>
                                <span class="badge badge-sm bg-gradient-{{ $withdrawal->status == 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($withdrawal->status ?? 'Pending') }}
                                </span>
                            </div>
                        </div>
                        @empty
                        @for($i = 0; $i < 4; $i++)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fas fa-money-bill-wave text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">${{ number_format(rand(1000, 5000), 2) }}</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ date('d M Y', strtotime("-$i days")) }}</p>
                                <span class="badge badge-sm bg-gradient-{{ $i % 2 == 0 ? 'success' : 'warning' }}">
                                    {{ $i % 2 == 0 ? 'Completed' : 'Pending' }}
                                </span>
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

@push('scripts')
<script>
    // Show/hide payment method details
    document.querySelector('select[name="payment_method"]').addEventListener('change', function(e) {
        // Hide all payment details first
        document.querySelector('.bank-details').style.display = 'none';
        document.querySelector('.paypal-details').style.display = 'none';
        document.querySelector('.crypto-details').style.display = 'none';

        // Show selected payment method details
        if (e.target.value === 'bank') {
            document.querySelector('.bank-details').style.display = 'block';
        } else if (e.target.value === 'paypal') {
            document.querySelector('.paypal-details').style.display = 'block';
        } else if (e.target.value === 'crypto') {
            document.querySelector('.crypto-details').style.display = 'block';
        }
    });
</script>
@endpush

@endsection 