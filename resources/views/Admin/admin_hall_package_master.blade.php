<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Room</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminStyle/adminHallStyle.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <a class="nav-link active" aria-current="page" href="{{ route('admin_hall_package_master') }}">Hall Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_user_management') }}">User Management</a>
                    </li>
                </ul>
            </div>
                @if(auth('admin')->check())
                    <div>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: black; border: none;">
                                <img src="{{ asset('AsetGambar/'.auth('admin')->user()->admin_picture) }}" alt="pict" class="profile-img-nav">
                                <span><strong>{{ auth('admin')->user()->admin_name }}</strong></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('user.logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @elseif(auth()->check())
                    <div>
                        <p>Welcome, {{ auth()->user()->name }}</p>
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
                @endif
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-10 mx-auto">
                    <br><br>
                    <h1 style="color: #DFB6B2">Hall Package List</h1>
                    <hr style="background-color: #DFB6B2; height: 3px; border: none;">
        
                    @foreach ($hallPackages as $hallPackage)
                        <div class="card mb-3 mx-auto" style="max-width: 85%; margin-top: 20px;">
                            <div class="row g-0">
                                <div class="col-12 col-sm-4">
                                    <img src="{{ asset('AsetGambar/' . $hallPackage->package_picture) }}" 
                                        class="img-fluid rounded-start" 
                                        alt="pict" 
                                        style="width: 100%; height: 220px; object-fit: cover;">
                                </div>
                                <div class="col-12 col-sm-8">
                                    <div class="card-body">
                                        <h2 class="card-title">Package Name: <strong>{{ $hallPackage->package_name }}</strong></h2>
                                        <p style="margin-bottom:0;">Facility: <strong>{{ $hallPackage->facility }}</strong></p>
                                        <p style="margin-bottom:0;">Price: <strong>IDR {{ number_format($hallPackage->price, 2, ',', '.') }}</strong></p>
                                        <p style="margin-bottom:0;">Capacity: <strong>{{ $hallPackage->capacity }}</strong></p>
                                        <div class="d-flex justify-content-end align-items-end flex-column" style="margin-top: auto;">
                                            <div class="d-flex">
                                                <form action="{{ route('hall_package.destroy', $hallPackage->id_hall_package) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger me-2" style="width: 100px">Delete</button>
                                                </form>
                                                <a href="{{ route('hall_package.edit', $hallPackage->id_hall_package) }}" class="btn btn-success" style="width: 100px">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
    
                    {{-- <div class="d-flex justify-content-center mt-4">
                        {{ $hallPackages() }}
                    </div> --}}
        
                    <div class="mb-4">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('hall_package.create') }}" class="btn btn-secondary shadow button-tambah-kamar">
                                <strong>+ Add Hall Package</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>    
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2A114B">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white;"><strong>Are You Sure You Want To Delete ?</strong></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/swiper_script.min.js') }} "></script>
</html>