<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userStyle/profileStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Profile</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: white; border-bottom: solid gray thin;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <strong>Hotel</strong><span class="text-appbar-second-color"><strong>OlangKaya</strong></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('facility') }}">Facility</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('choose_booking') }}">Booking</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('login') }}">Booking</a>
                        </li>
                    @endauth
                </ul>
            </div>

            <div class="d-flex">
                @auth
                    <div>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="background-color: white; color: black; border: none;">
                                <img src="{{ asset('AsetGambar/' . auth()->user()->user_picture) }}" alt="Profile"
                                    class="profile-img-nav">
                                <span><strong>{{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}</strong></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li>
                                    <form action="{{ route('user.logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <button type="button" class="btn btn-primary me-2" style="background-color: #824D69; border: none;">
                        <a href="{{ route('register') }}" style="text-decoration: none; color: white;">
                            <strong>Register</strong>
                        </a>
                    </button>
                    <button type="button" class="btn btn-primary" style="background-color: #824D69; border: none;">
                        <a href="{{ route('login') }}"
                            style="text-decoration: none; color: white; border-bottom: 2px solid white;">
                            <strong>Login</strong>
                        </a>
                    </button>
                @endauth
            </div>
        </div>
    </nav>
    <main>
        <div style="background-color: white;">
            <div class="container">
                <div class="shadow p-4" style="max-width: 1000px; margin: auto;">
                    <div style="background-color: white;">
                        <form action="{{ route('user.update', auth()->user()->id_user) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="container profile-section">
                                <div class="position-relative d-inline-block">
                                    <img id="profilePreview"
                                        src="{{ asset('AsetGambar/' . auth()->user()->user_picture) }}"
                                        alt="Profile Picture" class="profile-img">
                                    <input type="file" id="profilePictureInput" name="user_picture" class="d-none"
                                        onchange="previewImage()">
                                    <div class="edit-icon"
                                        onclick="document.getElementById('profilePictureInput').click();">
                                        <i class="fas fa-pen"></i>
                                    </div>
                                </div>
                                <div class="profile-name">{{ auth()->user()->first_name }}
                                    {{ auth()->user()->last_name }}</div>
                            </div>
                            <br><br>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-md-10 mx-auto">
                                        <h2>Edit Profile</h2>
                                        <hr>
                                        <div class="form-group">
                                            <label for="firstName" class="form-label"><strong>First
                                                    Name</strong></label>
                                            <div class="input-group input-group-lg">
                                                <input type="text" id="firstName" name="first_name"
                                                    class="form-control" aria-label="First Name"
                                                    aria-describedby="inputGroup-sizing-lg"
                                                    value="{{ old('first_name', auth()->user()->first_name) }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="lastName" class="form-label"><strong>Last
                                                    Name</strong></label>
                                            <div class="input-group input-group-lg">
                                                <input type="text" id="lastName" name="last_name"
                                                    class="form-control" aria-label="Last Name"
                                                    aria-describedby="inputGroup-sizing-lg"
                                                    value="{{ old('last_name', auth()->user()->last_name) }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="email" class="form-label"><strong>Email</strong></label>
                                            <div class="input-group input-group-lg">
                                                <input type="email" id="email" name="email"
                                                    class="form-control" aria-label="Email"
                                                    aria-describedby="inputGroup-sizing-lg"
                                                    value="{{ old('email', auth()->user()->email) }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="notel" class="form-label"><strong>Nomor
                                                    Telepon</strong></label>
                                            <div class="input-group input-group-lg">
                                                <input type="text" id="notel" name="telepon"
                                                    class="form-control" aria-label="Nomor Telepon"
                                                    aria-describedby="inputGroup-sizing-lg"
                                                    value="{{ old('telepon', auth()->user()->telepon) }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row mb-3">
                                            <div class="col-md-16 mx-auto text-end">
                                                <button type="submit" class="btn btn-primary"
                                                    style="background-color: #824D69; border: none;">
                                                    <strong>Save Changes</strong>
                                                </button>
                                            </div>
                                        </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-10 mx-auto">
                        <h2>Change Password</h2>
                        <hr>
                        <div class="form-group">
                            <label for="currPass" class="form-label"><strong>Current Password</strong></label>
                            <div class="input-group input-group-lg">
                                <input type="password" id="currPass" class="form-control"
                                    aria-label="Current Password" aria-describedby="inputGroup-sizing-lg">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="newPass" class="form-label"><strong>New Password</strong></label>
                            <div class="input-group input-group-lg">
                                <input type="password" id="newPass" class="form-control" aria-label="New Password"
                                    aria-describedby="inputGroup-sizing-lg">
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-10 mx-auto text-end">
                        <button type="button" class="btn btn-primary"
                            style="background-color: #824D69; border: none;">
                            <strong>Change Password</strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

        <br><br><br>
        <div style="background-color: #2A114B;">
            <div class="container">
                <!-- On Going Transactions -->
                <div class="row mb-3">
                    <div class="col-md-10 mx-auto">
                        <br><br>
                        <h2 style="color: #DFB6B2">On Going Transaction</h2>
                        <hr style="background-color: #DFB6B2; height: 3px; border: none;">

                        @foreach ($unpaidBookings as $booking)
                            @if ($booking->id_hall_package)
                                <!-- Cek apakah ini transaksi hall -->
                                <div class="card mb-3 mx-auto" style="width: 85%; margin-top: 20px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="width: 250px">
                                            <img src="{{ asset('AsetGambar/' . $booking->package_picture) }}"
                                                class="img-fluid rounded-start" alt="pict"
                                                style="width: 300px; height: 100%">
                                        </div>
                                        <div class="col-md-8" style="margin-left: 0px;">
                                            <div class="card-body">
                                                <h2 class="card-title"><strong>{{ $booking->package_name }}</strong>
                                                </h2> <!-- Tampilkan package_name untuk hall -->
                                                <p style="margin-bottom:0;">Booking Date :
                                                    <strong>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d/m/Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d/m/Y') }}</strong>
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-end flex-column"
                                                style="margin-top: auto;">
                                                <p class="text-end" style="margin-bottom: 0;">Attendee Number:
                                                    <strong>{{ $booking->attendee_number }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0;">Payment Method:
                                                    <strong>{{ $booking->payment_method }}</strong>
                                                </p>
                                                <div class="d-flex">
                                                    <p class="text-end" style="margin-bottom: 0;">Total Price:
                                                        <strong>{{ number_format($booking->total_price, 2) }}</strong>
                                                    </p>
                                                    <a href="{{ route('paymentHall', ['id' => $booking->id_booking]) }}"
                                                        class="btn btn-danger me-2">Unpaid</a>
                                                    <button type="button" class="btn btn-secondary"
                                                        style="background-color: #824D69;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($booking->id_room)
                                <!-- Cek apakah ini transaksi room -->
                                <div class="card mb-3 mx-auto" style="width: 85%; margin-top: 20px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="width: 250px">
                                            <img src="{{ asset('AsetGambarRoom/' . $booking->room_picture) }}"
                                                class="img-fluid rounded-start" alt="pict"
                                                style="width: 300px; height: 100%">
                                        </div>
                                        <div class="col-md-8" style="margin-left: 0px;">
                                            <div class="card-body">
                                                <h2 class="card-title"><strong>{{ $booking->name_type }}</strong></h2>
                                                <!-- Tampilkan name_type untuk room -->
                                                <p style="margin-bottom:0;">Booking Date :
                                                    <strong>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d/m/Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d/m/Y') }}</strong>
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-end flex-column"
                                                style="margin-top: auto;">
                                                <p class="text-end" style="margin-bottom: 0;">Extra Bed:
                                                    <strong>{{ $booking->extra_bed }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0;">Payment Method:
                                                    <strong>{{ $booking->payment_method }}</strong>
                                                </p>
                                                <div class="d-flex">
                                                    <a href="{{ route('paymentRoom', ['id' => $booking->id_booking]) }}"
                                                        class="btn btn-danger me-2">Unpaid</a>
                                                    <button type="button" class="btn btn-secondary"
                                                        style="background-color: #824D69;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Transaction History -->
                <div class="row mb-3">
                    <div class="col-md-10 mx-auto">
                        <br><br>
                        <h2 style="color: #DFB6B2">Transaction History</h2>
                        <hr style="background-color: #DFB6B2; height: 3px; border: none;">

                        @foreach ($paidBookings as $booking)
                            @if ($booking->id_hall_package)
                                <!-- Cek apakah ini transaksi hall -->
                                <div class="card mb-3 mx-auto" style="width: 85%; margin-top: 20px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="width: 250px">
                                            <img src="{{ asset('AsetGambar/' . $booking->package_picture) }}"
                                                class="img-fluid rounded-start" alt="pict"
                                                style="width: 300px; height: 100%">
                                        </div>
                                        <div class="col-md-8" style="margin-left: 0px;">
                                            <div class="card-body">
                                                <h2 class="card-title"><strong>{{ $booking->package_name }}</strong>
                                                </h2>
                                                <p style="margin-bottom:0;">Booking Date :
                                                    <strong>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d/m/Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d/m/Y') }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0;">Attendee Number:
                                                    <strong>{{ $booking->attendee_number }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0;">Payment Method:
                                                    <strong>{{ $booking->payment_method }}</strong>
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-end flex-column"
                                                style="margin-top: auto;">
                                                <p class="text-end" style="margin-bottom: 0;">Total Price:
                                                    <strong>{{ number_format($booking->total_price, 2) }}</strong>
                                                </p>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-success me-2">Paid</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        style="background-color: #824D69;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($booking->id_room)
                                <!-- Cek apakah ini transaksi room -->
                                <div class="card mb-3 mx-auto" style="width: 85%; margin-top: 20px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="width: 250px">
                                            <img src="{{ asset('AsetGambarRoom/' . $booking->room_picture) }}"
                                                class="img-fluid rounded-start" alt="pict"
                                                style="width: 300px; height: 100%">
                                        </div>
                                        <div class="col-md-8" style="margin-left: 0px;">
                                            <div class="card-body">
                                                <h2 class="card-title"><strong>{{ $booking->name_type }}</strong></h2>
                                                <!-- Tampilkan name_type untuk room -->
                                                <p style="margin-bottom:0;">Booking Date :
                                                    <strong>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d/m/Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d/m/Y') }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0;">Extra Bed:
                                                    <strong>{{ $booking->extra_bed }}</strong>
                                                </p>
                                                <p style="margin-bottom: 0;">Payment Method:
                                                    <strong>{{ $booking->payment_method }}</strong>
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-end flex-column"
                                                style="margin-top: auto;">
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-success me-2">Paid</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        style="background-color: #824D69;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </main>
    <br><br><br><br><br>
    <footer>
        <div class="footer-container" style="background-color: #2A114B;">
            <div class="footer-content-container">
                <h5 style="color: white;">
                    Hotel
                    <span class="footer-title-hotelname">OlangKaya</span>
                </h5>
                <p style="color: white;">497 Evergreen Rd. Roseville, CA 95673</p>
                <p style="color: white;">+44 345 678 903</p>
                <p style="color: white;">hotelolangkaya@gmail.com</p>
            </div>
            <div class="footer-content-container">
                <ul>
                    <li>About Us</li>
                    <li>Contact</li>
                    <li>Terms & Condition</li>
                </ul>
            </div>
            <div class="footer-content-container">
                <ul>
                    <li>
                        <img src="{{ asset('images/facebook-icon.svg') }}" alt="">
                        Facebook
                    </li>
                    <li>
                        <img src="{{ asset('images/twitter-icon.svg') }}" alt="">
                        Twitter
                    </li>
                    <li>
                        <img src="{{ asset('images/instagram-icon.svg') }}" alt="">
                        Instagram
                    </li>
                </ul>
            </div>
            <div class="footer-content-container">
                <h6 style="color: white;">Subscribe to our newslater</h6>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email Adress"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">OK</button>
                </div>
            </div>
        </div>
    </footer>
</body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #563d7c;">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #DFB6B2;"><strong>Detail
                        Pemesanan</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Ini adalah detail pemesanan anda...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="background-color: #824D69;">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/swiper_script.min.js') }} "></script>
<script>
    window.onload = function() {
        if (window.location.hash) {
            var element = document.querySelector(window.location.hash);
            if (element) {
                window.scrollTo({
                    top: element.offsetTop,
                    behavior: 'smooth'
                });
            }
        }
    };
</script>

<script>
    function previewImage() {
        const file = document.getElementById('profilePictureInput').files[0];
        const reader = new FileReader();

        reader.onloadend = function() {
            document.getElementById('profilePreview').src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file); // This will trigger the onloadend event
        }
    }
</script>

</html>
