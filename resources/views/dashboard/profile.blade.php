@extends('dashboard_layouts.app')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <!-- Profile Overview Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="text-center mb-4">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle img-fluid border border-2 border-white" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-white shadow mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-user text-dark text-gradient" style="font-size: 40px;"></i>
                            </div>
                        @endif
                        <h5 class="text-white font-weight-bolder mt-3 mb-0">{{ Auth::user()->name }}</h5>
                        <p class="text-white text-sm mb-0">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-sm bg-white text-dark mb-0" onclick="document.getElementById('avatar-input').click();">
                            <i class="fas fa-camera me-2"></i> Change Photo
                        </button>
                        <input type="file" id="avatar-input" class="d-none" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Stats -->
        <div class="col-lg-8 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-calendar text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ Auth::user()->created_at->format('M Y') }}</h5>
                            <span class="text-white text-sm">Member Since</span>
                        </div>
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-list text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ $totalItems ?? 0 }}</h5>
                            <span class="text-white text-sm">Total Items</span>
                        </div>
                        <div class="col-4 text-center">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-2xl mb-3">
                                <i class="fas fa-check-circle text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0">{{ $completedItems ?? 0 }}</h5>
                            <span class="text-white text-sm">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Settings -->
    <div class="row mt-4">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Profile Settings</h6>
                </div>
                <div class="card-body pt-4">
                    <form action="{{ route('profile.update',Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Bio</label>
                                    <textarea class="form-control" name="bio" rows="3">{{ Auth::user()->bio ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-primary mt-4">Save Changes</button>
                    </form>

                    <!-- Change Password -->
                    <hr class="horizontal dark my-4">
                    <h6 class="mb-3">Change Password</h6>
                    <form action="{{ route('profile.update',Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">New Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark mt-4">Update Password</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Notifications</h6>
                </div>
                <div class="card-body pt-4">
                  {{--  <form action="{{ route('profile.notifications',Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailNotif" name="email_notifications" {{ Auth::user()->email_notifications ? 'checked' : '' }}>
                            <label class="form-check-label" for="emailNotif">Email Notifications</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="itemUpdates" name="item_updates" {{ Auth::user()->item_updates ? 'checked' : '' }}>
                            <label class="form-check-label" for="itemUpdates">Item Updates</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="securityAlerts" name="security_alerts" {{ Auth::user()->security_alerts ? 'checked' : '' }}>
                            <label class="form-check-label" for="securityAlerts">Security Alerts</label>
                        </div>
                        <button type="submit" class="btn bg-gradient-info w-100">Save Preferences</button>
                    </form>--}}

                    <hr class="horizontal dark my-4">

                    <!-- Account Actions -->
                    <div class="text-center">
                        <h6 class="mb-3">Account Actions</h6>
                       
                        <button class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                            <i class="fas fa-trash-alt me-2"></i> Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Avatar upload preview
    document.getElementById('avatar-input').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.rounded-circle.img-fluid').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endpush

@endsection 