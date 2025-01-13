<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userStyle/chooseRoom.css') }}">
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
                            <a class="nav-link active" aria-current="page" href="{{ route('choose_booking') }}">Booking</a>
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
        <br><br>
        <div class="container">
            <form id="bookingForm" action="{{ route('booking.storeRoom', auth()->user()->id_user) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-10 mx-auto">
                        <h2 style="text-align: center; color: #824D69; margin-right: 80%;"><strong>Book Date</strong>
                        </h2>
                        <hr
                            style="background-color: #824D69; height: 5px; border: none; max-width: 1400px; margin: 0 auto;">
                        <br>
                        <div class="Row" style="margin-left : 5%">

                            <div class="mb-3">
                                <label for="check_in_date" class="form-label">
                                    Booking Date
                                </label>
                                <input type="date" class="tanggalForm form-control" id="check_in_date"
                                    name="check_in_date" style="width:110%">
                            </div>

                            <div class="mb-3">
                                <label for="check_out_date" class="form-label">Check Out Date</label>
                                <input type="date" class="tanggalForm form-control" id="check_out_date"
                                    name="check_out_date" style="width:110%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-10 mx-auto">
                        <br><br>
                        <h2 style="text-align: center; color: #824D69; margin-right: 80%;"><strong>Room Type</strong>
                        </h2>
                        <hr
                            style="background-color: #824D69; height: 5px; border: none; max-width: 1400px; margin: 0 auto;">


                        @foreach ($roomTypes as $roomType)
                            <div class="card mb-3 mx-auto" style="max-width: 85%; margin-top: 20px;">
                                <div class="row g-0">
                                    <div class="col-12 col-sm-4">
                                        <img src="{{ asset('AsetGambarRoom/' . $roomType->room_picture) }}"
                                            class="img-fluid rounded-start" alt="pict"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="card-body">
                                            <h2 class="card-title">Room Type:
                                                <strong>{{ $roomType->name_type }}</strong>
                                            </h2>
                                            <p style="margin-bottom:0;">Facility:
                                                <strong>{{ $roomType->facility }}</strong>
                                            </p>
                                            {{-- <p style="margin-bottom:0;">Number of Room:
                                                <strong>{{ $roomType->number_of_room }}</strong>
                                            </p> --}}
                                            <p style="margin-bottom:0;">Max Person:
                                                <strong>{{ $roomType->maximum_people }}</strong>
                                            </p>
                                            <br>
                                            <p style="margin-bottom:0;">{{ $roomType->description }}</p>
                                            <br>
                                            <div class="d-flex flex-column align-items-end mt-auto">
                                                <p style="margin-bottom: 5px;"><strong>Price : IDR
                                                        {{ number_format($roomType->price, 2, ',', '.') }}</strong></p>
                                                <button type="button"class="btn book-now"
                                                    data-id="{{ $roomType->id_room_type }}"
                                                    style="background-color: #824D69; border: none; color:white">Book
                                                    Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
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
                    <input type="text" class="form-control" placeholder="Email Address"
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
        $(document).ready(function() {
            $(".book-now").click(function() {
                var roomTypeId = $(this).data('id');
                var checkInDate = $("#check_in_date").val();
                var checkOutDate = $("#check_out_date").val();

                if (!checkInDate || !checkOutDate) {
                    alert("Please select both check-in and check-out dates.");
                    return;
                }

                $.ajax({
                    url: '{{ route('booking.storeRoom', auth()->user()->id_user) }}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        room_type_id: roomTypeId,
                        check_in_date: checkInDate,
                        check_out_date: checkOutDate,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = response.redirect_url;
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred: " + error);
                    }
                });
            });
        });
    </script>
</body>

</html>
