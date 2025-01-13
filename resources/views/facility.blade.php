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
    <link rel="stylesheet" href="{{ asset('css/userStyle/facilityStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Profile</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: white; border-bottom: solid gray thin;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <strong>Hotel</strong><span class="text-appbar-second-color"><strong>OlangKaya</strong></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('facility') }}">Facility</a>
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
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: black; border: none;">
                                <img src="{{ asset('AsetGambar/'.auth()->user()->user_picture) }}" alt="Profile" class="profile-img-nav">
                                <span><strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong></span>
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
                        <a href="{{ route('login') }}" style="text-decoration: none; color: white; border-bottom: 2px solid white;">
                            <strong>Login</strong>
                        </a>
                    </button>
                @endauth
            </div>
        </div>
    </nav>
    
    <main>
    <br>
    <h2 style="text-align: center; color: #824D69;"><strong>OUR FACILITY</strong></h2>
    <hr style="background-color: #824D69; height: 5px; border: none; max-width: 1000px; margin: 0 auto;">
    <br>
        <div class="main-container">
            <div class="image-preview">
                <img src="{{ asset('images/pict-facility6.png') }}" alt="">
                <span class="overlay">
                    <div class="desc">
                        <h1>Best Luxury Room</h1>
                        <p style="text-align: justify;">Feel the best luxury room in town with affordable price for your pocket</p>
                    </div>
                </span>
            </div>
            <div class="image-preview">
                <img src="{{ asset('images/pict-facility1.png') }}" alt="">
                <span class="overlay">
                    <div class="desc">
                        <h1>Amazing Hall</h1>
                        <p style="text-align: justify;">Make your moment with our amazing hotel's hall</p>
                    </div>
                </span>
            </div>
            <div class="image-preview">
                <img src="{{ asset('images/pict-facility2.png') }}" alt="">
                <span class="overlay">
                    <div class="desc">
                        <h1>Best Service</h1>
                        <p style="text-align: justify;">We guarantee to serve you with the best services we have</p>
                    </div>
                </span>
            </div>
            <div class="image-preview">
                <img src="{{ asset('images/pict-facility3.png') }}" alt="">
                <span class="overlay">
                    <div class="desc">
                        <h1>Swimming Pool</h1>
                        <p style="text-align: justify;">Enjoy your relax time with our clean and luxury pool</p>
                    </div>
                </span>
            </div>
            <div class="image-preview">
                <img src="{{ asset('images/pict-facility4.png') }}" alt="">
                <span class="overlay">
                    <div class="desc">
                        <h1>Gym</h1>
                        <p style="text-align: justify;">Stay fit even at your vacation. Feel free to use our gym with the best equipment ever</p>
                    </div>
                </span>
            </div>
            <div class="image-preview">
                <img src="{{ asset('images/pict-facility5.png') }}" alt="">
                <span class="overlay">
                    <div class="desc">
                        <h1>Bar</h1>
                        <p style="text-align: justify;">Enjoy your night with us in our bar. Make a wonderful moment with our amazing drinks</p>
                    </div>
                </span>
            </div>
        </div>
    </main>
    <br><br><br><br><br><br><br><br><br><br>
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
                    <input type="text" class="form-control" placeholder="Email Adress" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">OK</button>
                </div>
            </div>
        </div>
    </footer>
</body>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/swiper_script.min.js') }} "></script>
<script>
    const mainContainer = document.querySelector(".main-container"),
    imagePreview = document.querySelectorAll(".image-preview"),
    image = document.querySelectorAll(".image-preview img");

    window.onload = () => {
        const setOpacity = (opacity) => image.forEach(img => img.style.opacity = opacity);
        
        mainContainer.onmouseenter = () => setOpacity(0.2);
        mainContainer.onmouseleave = () => setOpacity(1);

        gsap.fromTo(imagePreview,
            {clipPath: "polygon(0 100%, 100% 100%, 100% 100%, 0 100%)", opacity: 0},
            {duration: 1.5, clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)", opacity: 1, stagger: 0.2, ease: "power2.out"}
        );
    };
</script>
</html>