<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room Type</title>
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
                        <a class="nav-link active" aria-current="page" href="{{ route('admin_room_master') }}">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('admin_hall_package_master') }}">Hall Packages</a>
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
                    <a href="{{ route('admin_room_master') }}" class="text-muted" style="font-size: 1.2rem;">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <h1 class="mb-4" style="color: #4a2d56;"><strong>Add Room</strong></h1>

                <form action="{{ route('room_type.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label for="name_type" class="form-label @error('name_type') is-invalid @enderror"><strong>Room Name</strong></label>
                        <input 
                            type="text" 
                            class="form-control @error('name_type') is-invalid @enderror" 
                            id="name_type" 
                            name="name_type" 
                            placeholder="Room Name"
                            value="{{ old('name_type') }}"
                        >
                        @error('name_type')
                            <div class="invalid-feedback">
                                Room Name Must Be Filled !!!
                            </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="price" class="form-label @error('price') is-invalid @enderror"><strong>Room Price (in IDR)</strong></label>
                        <input 
                            type="number" 
                            class="form-control @error('price') is-invalid @enderror" 
                            id="price" 
                            name="price" 
                            placeholder="Room Price in IDR"
                            value="{{ old('price') }}"
                        >
                        @error('price')
                            <div class="invalid-feedback">
                                Price Must Be Filled !!!
                            </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="maximum_people" class="form-label @error('maximum_people') is-invalid @enderror"><strong>Maximum Person</strong></label>
                        <input 
                            type="number" 
                            class="form-control @error('maximum_people') is-invalid @enderror" 
                            id="maximum_people" 
                            name="maximum_people" 
                            placeholder="Max Person" 
                            value="{{ old('maximum_people') }}"
                        >
                        @error('maximum_people')
                            <div class="invalid-feedback">
                                Maximum Person Must Be Filled !!!
                            </div>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="number_of_room" class="form-label @error('number_of_room') is-invalid @enderror"><strong>Number of Room</strong></label>
                        <input 
                            type="number" 
                            class="form-control @error('number_of_room') is-invalid @enderror" 
                            id="number_of_room" 
                            name="number_of_room" 
                            placeholder="Number of Room" 
                            value="{{ old('number_of_room') }}"
                        >
                        @error('number_of_room')
                            <div class="invalid-feedback">
                                Number of Room Must Be Filled !!!
                            </div>
                        @enderror

                        @if(session('error'))
                            <div class="invalid-feedback d-block">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="bedType" class="form-label @error('bed_type') is-invalid @enderror"><strong>Bed Type</strong></label>
                            <select class="form-select @error('bed_type') is-invalid @enderror" id="bed_type" name="bed_type">
                                <option value="" disabled selected>Select Bed Type</option>
                                <option value="Single" {{ old('bed_type') === 'Single Bed' ? 'selected' : '' }}>Single</option>
                                <option value="Double" {{ old('bed_type') === 'Twin Bed' ? 'selected' : '' }}>Double</option>
                                <option value="Queen" {{ old('bed_type') === 'Queen Bed' ? 'selected' : '' }}>Queen</option>
                            </select>
                            @error('bed_type')
                                <div class="invalid-feedback">
                                    Bed Type Must Be Selected !!!
                                </div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="bathroomType" class="form-label @error('bathroom_type') is-invalid @enderror"><strong>Bathroom Type</strong></label>
                            <select class="form-select @error('bathroom_type') is-invalid @enderror" id="bathroom_type" name="bathroom_type">
                                <option value="" disabled {{ old('bathroom_type') ? '' : 'selected' }}>Select Bathroom Type</option>
                                <option value="Shower" {{ old('bathroom_type') === 'Shower' ? 'selected' : '' }}>Shower</option>
                                <option value="Bathtub" {{ old('bathroom_type') === 'Bathtub' ? 'selected' : '' }}>Bathtub</option>
                            </select>
                            @error('bathroom_type')
                                <div class="invalid-feedback">
                                    Bathroom Type Must Be Selected !!!
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Consumption</strong></p>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="Breakfast" 
                                    name="consumption[]" 
                                    value="Breakfast"
                                    {{ is_array(old('consumption')) && in_array('Breakfast', old('consumption')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="bf">Breakfast</label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="Lunch" 
                                    name="consumption[]" 
                                    value="Lunch"
                                    {{ is_array(old('consumption')) && in_array('Lunch', old('consumption')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="lch">Lunch</label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="Dinner" 
                                    name="consumption[]" 
                                    value="Dinner"
                                    {{ is_array(old('consumption')) && in_array('Dinner', old('consumption')) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="din">Dinner</label>
                            </div>
                        </div>
                
                        <div class="col-md-6">
                            <label class="form-label"><strong>Heater</strong></label>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="heater" 
                                    id="included" 
                                    value="Included"
                                    {{ old('heater') === 'Included' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="included">Included</label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="heater" 
                                    id="notIncluded" 
                                    value="Not Included"
                                    {{ old('heater') === 'Not Included' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="notIncluded">Not Included</label>
                            </div>
                
                            <label class="form-label"><strong>Smoking Allowed</strong></label>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="smoking" 
                                    id="Yes" 
                                    value="Yes"
                                    {{ old('smoking') === 'Yes' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="Yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="smoking" 
                                    id="No" 
                                    value="No"
                                    {{ old('smoking') === 'No' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="No">No</label>
                            </div>
                        </div>
                    </div>
                
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
                
                    <div class="mb-4">
                        <label for="room_picture" class="form-label"><strong>Picture</strong></label>
                        <div class="input-group">
                            <input 
                                class="form-control @error('room_picture') is-invalid @enderror" 
                                type="file" 
                                id="formFile" 
                                name="room_picture"
                            >
                            @error('room_picture')
                                <div class="invalid-feedback">
                                    Room Image Must Be Filled !!!
                                </div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary me-3" style="background-color: #824D69; border: none;">Discard</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #824D69; border: none;">Add Room</button>
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