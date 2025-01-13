<?php

use App\Http\Controllers\TransaksiHallController;
use App\Http\Controllers\TransaksiKamarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HallPackageController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomsController;


Route::post('/user/register', [UserController::class, 'register'])->name('user.register');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');
Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

Route::resource('hall_package', HallPackageController::class);
Route::resource('transaksi_hall', TransaksiHallController::class);
Route::resource('room_type', RoomTypeController::class);
Route::resource('transaksi_kamar', TransaksiKamarController::class);
Route::resource('booking', BookingsController::class);
Route::resource('payment', PaymentController::class);

Route::middleware('auth:admin')->group(function () {
    Route::get('room_types/assign/{roomType}', [RoomsController::class, 'assignRoomTypes'])->name('room_types.assign');

    Route::get('/Admin/dashboard', function () {
        return view('Admin.dashboard');
    })->name('dashboard');

    Route::get('/Admin/admin_home', function () {
        return view('Admin.admin_home');
    })->name('admin_home');
    
    Route::get('/Admin/admin_room_master', function () {
        return view('Admin.admin_room_master');
    })->name('admin_room_master');

    Route::get('/Admin/admin_hall_package_master', [HallPackageController::class, 'index'
    ])->name('admin_hall_package_master');
    
    Route::get('/Admin/admin_room_master', [RoomTypeController::class, 'index'
    ])->name('admin_room_master');
    
    Route::get('/Admin/admin_book_report', function () {
        return view('Admin.admin_book_report');
    })->name('admin_book_report');
    
    Route::get('/Admin/admin_user_management', function () {
        return view('Admin.admin_user_management');
    })->name('admin_user_management');
    
    Route::get('/Admin/AdminCreateEdit/admin_room_edit', function () {
        return view('Admin.AdminCreateEdit.admin_room_edit');
    })->name('admin_room_edit');
    
    Route::get('/Admin/AdminCreateEdit/admin_room_create', function () {
        return view('Admin.AdminCreateEdit.admin_room_create');
    })->name('admin_room_create');
    
    Route::get('/Admin/AdminCreateEdit/admin_hall_edit', function () {
        return view('Admin.AdminCreateEdit.admin_hall_edit');
    })->name('admin_hall_edit');
    
    Route::get('/Admin/AdminCreateEdit/admin_hall_create', function () {
        return view('Admin.AdminCreateEdit.admin_hall_create');
    })->name('admin_hall_create');
    
    Route::get('/Admin/AdminCreateEdit/ManagementCE/admin_user_edit', function () {
        return view('Admin.AdminCreateEdit.ManagementCE.admin_user_edit');
    })->name('admin_user_edit');
    
    Route::get('/Admin/AdminCreateEdit/ManagementCE/admin_edit', function () {
        return view('Admin.AdminCreateEdit.ManagementCE.admin_edit');
    })->name('admin_edit');
    
    Route::get('/Admin/AdminCreateEdit/ManagementCE/admin_create', function () {
        return view('Admin.AdminCreateEdit.ManagementCE.admin_create');
    })->name('admin_create');
    
    Route::get('/Admin/AdminCreateEdit/ManagementCE/admin_user_create', function () {
        return view('Admin.AdminCreateEdit.ManagementCE.admin_user_create');
    })->name('admin_user_create');
});

