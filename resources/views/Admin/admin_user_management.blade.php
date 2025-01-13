<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminStyle/adminUserManagementStyle.css') }}">
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
    <br><br>
        <div class="container">
            <div class="d-flex shadow align-items-center" style="max-width: 1100px; margin: auto; padding: 10px; border-radius: 5px;">
                <div class="input-group" style="width: 600px; margin-right: 20px;">
                    <input type="text" class="form-control search-input" placeholder="Search..." aria-label="Search" style="border-width: 2px;">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

                <div class="dropdown me-3">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        User Data
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" onclick="changeTable('user')">User Data</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changeTable('admin')">Admin Data</a></li>
                    </ul>
                </div>
                
                <div class="d-flex align-items-center ms-auto">
                    <a href="{{ route('admin_create') }}">
                        <button class="btn btn-primary">
                            Add Admin
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex shadow align-items-center" style="max-width: 1100px; margin: auto;">
            <div class="table-responsive" id="tabel-pengguna" style="display: block;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">USR001</th>
                            <td>Febry</td>
                            <td>Sigmahan</td>
                            <td>febsih@gmail.com</td>
                            <td>08123122222</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_user_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">USR002</th>
                            <td>Mulyanto</td>
                            <td>Dodowi</td>
                            <td>fafu@gmail.com</td>
                            <td>08957319481</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_user_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">USR003</th>
                            <td>Sumanto</td>
                            <td>Febrianto</td>
                            <td>abcde@gmail.com</td>
                            <td>081638919016</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_user_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">USR004</th>
                            <td>Agoes</td>
                            <td>Agoes</td>
                            <td>agoes@gmail.com</td>
                            <td>08957818209</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_user_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">USR005</th>
                            <td>Putra</td>
                            <td>Alexander</td>
                            <td>ptra@gmail.com</td>
                            <td>08957184055</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_user_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive" id="tabel-admin" style="display: block;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Admin ID</th>
                            <th scope="col">Admin Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">ADM001</th>
                            <td>Eric</td>
                            <td>erd@gmail.com</td>
                            <td>085918467799</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">ADM002</th>
                            <td>Samsul</td>
                            <td>samsul@gmail.com</td>
                            <td>089174816744</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">ADM003</th>
                            <td>Surti</td>
                            <td>surti@gmail.com</td>
                            <td>08956173956</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">ADM004</th>
                            <td>Admin123</td>
                            <td>admin@gmail.com</td>
                            <td>086819245412</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                <a href="{{ route('admin_edit') }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        

        <br><br>
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
<script>
    function changeTable(selection) {
        var userTable = document.getElementById('tabel-pengguna');
        var adminTable = document.getElementById('tabel-admin');
        var dropdownButton = document.getElementById('dropdownMenuButton');
        var addButton = document.querySelector('.btn-primary');
        
        if (selection === 'user') {
            userTable.style.display = 'block';
            adminTable.style.display = 'none';
            dropdownButton.textContent = 'User Data';
            addButton.style.display = 'none';
        } else {
            userTable.style.display = 'none';
            adminTable.style.display = 'block';
            dropdownButton.textContent = 'Admin Data';
            addButton.style.display = 'block';
        }
    }
    window.onload = function() {
        changeTable('user');
    }
</script>
</html>