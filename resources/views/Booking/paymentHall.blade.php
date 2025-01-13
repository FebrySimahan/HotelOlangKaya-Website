<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userStyle/processRoom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home Page</title>
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
                            <a class="nav-link active" aria-current="page" href="{{ route('choose_booking') }}"
                                id="booking-link">Booking</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('login') }}" id="login-link">Booking</a>
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
        <div class="pemisah1">
            <h2 style="text-align: center; color: #824D69; margin-right: 70%;"><strong>Hotel Booking</strong></h2>
            <hr style="background-color: #824D69; height: 5px; border: none; max-width: 1300px; margin: 0 auto;">
            <br>
            <div class="container booking-container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="height:100%">
                            <div class="card-body">
                                <form action="{{ route('paymentForHall', ['id' => session('id_booking')]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <h4 class="card-title text-center">Payment</h4>
                                    <div class="payment-options">
                                        <h5>Payment Options</h5>
                                        <hr>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="creditCard" value="Credit Card">
                                            <label class="form-check-label" for="creditCard">Credit Card</label>
                                            <img src="{{ asset('images/creditCard.png') }}"
                                                style="height: 20px; float: right;">
                                        </div>
                                        <hr>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="bcaVA" value="BCA Virtual Account">
                                            <label class="form-check-label" for="bcaVA">BCA Virtual Account</label>
                                            <img src="{{ asset('images/bcaVA.png') }}"
                                                style="height: 20px; float: right;">
                                        </div>
                                        <hr>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="bankTransfer" value="Bank Transfer">
                                            <label class="form-check-label" for="bankTransfer">Bank Transfer</label>
                                            <img src="{{ asset('images/bank.png') }}"
                                                style="height: 20px; float: right;">
                                        </div>
                                        <hr>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="ovo" value="OVO">
                                            <label class="form-check-label" for="ovo">OVO</label>
                                            <img src="{{ asset('images/ovo.png') }}"
                                                style="height: 20px; float: right;">
                                        </div>
                                        <hr>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="indodana" value="Indodana">
                                            <label class="form-check-label" for="indodana">Indodana</label>
                                            <img src="{{ asset('images/indodana.png') }}"
                                                style="height: 20px; float: right;">
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="price-detail mt-4" style="font-size:73%">
                                        <h5>Price Detail</h5>
                                        <div class="d-flex justify-content-between">
                                            <p><strong>{{ session('hallPackage')->package_name }}</strong></p>
                                            <p>IDR {{ number_format(session('hallPackage')->price, 0, ',', '.') }}</p>
                                        </div>

                                        <?php
                                        if (session('transaksi')->attendee_number > session('hallPackage')->capacity) {
                                            $extraCapacity = (session('transaksi')->attendee_number - session('hallPackage')->capacity) * 50000;
                                        } else {
                                            $extraCapacity = 0;
                                        }
                                        ?>

                                        <div class="d-flex justify-content-between">
                                            <p><strong>Extra Capacity</strong></p>
                                            <p>IDR {{ number_format($extraCapacity, 0, ',', '.') }}</p>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <p><strong>Admin Fee</strong></p>
                                            <p>IDR 10.000</p>
                                        </div>

                                        <hr>

                                        <div class="d-flex justify-content-between">
                                            <p><strong>Total Price</strong></p>
                                            <p>IDR
                                                {{ number_format(session('hallPackage')->price + $extraCapacity + 10000, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn w-100 mt-4"
                                        style="background-color: #824D69; border: none; text-decoration: none; color: white;font-weight:bold; height:35px">
                                        Continue Payment
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <div class="icon-check">
                                        <img src="{{ asset('images/sukses.png') }}" style="height: 60px"
                                            alt="Check Icon">
                                    </div>
                                    <br><br>
                                    <h2 class="modal-title">Payment Successful!</h2>
                                    <p>Hooray! You have completed your payment.</p>
                                </div>
                                <div class="modal-footer justify-content-center">

                                    <a href="{{ route('profile') }}#ongoing-transaction" class="btn w-100 mt-4"
                                        style="background-color: #824D69; border: none; text-decoration: none; color: white;font-weight:bold">Close</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="card-title text-center">Booking Detail</h4>
                                    <div class="col-4">
                                        <img src="{{ asset('AsetGambar/' . session('hallPackage')->package_picture) }}"
                                            alt="Room image" class="img-fluid" style="border-radius: 8px;">
                                    </div>
                                    <div class="col-5" style="margin-top: 2%">
                                        <p><strong>{{ session('hallPackage')->package_name }}</strong></p>
                                        <p>HotelOlangKaya Babarsari, Yogyakarta, Indonesia</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <p><strong>Event Name</strong></p>
                                    <p>{{ session('transaksi')->event_name }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p><strong>Date</strong></p>
                                    <p>{{ session('booking')->check_in_date }} -
                                        {{ session('booking')->check_out_date }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p><strong>Person</strong></p>
                                    <p>{{ session('transaksi')->attendee_number }}</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p><strong>Time</strong></p>
                                    <p>{{ session('transaksi')->start_time }} - {{ session('transaksi')->end_time }}
                                    </p>
                                </div>

                                <?php
                                $startTime = new DateTime(session('transaksi')->start_time);
                                $endTime = new DateTime(session('transaksi')->end_time);
                                $interval = $startTime->diff($endTime);
                                $hours = $interval->h + $interval->days * 24;
                                ?>

                                <div class="d-flex justify-content-end">
                                    <p><strong>{{ $hours }} Hours</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <h4 class="card-title text-center">Contact Detail</h4>

                                <div class="mb-3">
                                    <p style="margin-bottom: 0;">Bookers Name</p>
                                    <h4 style="margin-top: 5px;">{{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}</h4>
                                </div>

                                <div class="mb-3">
                                    <p style="margin-bottom: 0;">Email</p>
                                    <h4 style="margin-top: 5px;">{{ auth()->user()->email }}</h4>
                                </div>

                                <div class="mb-3">
                                    <p style="margin-bottom: 0;">Phone Number</p>
                                    <h4 style="margin-top: 5px;">{{ auth()->user()->telepon }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </main>

    <footer>
        <div class="footer-container">
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

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper_script.min.js') }} "></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let isStateChanged = false;

        history.pushState(null, null, location.href);

        window.onpopstate = function() {
            if (!isStateChanged) {
                // Tampilkan alert hanya jika belum ada perubahan state
                alert("Tidak Bisa Kembali Ke Halaman Sebelumnya");

                // Ubah flag agar perubahan state hanya terjadi sekali
                isStateChanged = true;

                // Memaksa user untuk tetap di halaman yang sama
                history.go(1);
            }
        };
    </script>

</body>

</html>
