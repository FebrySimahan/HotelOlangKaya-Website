<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hall Package</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/poppins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminStyle/createHallStyle.css') }}">
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
        <div class="container mt-5">
            <div class="form-container">
                <div class="mb-4">
                    <a href="{{ route('admin_hall_package_master') }}" class="text-muted" style="font-size: 1.2rem;">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <h1 class="mb-4" style="color: #4a2d56;"><strong>Add Hall Package</strong></h1>

                <form action="{{ route('hall_package.store') }}" novalidate method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label for="package_name" class="form-label @error('package_name') is-invalid @enderror"><strong>Hall Package Name</strong></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="hallPackageName" 
                            name="package_name" 
                            placeholder="Hall Package Name"
                            value="{{ old('package_name') }}"
                        >
                        @error('package_name')
                            <div class="invalid-feedback">
                                Hall Package Name Must Be Filled !!!
                            </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="price" class="form-label @error('price') is-invalid @enderror"><strong>Package Price (in IDR)</strong></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="packagePrice" 
                            name="price" 
                            placeholder="Package Price in IDR"
                            value="{{ old('price') }}"
                        >
                        @error('price')
                            <div class="invalid-feedback">
                                Price Must Be Filled !!!
                            </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="capacity" class="form-label @error('capacity') is-invalid @enderror"><strong>Capacity</strong></label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="number" 
                            name="capacity" 
                            placeholder="Capacity" 
                            style="width: 150px;"
                            value="{{ old('capacity') }}"
                        >
                        @error('capacity')
                            <div class="invalid-feedback">
                                Maximum Capacity Must Be Filled !!!
                            </div>
                        @enderror
                    </div>
                
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Services</strong></p>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="mc" 
                                    name="services[]" 
                                    value="Master of Ceremony"
                                    {{ is_array(old('services')) && in_array('Master of Ceremony', old('services')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="mc">Master of Ceremony</label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="moderator" 
                                    name="services[]" 
                                    value="Moderator"
                                    {{ is_array(old('services')) && in_array('Moderator', old('services')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="moderator">Moderator</label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="eventOrg" 
                                    name="services[]" 
                                    value="Event Organizer"
                                    {{ is_array(old('services')) && in_array('Event Organizer', old('services')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="eventOrg">Event Organizer</label>
                            </div>
                            <p class="mt-3"><strong>Others</strong></p>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="soundSystem" 
                                    name="others[]" 
                                    value="Sound System"
                                    {{ is_array(old('others')) && in_array('Sound System', old('others')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="soundSystem">Sound System</label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="projector" 
                                    name="others[]" 
                                    value="Projector"
                                    {{ is_array(old('others')) && in_array('Projector', old('others')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="projector">Projector</label>
                            </div>
                            
                
                        <div class="col-md-6">
                            <label class="form-label"><strong>Consumption</strong></label>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input @error('consumption') is-invalid @enderror" 
                                        type="radio" 
                                        name="consumption" 
                                        id="included" 
                                        value="Included"
                                        {{ old('consumption') === 'Included' ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="included">Included</label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input @error('consumption') is-invalid @enderror" 
                                        type="radio" 
                                        name="consumption" 
                                        id="notIncluded" 
                                        value="Not Included"
                                        {{ old('consumption') === 'Not Included' ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="notIncluded">Not Included</label>
                                </div>
                                @error('consumption')
                                    <div class="invalid-feedback">
                                        Consumption Must Be Choose !!!
                                    </div>
                                @enderror

                            <label for="description" class="form-label mt-3"><strong>Description</strong></label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="4" 
                                placeholder="Description"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    Description Must Be Filled !!!
                                </div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="mb-4">
                        <label for="package_picture" class="form-label"><strong>Picture</strong></label>
                        <div class="input-group">
                            <input 
                                class="form-control @error('package_picture') is-invalid @enderror" 
                                type="file" 
                                id="formFile" 
                                name="package_picture"
                            >
                            @error('package_picture')
                                <div class="invalid-feedback">
                                    Package Image Must Be Filled !!!
                                </div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary me-3" style="background-color: #824D69; border: none;">Discard</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #824D69; border: none;">Add Package</button>
                    </div>
                </form>
                
            </div>
        </div>
        <br><br>
    </main>
</body>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/swiper_script.min.js') }} "></script>
</html>