Route::middleware('auth')->group(function (){

    // --- Bookings --- //

    //Untuk menampilkan choose_booking
    Route::get('/Booking/choose_booking', function () {
        return view('Booking.choose_booking');
    })->name('choose_booking');

    //Untuk menyimpan data booking
    Route::post('/booking/hall/{id}', [BookingsController::class, 'store'
    ])->name('booking.store');

    Route::post('/booking/room/{id}', [BookingsController::class, 'storeRoom'
    ])->name('booking.storeRoom');

    //Untuk menampilkan choose_hall_package dan di dalam index tersebut ada membawa hallPackages 
    //Supaya bisa digunakan di halaman choose_hall_package untuk menampilkan data hallPackages
    Route::get('/Booking/choose_hall_package', [TransaksiHallController::class, 'index'
    ])->name('choose_hall_package');

    Route::get('/Booking/choose_room', [TransaksiKamarController::class, 'index'
    ])->name('choose_room');



    // --- Payment --- //

    
    Route::get('/Booking/paymentHall/{id}', function ($id) {
        $booking = session('booking');
        $transaksi = session('transaksi');
        $hallPackage = session('hallPackage');
        return view('Booking.paymentHall', compact('id', 'booking', 'transaksi', 'hallPackage'));
    })->name('paymentHall');

    //Untuk mengedit data dari paymentHall terkait jika dikonfirmasi sudah melakukan pembayaran
    //Data teredit setelah user mengklik continue payment di halaman paymentHall
    Route::put('/Booking/paymentHall/{id}', [PaymentController::class, 'paymentForHall'])->name('paymentForHall');

    //Untuk mengcreate payment dengan awalan kondisi pending (semua data kosong kecuali status -> 0)
    //Ini dipanggil waktu user mengklik continue payment di halaman booking_hall_process
    Route::post('/pending_payment_hall/{id}', [PaymentController::class, 'pendingPaymentHall'])->name('pendingPaymentHall');


    // punya room
    Route::get('/Booking/paymentRoom/{id}', function ($id) {
        $booking = session('booking');
        $transaksi = session('transaksi');
        $roomType= session('roomType');
        return view('Booking.paymentRoom', compact('id', 'booking', 'transaksi', 'roomType'));
    })->name('paymentRoom');

    
    Route::put('/Booking/paymentRoom/{id}/{idRoomType}', [PaymentController::class, 'paymentForRoom'])->name('paymentForRoom');

   
    Route::post('/pending_payment_Room/{id}', [PaymentController::class, 'pendingPaymentRoom'
    ])->name('pendingPaymentRoom');


    // --- Transaksi Hall ---//

    //Untuk menghapus data BOOKING jika batal melakukan transaksi
    //Dilakukan supaya database tidak penuh dengan data bookings yang kosong (tidak terpakai akibat batal)
    Route::delete('/transaksi_hall/{id}', [TransaksiHallController::class, 'destroy'])->name('transaksi_hall.destroy');

    //Untuk menyimpan data transaksi hall
    Route::post('/transaksi-hall/store', [TransaksiHallController::class, 'store'
    ])->name('transaksi_hall.store');

    //Untuk menuju ke halaman booking_hall_process dengan membawa atribut id_booking dan hall_package_id
    //Dibawa agar bisa digunakan di halaman tersebut
    Route::get('/Booking/booking_hall_process/{id_booking}/{hall_package_id}', [TransaksiHallController::class, 'show'
    ])->name('booking_hall_process');



    //Booking room
    Route::delete('/transaksi_room/{id}', [TransaksiKamarController::class, 'destroy'])->name('transaksi_room.destroy');

    //Untuk menyimpan data transaksi hall
    Route::post('/transaksi-room/store', [TransaksiKamarController::class, 'store'
    ])->name('transaksi_room.store');

    //Untuk menuju ke halaman booking_hall_process dengan membawa atribut id_booking dan hall_package_id
    //Dibawa agar bisa digunakan di halaman tersebut
    Route::get('/Booking/booking_room_process/{id_booking}/{room_type_id}', [TransaksiKamarController::class, 'show'
    ])->name('booking_room_process');


    

    // --- Belum Dipakai --- //
    
    // Route::get('/Booking/choose_room', function () {
    //     return view('Booking.choose_room');
    // })->name('choose_room');
    
    // Route::get('/Booking/booking_room_process/', function () {
    //     return view('Booking.booking_room_process');
    // })->name('booking_room_process');
 
    

    
    Route::get('/Booking/payment', function () {
        return view('Booking.payment');
    })->name('payment');

    // --- General --- //

    Route::get('/', function () {
        return view('home');
    });
    
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/facility', function () {
        return view('facility');
    })->name('facility');
    
    Route::get('/profile', [UserController::class, 'showProfile'
    ])->name('profile');

});

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    } else if (auth('admin')->check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::get('/register', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    } else if (auth('admin')->check()) {
        return redirect()->route('dashboard');
    }
    return view('register');
})->name('register');

Route::get('/facility', function () {
    return view('facility');
})->name('facility');

Route::post('/process-login', function () {
    include resource_path('views/Process/processLogin.blade.php');
})->name('process.login');

Route::post('/process-logout', function () {
    session_start();
    session_destroy();
    return redirect('/home');
})->name('process.logout');