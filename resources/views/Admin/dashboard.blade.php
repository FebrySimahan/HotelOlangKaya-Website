<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminStyle/adminDashboardStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Admin Home</title>
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
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('admin_room_master') }}">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('admin_hall_package_master') }}">Hall Packages</a>
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
        <div class="container mt-5" style="max-width: 1300px;">
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4 rounded" style="border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0"><strong>Total User</strong></h5>
                                <h2 class="display-6">40,876</h2>
                                <div class="text-success">
                                    <i class="fas fa-arrow-up"></i> 
                                    <span>Up from last month</span>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-users fa-3x" style="color: #ffb3b3; background-color: #ffe6e6; border-radius: 50%; padding: 15px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4 rounded" style="border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0"><strong>Total Revenue</strong></h5>
                                <h2 class="display-6">IDR 301M</h2>
                                <div class="text-success">
                                    <i class="fas fa-arrow-up"></i> 
                                    <span>Up from last month</span>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-dollar-sign fa-3x" style="color: #ffd700; background-color: #fff4c2; border-radius: 50%; padding: 15px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4 rounded" style="border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0"><strong>Room Booked</strong></h5>
                                <h2 class="display-6">112</h2>
                                <div class="text-success">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>Up from last month</span>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-bed fa-3x" style="color: #a3e5b1; background-color: #e7f9ee; border-radius: 50%; padding: 15px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm p-3 mb-4 rounded" style="border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0"><strong>Hall Booked</strong></h5>
                                <h2 class="display-6">5</h2>
                                <div class="text-success">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>Up from last month</span>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-hotel fa-3x" style="color: #ffd700; background-color: #fff4c2; border-radius: 50%; padding: 15px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><strong>Recent Booking</strong></h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Booked</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Febry Sigmahan</td>
                                            <td>Room</td>
                                            <td>IDR 1.050.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Jane Doe</td>
                                            <td>Room</td>
                                            <td>IDR 1.050.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>John Doe</td>
                                            <td>Room</td>
                                            <td>IDR 950.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Lon Doe</td>
                                            <td>Room</td>
                                            <td>IDR 550.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Febry Yanto</td>
                                            <td>Birthday Package</td>
                                            <td>IDR 10.050.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Papiyan Alex</td>
                                            <td>Marriage Package</td>
                                            <td>IDR 30.950.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Kalvin Lagarenze</td>
                                            <td>Room</td>
                                            <td>IDR 550.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Erwandi</td>
                                            <td>Room</td>
                                            <td>IDR 550.000</td>
                                        </tr>
                                        <tr>
                                            <td>02 Jan 2021</td>
                                            <td>Rizky Hana</td>
                                            <td>Room</td>
                                            <td>IDR 750.000</td>
                                        </tr>
                                        <tr>
                                            <td>01 Jan 2021</td>
                                            <td>Eric Swara</td>
                                            <td>Room</td>
                                            <td>IDR 750.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><strong>Booked Room</strong></h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        President Room
                                        <span class="badge bg-primary rounded-pill">10 Rooms</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Luxury Room
                                        <span class="badge bg-primary rounded-pill">12 Rooms</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Premium Room
                                        <span class="badge bg-primary rounded-pill">15 Rooms</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Standard Room
                                        <span class="badge bg-primary rounded-pill">75 Rooms</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><strong>Booked Hall Package</strong></h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Birthday Package
                                        <span class="badge bg-primary rounded-pill">2 Package Booked</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Marriage Package
                                        <span class="badge bg-primary rounded-pill">1 Package Booked</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Seminar Package
                                        <span class="badge bg-primary rounded-pill">2 Package Booked</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Meeting Package
                                        <span class="badge bg-primary rounded-pill">0 Package Booked</span>
                                    </li>
                                </ul>
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
<script>
    function changeTable(selection) {
        var userTable = document.getElementById('tabel-pengguna');
        var adminTable = document.getElementById('tabel-admin');
        var dropdownButton = document.getElementById('dropdownMenuButton');
        
        if (selection === 'user') {
            userTable.style.display = 'block';
            adminTable.style.display = 'none';
            dropdownButton.textContent = 'Data Pengguna';
        } else {
            userTable.style.display = 'none';
            adminTable.style.display = 'block';
            dropdownButton.textContent = 'Data Admin';
        }
    }
    window.onload = function() {
        changeTable('user');
    }
</script>
</html>