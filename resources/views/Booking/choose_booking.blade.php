<?php
session_start();


$gambar = [
    [
        'src' => asset('images/pict-car1.jpg'),
        'caption' => 'HotelOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/pict-car2.jpg'),
        'caption' => 'HotelOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/pict-car3.jpg'),
        'caption' => 'HotelOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/pict-car4.jpeg'),
        'caption' => 'HotelOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/pict-car5.jpg'),
        'caption' => 'HotelOlangKaya Babarsari - Yogyakarta'
    ],
];

$gambar2 = [
    [
        'src' => asset('images/hall1.png'),
        'caption' => 'HallOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/hall2.png'),
        'caption' => 'HallOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/hall3.png'),
        'caption' => 'HallOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/hall4.png'),
        'caption' => 'HallOlangKaya Babarsari - Yogyakarta'
    ],
    [
        'src' => asset('images/hall5.png'),
        'caption' => 'HallOlangKaya Babarsari - Yogyakarta'
    ],
]

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userStyle/chooseBooking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home Page</title>
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
    <div class="pemisah1">
    <h2 style="text-align: center; color: #824D69;"><strong>Room Reservation</strong></h2>
    <hr style="background-color: #824D69; height: 5px; border: none; max-width: 1000px; margin: 0 auto;">
    <br>
        <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach($gambar as $i => $gbr): ?>
                    <button 
                        type="button"
                        data-bs-target="#carousel1"  
                        data-bs-slide-to="<?php echo $i; ?>"
                        class="<?php echo $i === 0 ? "active" : ""; ?>"
                        aria-label="Slide <?php echo $i + 1; ?>">
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($gambar as $i => $gbr): ?>
                    <div class="carousel-item <?php echo $i === 0 ? "active" : ""; ?>">
                        <img
                            src="<?php echo $gbr['src']; ?>"
                            class="carousel-img w-100"
                            role="img"
                            aria-label="Gambar ke-<?php echo ($i + 1); ?>"
                            focusable="false">
                        <div class="carousel-caption">
                            <h1><?php echo $gbr['caption']; ?></h1>
                            <a href="{{ route('choose_room') }}" class="btn">Book Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next"> 
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="pemisah2">
    <h2 style="text-align: center; color: #824D69;"><strong>Hall Reservation</strong></h2>
    <hr style="background-color: #824D69; height: 5px; border: none; max-width: 1000px; margin: 0 auto;">
    <br>
        <div id="carousel2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach($gambar2 as $i => $gbr): ?>
                    <button 
                        type="button"
                        data-bs-target="#carousel2" 
                        data-bs-slide-to="<?php echo $i; ?>"
                        class="<?php echo $i === 0 ? "active" : ""; ?>"
                        aria-label="Slide <?php echo $i + 1; ?>">
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($gambar2 as $i => $gbr): ?>
                    <div class="carousel-item <?php echo $i === 0 ? "active" : ""; ?>">
                        <img
                            src="<?php echo $gbr['src']; ?>"
                            class="carousel-img w-100"
                            role="img"
                            aria-label="Gambar ke-<?php echo ($i + 1); ?>"
                            focusable="false">
                        <div class="carousel-caption">
                            <h1><?php echo $gbr['caption']; ?></h1>
                            <a href="{{ route('choose_hall_package') }}" class="btn">Book Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel2" data-bs-slide="next"> 
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
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
                    <input type="text" class="form-control" placeholder="Email Adress" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">OK</button>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper_script.min.js') }} "></script>
</body>
</html>