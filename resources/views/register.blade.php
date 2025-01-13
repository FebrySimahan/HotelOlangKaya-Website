<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userStyle/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home Page</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: white; border-bottom:solid gray thin">
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
                    <?php if (isset($_SESSION["user"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('choose_booking') }}">Booking</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('login') }}">Booking</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div>
                <button type="button" class="btn btn-primary" style="background-color: #824D69; border: none;">
                    <a href="{{ route('register') }}" style="text-decoration: none; color: white; border-bottom: 2px solid white">
                        <strong>Register</strong>
                    </a>
                </button>
                <button type="button" class="btn btn-primary" style="background-color: #824D69; border: none;">
                    <a href="{{ route('login') }} " style="text-decoration: none; color: white;">
                        <strong>Login</strong>
                    </a>
                </button>
            </div>
        </div>
    </nav>

    <form action="{{ route('user.register') }}" novalidate method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Register</h1>

        <div class="mb-4">
            <label for="firstNameInput" class="form-label">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstNameInput" name="first_name" placeholder="First Name">
            @error('first_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="lastNameInput" class="form-label">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastNameInput" name="last_name" placeholder="Last Name">
            @error('last_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telepon" class="form-label">Phone Number</label>
            <input type="number" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Phone Number">
            @error('telepon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        
        <div class="mb-4">
            <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        I agree to receive promotions and updates about HotelOlangKaya 
                        and its affiliates. Unsubscribe anytime. 
                        Read more in the Privacy Policy.
                    </label>
            </div>
        </div>
        <div class="mb-4">
            <div class="d-grid gap-2">
                <button class="btn btn-secondary" type="submit" style="background-color:#4a2d56">Register</button>
            </div>
        </div>
    
        <div class="mb-4">
            <div class="divider">
                <hr>
                <span>or continue with</span>
                <hr>
            </div>
        </div>


        <div class="mb-4">
            <div class="social-login-buttons d-flex justify-content-between">
                <button type="button" class="btn tombol">
                    <i class="fab fa-google" style="color: #DB4437;"></i> Google
                </button>
                <br>
            </div>
        </div>
    
        <div class="mb-4">
            <div class="social-login-buttons d-flex justify-content-between">   
                <button type="button" class="btn  ">
                    <i class="fab fa-facebook-f" style="color: #1877F2"></i> Facebook
                </button>
                <button type="button" class="btn">
                    <i class="fab fa-apple" style="color: #000"></i> Apple
                </button>
            </div>
        </div>
        


        <div class="mb-4">
            <div class="social-login-buttons d-flex justify-content-between">
                <button type="button" class="btn tombol btn-secondary" style="background-color:#4a2d56">
                Already have an account ? <a href="{{ route('login') }}" style="color:#824D69; font-weight: bold">Login</a>
                </button>
                <br>
            </div>
        </div>

        <div class="mb-4 text-center">
            <p>By logging in, I agree to Agoda's <a href="#" style="color: #824D69;">Terms of Use</a> and <a href="#" style="color: #824D69;">Privacy Policy</a>.</p>
        </div>
    </form>         
    
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
    <script>
       const visibilityBtn = document.getElementById("visibilityBtn");
        visibilityBtn.addEventListener("click", toggleVisibility);

        function toggleVisibility() {
            const passwordInput = document.getElementById("password");

            if (passwordInput.type === "text") {
                passwordInput.type = "password";
                visibilityBtn.classList.remove("fa-eye");
                visibilityBtn.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "text";
                visibilityBtn.classList.remove("fa-eye-slash");
                visibilityBtn.classList.add("fa-eye");
            }
        }

const visibilityBtn2 = document.getElementById("visibilityBtn2");

visibilityBtn2.addEventListener("click", toggleVisibility2);

function toggleVisibility2() {
    const passwordInput2 = document.getElementById("password2");

    if (passwordInput2.type === "text") {
        passwordInput2.type = "password";
        visibilityBtn2.classList.remove("fa-eye");
        visibilityBtn2.classList.add("fa-eye-slash");
    } else {
        passwordInput2.type = "text";
        visibilityBtn2.classList.remove("fa-eye-slash");
        visibilityBtn2.classList.add("fa-eye");
    }
}
    </script>
</body>
</html>
