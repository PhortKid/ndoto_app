<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Wishlist - {my.app}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Custom style -->
    <link rel="stylesheet" href="css/skilline.css" />
    <!-- Poppins font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-cream">
        <div class="container">
            <a class="navbar-brand position-relative" href="#">
                <span class="position-relative z-3">{my.app}</span>
                <svg class="position-absolute z-2" style="top: -8px; left: -12px;" width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M35.2574 2.24264C37.6005 -0.100501 41.3995 -0.100505 43.7426 2.24264L76.7574 35.2574C79.1005 37.6005 79.1005 41.3995 76.7574 43.7426L43.7426 76.7574C41.3995 79.1005 37.6005 79.1005 35.2574 76.7574L2.24264 43.7426C-0.100501 41.3995 -0.100505 37.6005 2.24264 35.2574L35.2574 2.24264Z" fill="#65DAFF"/>
                </svg>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-light" href="/login">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-warning" href="/register">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-cream py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold text-dark">
                    {{ $user->name }}'s Wishlist
                </h1>
                <p class="lead text-muted">
                    Choose a gift to make their day special!
                </p>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Details</th>
                            <th scope="col">Status</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        @if($item->image)
                                            <img class="rounded" src="{{ asset('image/' . $item->image) }}" alt="{{ $item->name }}" style="width: 64px; height: 64px; object-fit: cover;">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-medium">{{ $item->name }}</div>
                                        <div class="small text-muted text-truncate" style="max-width: 200px;">{{ $item->note }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($item->is_unlimited == '1')
                                    <span class="text-primary">Unlimited Stock</span>
                                @else
                                    <span class="text-muted">{{ $item->quantity }} left</span>
                                @endif
                            </td>
                            <td>
                                @if($item->is_active == '1')
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-danger">Purchased</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-warning">Tsh{{ number_format($item->price, 2) }}</span>
                            </td>
                            <td>
                                @if($item->is_active == '1')
                                    <a  
                                       class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Purchase{{$item->id}}">
                                        Purchase Gift
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        Already Purchased
                                    </button>
                                @endif
                            </td>
                        </tr>


                        <div class="modal fade" id="Purchase{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$item->name}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <form action="" method="post">

                               <div class="mb-3">
                                    <label for="">Purchase Anonymous</label>
                                    <input type="checkbox" {{--class="form-control"--}} id="anonymous">
                                 </div>

                                 <div class="mb-3 form-group">
                                    <label for="">Your name</label>
                                    <input type="text" class="form-control">
                                 </div>
                                 <div class="mb-3 ">
                                    <label for="">Your Phone number</label>
                                    <input type="text" class="form-control">
                                 </div>

                                 <div class="mb-3 form-grou">
                                    <label for="">Quantity</label>
                                    <input type="number" class="form-control">
                                 </div>
                                 
                               </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-warning">Purchase</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    @if($items->isEmpty())
    <div class="container py-5">
        <div class="text-center">
            <i class="fas fa-gift fa-3x text-muted mb-3"></i>
            <h3 class="h5">No items</h3>
            <p class="text-muted">This wishlist is empty at the moment.</p>
        </div>
    </div>
    @endif

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>



    <!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Purchase{{$item->id}}">
  Launch static backdrop modal
</button>-->

<!-- Modal -->


    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} {my.app}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Toast notification
        window.addEventListener('notify', function(e) {
            const toast = new bootstrap.Toast(document.getElementById('toast'));
            document.querySelector('.toast-body').textContent = e.detail;
            toast.show();
        });
    </script>

<script>
$(document).ready(function() {
    // Check the checkbox state on page load
    if($('#anonymous').prop('checked')) {
        $('.form-group').hide();  // Hide form elements if checkbox is checked
    } else {
        $('.form-group').show();  // Show form elements if checkbox is not checked
    }

    // When the checkbox state changes, update the form-group visibility
    $('#anonymous').change(function() {
        if($(this).prop('checked')) {
            $('.form-group').hide();  // Hide form elements if checked
        } else {
            $('.form-group').show();  // Show form elements if unchecked
        }
    });

    // Optionally, check the checkbox programmatically
    $('#anonymous').prop("checked", false);
});
</script>

</body>
</html>
