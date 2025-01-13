<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userStyle/transaksiHall.css') }}">
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
            <h2 style="text-align: center; color: #824D69; margin-right: 59%;"><strong>Hall Package Booking</strong>
            </h2>
            <hr style="background-color: #824D69; height: 5px; border: none; max-width: 1300px; margin: 0 auto;">
            <br>
            <div class="container booking-container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Fill in Data</h5>
                                <br>
                                <h3>Contact Detail</h3>
                                <br>
                                <form onsubmit="return validateForm()">

                                    <div class="mb-3">
                                        <label for="namaInput" class="form-label">Bookers Name</label>
                                        <input class="form-control" type="text" name="booker_name"
                                            value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
                                            readonly style="width:100%;">
                                    </div>


                                    <div class="mb-3">
                                        <label for="tanggalInput" class="form-label">Phone Number</label>
                                        <input class="form-control" type="text" name="phone_number"
                                            value="{{ auth()->user()->telepon }}" readonly style="width:100%;">
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input class="form-control" type="text" name="email"
                                            value="{{ auth()->user()->email }}" readonly style="width:100%;">
                                    </div>
                                </form>
                                <br>

                                <h3>Form</h3>

                                <br>
                                <div class="container">
                                    <h3>Booking Hall: {{ $hallPackages->package_name }}</h3>
                                    <form id="cancelForm" action="{{ route('transaksi_hall.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_booking" value="{{ $booking->id_booking }}">
                                        <input type="hidden" name="id_hall_package"
                                            value="{{ $hallPackages->id_hall_package }}">

                                        <div class="mb-3">
                                            <label for="event_name"
                                                class="form-label @error('event_name') is-invalid @enderror">Event
                                                Name</label>
                                            <input type="text" class="form-control" id="event_name"
                                                name="event_name" required>
                                            @error('event_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="attendee_number" class="form-label">Attendees Number</label>
                                            <input type="number"
                                                class="form-control @error('attendee_number') is-invalid @enderror"
                                                id="attendees_number" name="attendee_number" required>
                                            @error('attendee_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="start_time" class="form-label">Start Time</label>
                                            <input type="time"
                                                class="form-control @error('start_time') is-invalid @enderror"
                                                id="start_time" name="start_time" required>
                                            @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="end_time" class="form-label">End Time</label>
                                            <input type="time"
                                                class="form-control @error('end_time') is-invalid @enderror"
                                                id="end_time" name="end_time" required>
                                            @error('end_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="button-container"
                                            style="display: flex; justify-content: space-between; gap: 10px;">
                                            <button type="submit"
                                                style="background-color: #824D69; border: none; text-decoration: none; color: white; font-weight: bold; border-radius: 5px; width: 390px; height: 50px">
                                                Continue Payment
                                            </button>

                                            <button type="button" id="cancelBookingButton"
                                                style="background-color: #824D69; border: none; text-decoration: none; color: white; font-weight: bold; border-radius: 5px; width: 390px;">
                                                Cancel Booking
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Event Package Booking</h5>
                                <div class="text-center mb-3">
                                    <img src="{{ asset('AsetGambar/' . $hallPackages->package_picture) }}"
                                        alt="Room image" class="img-fluid" style="border-radius: 8px;width:40%">
                                    <br><br>
                                    <p style="margin-bottom: 0;"><strong>{{ $hallPackages->package_name }}</strong>
                                    </p>
                                    <p style="margin-top: 5px;">HotelOlangKaya Babarsari, Yogyakarta, Indonesia</p>
                                </div>
                                <hr>

                                <div class="d-flex justify-content-between">
                                    <p><strong>Facility</strong></p>
                                    <p style="text-align: right; max-width: 500px">{{ $hallPackages->facility }}</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p><strong>Capacity</strong></p>
                                    <p>{{ $hallPackages->capacity }} Person</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p><strong>Date</strong></p>
                                    <p>{{ $booking->check_in_date }} - {{ $booking->check_out_date }}</p>
                                </div>

                                <hr>

                                <h5><strong>Price</strong></h5>
                                <div class="d-flex justify-content-between">
                                    <p>{{ $hallPackages->package_name }}</p>
                                    <p><strong>IDR {{ number_format($hallPackages->price, 0, ',', '.') }}</strong></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
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

    {{-- Modal jika klik navbar --}}
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Selesaikan Transaksi Terlebih Dahulu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda belum menyelesaikan transaksi. Silakan selesaikan transaksi terlebih dahulu untuk
                        melanjutkan ke halaman berikutnya.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper_script.min.js') }} "></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Untuk menonaktifkan navbar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navbarLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    if (event.target.href && !event.target.href.includes('choose_booking') && !event
                        .target.href.includes('transaksi_hall')) {
                        event.preventDefault();
                        var modal = new bootstrap.Modal(document.getElementById(
                        'transactionModal'));
                        modal.show();
                    }
                });
            });
            const dropdownItems = document.querySelectorAll('.dropdown-item');

            dropdownItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    if (event.target && event.target.textContent !== 'Profile' && event.target
                        .textContent !== 'Logout') {
                        event.preventDefault();
                        var modal = new bootstrap.Modal(document.getElementById(
                        'transactionModal'));
                        modal.show();
                    }
                });
            });
        });
    </script>

    {{-- Script untuk mencegah back --}}
    <script>
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, null, window.location.href);
            alert("Anda tidak bisa kembali ke halaman sebelumnya");
        };
    </script>

    {{-- Script untuk validasi form jika pilih batal booking --}}
    <script>
        document.getElementById('cancelBookingButton').addEventListener('click', function() {
            var bookingId = document.querySelector('input[name="id_booking"]').value;

            var form = document.createElement('form');
            form.method = 'POST';
            form.action = /transaksi_hall/$ {
                bookingId
            };

            var csrfToken = document.querySelector('input[name="_token"]').value;
            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);

            var methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        });
    </script>

</body>

</html>
