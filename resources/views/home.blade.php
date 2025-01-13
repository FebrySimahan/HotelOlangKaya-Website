<?php
session_start();

$gambar = [
    asset('images/pict-car1.jpg'),
    asset('images/pict-car2.jpg'),
    asset('images/pict-car3.jpg'),
    asset('images/pict-car4.jpeg'),
    asset('images/pict-car5.jpg')
];

$gambar2 = [
    asset('images/pict-car-hotelist1.jpg'),
    asset('images/pict-car-hotelist2.jpg'),
    asset('images/pict-car-hotelist3.jpeg'),
    asset('images/pict-car-hotelist4.jpeg'),
    asset('images/pict-car-hotelist5.jpg'),
    asset('images/pict-car-hotelist6.jpg')
]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userStyle/homeStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
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
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach($gambar as $i => $gbr): ?>
                    <button 
                        type="button"
                        data-bs-target="#myCarousel"
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
                            src="<?php echo $gbr; ?>"
                            class="carousel-img w-100"
                            role="img"
                            aria-label="Gambar ke-<?php echo ($i + 1); ?>"
                            focusable="false">
                        <div class="carousel-caption">
                            <h1>HotelOlangKaya Babarsari - Yogyakarta</h1>
                            <?php if (isset($_SESSION["user"])): ?>
                                <a href="{{ route('choose_booking') }}" class="btn">Book Now</a>
                            <?php else: ?>
                                <a href="{{ route('login') }}" class="btn">Book Now</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next"> 
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div style="background-color: white;">
            <br><br><br>
            <h2 style="text-align: center; color: #824D69;">MOST PICKED</h2>
            <h5 style="text-align: center; color: grey;">Book hotels as based upon experienced the best booking ever. Highly recommended!</h5>
            <br>
            <div class="container-card swiper">
                <div class="card-wrapper">
                    <ul class="card-list swiper-wrapper">
                        <li class="card-item swiper-slide">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/pict-car-hotelist1.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>HotelOlangKaya Purbalingga.</strong>
                                        <span class="location">Jawa Tengah</span>
                                        <span class="rating-icon">
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                        </span>
                                        <span class="rating-sum">(20k)</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="card-item swiper-slide">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/pict-car-hotelist2.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>HotelOlangKaya Jambi.</strong>
                                        <span class="location">Jambi</span>
                                        <span class="rating-icon">
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                        </span>
                                        <span class="rating-sum">(12k)</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="card-item swiper-slide">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/pict-car-hotelist3.jpeg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>HotelOlangKaya Babarsari.</strong>
                                        <span class="location">Daerah Istimewa Yogyakarta</span>
                                        <span class="rating-icon">
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                        </span>
                                        <span class="rating-sum">(65k)</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="card-item swiper-slide">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/pict-car-hotelist4.jpeg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>HotelOlangKaya Jakarta.</strong>
                                        <span class="location">Daerah Khusus Jakarta</span>
                                        <span class="rating-icon">
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                        </span>
                                        <span class="rating-sum">(87k)</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="card-item swiper-slide">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/pict-car-hotelist5.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>HotelOlangKaya Canggu.</strong>
                                        <span class="location">Bali</span>
                                        <span class="rating-icon">
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                        </span>
                                        <span class="rating-sum">(77k)</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="card-item swiper-slide">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/pict-car-hotelist6.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>HotelOlangKaya Surabaya.</strong>
                                        <span class="location">Jawa Timur</span>
                                        <span class="rating-icon">
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                            <i class="fas fa-star fa-xs"></i>
                                        </span>
                                        <span class="rating-sum">(69k)</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <br>
            </div>
            <br><br>  
        </div>
        <div>
            <br><br><br>
            <h2 style="text-align: center; color: #DFB6B2;">MOST PICKED</h2>
            <h5 style="text-align: center; color: #DFB6B2;">Book hotels as based upon experienced the best booking ever. Highly recommended!</h5>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card" style="background-color: #DFB6B2;">
                            <div class="card-body">
                                <img src="{{ asset('images/briefcase-icon.svg') }}" class="icon-card mb-3">
                                <h5 class="card-title">Flexible Living</h5>
                                <p class="card-text">Stay as Long or as little as you need.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card" style="background-color: #DFB6B2;">
                            <div class="card-body">
                                <img src="{{ asset('images/home-icon.svg') }}" class="icon-card mb-3">
                                <h5 class="card-title">Move-in Ready</h5>
                                <p class="card-text">Ready to move in with everything you need.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card" style="background-color: #DFB6B2;">
                            <div class="card-body">
                                <img src="{{ asset('images/wifi-icon.svg') }}" class="icon-card mb-3">
                                <h5 class="card-title">High-speed Wifi</h5>
                                <p class="card-text">Best in class internet speeds suitable for working from home.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card" style="background-color: #DFB6B2;">
                            <div class="card-body">
                                <img src="{{ asset('images/message-circle-icon.svg') }}" class="icon-card mb-3">
                                <h5 class="card-title">24/7 Support</h5>
                                <p class="card-text">On hand team with any issues you have.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center flex-wrap">
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="margin: 0 15px;">
                                <div class="card mx-auto" style="background-color: #DFB6B2;">
                                    <div class="card-body">
                                        <img src="{{ asset('images/coffee-icon.svg') }}" class="icon-card mb-3">
                                        <h5 class="card-title">Delicious Cuisine</h5>
                                        <p class="card-text">We also guarantee the most delicatessen food and drink to make your experience better.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="margin: 0 15px;">
                                <div class="card mx-auto" style="background-color: #DFB6B2;">
                                    <div class="card-body">
                                        <img src="{{ asset('images/dollar-icon.svg') }}" class="icon-card mb-3">
                                        <h5 class="card-title">Affordable Prices</h5>
                                        <p class="card-text">With best quality and great services, we offer you the most affordable price in town.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="margin: 0 15px;">
                                <div class="card mx-auto" style="background-color: #DFB6B2;">
                                    <div class="card-body">
                                        <img src="{{ asset('images/gift-icon.svg') }}" class="icon-card mb-3">
                                        <h5 class="card-title">Promos Everytime</h5>
                                        <p class="card-text">With affordable price, we also have a lot of promos and discounts to save your pocket.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center flex-wrap">
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="margin: 0 15px;">
                                <div class="card mx-auto" style="background-color: #DFB6B2;">
                                    <div class="card-body">
                                        <img src="{{ asset('images/eye-icon.svg') }}" class="icon-card mb-3">
                                        <h5 class="card-title">Privacy Safe</h5>
                                        <p class="card-text">We prioritize our guest privacy for best experience and make your stay comfortable.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" style="margin: 0 15px;">
                                <div class="card mx-auto" style="background-color: #DFB6B2;">
                                    <div class="card-body">
                                        <img src="{{ asset('images/smile-icon.svg') }}" class="icon-card mb-3">
                                        <h5 class="card-title">Guarantee Happiness</h5>
                                        <p class="card-text">We guarantee you happiness after using our services and make your best experience ever.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
        </div>
        <div style="background-color: white;">
            <br><br><br>
            <h2 style="text-align: center; color: #824D69;">What Do Our Customer Say ?</h2>
            <h5 style="text-align: center; color: grey;">Experience comfort and luxury like never before at our hotel. Book now and make your stay unforgettable !</h5>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card" style="background-color: white; border: none; align-items: center; text-align: center;">
                            <div class="card-body">
                                <img src="{{ asset('images/quote-icon.svg') }}" class="icon-card mb-3">
                                <p class="card-text">Gokil abis. Kamarnya bersih, hotelnya nyaman, fasilitas hotelnya seperti restoran, kolam renangnya lengkap banget</p>
                                <h5 class="card-title">Febry Yanto</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">febryyanto@gmail.com</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card" style="background-color: white; border: none; align-items: center; text-align: center;">
                            <div class="card-body">
                                <img src="{{ asset('images/quote-icon.svg') }}" class="icon-card mb-3">
                                <p class="card-text">Hotel ini menawarkan kenyamanan dengan fasilitas yang memadai dan pelayanan yang ramah. Lokasinya yang strategis memudahkan akses</p>
                                <h5 class="card-title">Erikolim</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">erikolim@gmail.com</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card" style="background-color: white; border: none; align-items: center; text-align: center;">
                            <div class="card-body">
                                <img src="{{ asset('images/quote-icon.svg') }}" class="icon-card mb-3">
                                <p class="card-text">Kamar-kamarnya bersih, nyaman, dan dilengkapi dengan semua kebutuhan dasar seperti Wi-Fi, televisi, dan kamar mandi yang bersih.</p>
                                <h5 class="card-title">Rizky Fabian</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">rizkyfabian@gmail.com</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card" style="background-color: white; border: none; align-items: center; text-align: center;">
                            <div class="card-body">
                                <img src="{{ asset('images/quote-icon.svg') }}" class="icon-card mb-3">
                                <p class="card-text">Secara keseluruhan, hotel ini memberikan pengalaman menginap yang memuaskan dengan harga yang sesuai, dengan fasilitas yang gacor</p>
                                <h5 class="card-title">Jessica Jane</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">jessicajane@gmail.com</h6>
                            </div>
                        </div>
                    </div>
                </div>
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
