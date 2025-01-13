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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Profile</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: white;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin_home') }}">
                <strong>Hotel</strong><span class="text-appbar-second-color"><strong>OlangKaya</strong></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('admin_room_master') }}">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('admin_hall_package_master') }}">Hall Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin_user_management') }}">User Management</a>
                    </li>
                </ul>
            </div>
                <?php if (isset($_SESSION["user"])): ?>
                    <div>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: black; border: none;">
                                <img src="{{ asset('images/pict-profile.jpg') }}" alt="" class="profile-img-nav">
                                <span><strong>Admin123</strong></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('process.logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <div>
                        <button type="button" class="btn btn-primary" style="background-color: #824D69; border: none;">
                            <a href="{{ route('register') }}" style="text-decoration: none; color: white;">
                                <strong>Register</strong>
                            </a>
                        </button>
                        <button type="button" class="btn btn-primary" style="background-color: #824D69; border: none;">
                            <a href="{{ route('login') }} " style="text-decoration: none; color: white;">
                                <strong>Login</strong>
                            </a>
                        </button>
                    </div>
                <?php endif; ?>
        </div>
    </nav>
    <main>
        <br><br>
        <div style="background-color: white;">
            <div class="container">
                <div class="shadow p-4" style="max-width: 1000px; margin: auto;">
                    <div class="row mb-3">
                        <div class="col-md-10 mx-auto">
                            <div class="mb-4">
                                <a href="{{ route('admin_user_management') }}" class="text-muted" style="font-size: 1.2rem;">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>
                            <h2>Edit Admin</h2>
                            <hr>
                            <div class="form-group mb-4">
                                <label for="firstName" class="form-label"><strong>First Name</strong></label>
                                <div class="input-group input-group-lg">
                                    <input type="text" id="firstName" class="form-control" aria-label="First Name" aria-describedby="inputGroup-sizing-lg">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="lastName" class="form-label"><strong>Last Name</strong></label>
                                <div class="input-group input-group-lg">
                                    <input type="text" id="lastName" class="form-control" aria-label="Last Name" aria-describedby="inputGroup-sizing-lg">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <div class="input-group input-group-lg">
                                    <input type="email" id="email" class="form-control" aria-label="Email" aria-describedby="inputGroup-sizing-lg">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="notel" class="form-label"><strong>Nomor Telepon</strong></label>
                                <div class="input-group input-group-lg">
                                    <input type="text" id="notel" class="form-control" aria-label="Nomor Telepon" aria-describedby="inputGroup-sizing-lg">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="picture" class="form-label"><strong><strong>Picture</strong></strong></label>
                                <div class="input-group">
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" style="background-color: #824D69; border: none;">
                                    <a href="" style="text-decoration: none; color: white;">
                                        <strong>Save Changes</strong>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-10 mx-auto">
                            <h2>Change Password</h2>
                            <hr>
                            <div class="form-group mb-4">
                                <label for="newPass" class="form-label"><strong>New Password</strong></label>
                                <div class="input-group input-group-lg">
                                    <input type="password" id="newPass" class="form-control" aria-label="New Password" aria-describedby="inputGroup-sizing-lg">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" style="background-color: #824D69; border: none;">
                                    <a href="" style="text-decoration: none; color: white;">
                                        <strong>Change Password</strong>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>   
</body>


<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/swiper_script.min.js') }} "></script>
</html>