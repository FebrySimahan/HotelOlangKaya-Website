<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiKamar;
use App\Models\RoomType;
use App\Models\Bookings;
use App\Http\Controllers\PaymentController; 

use Illuminate\Support\Facades\Log;

class TransaksiKamarController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::latest()->get();
       
        return view('Booking.choose_room', compact('roomTypes'));
    }

    //Untuk menampilkan data booking di hall process sesuai dengan id_booking dan room_type_id
    public function show($id_booking, $room_type_id)
    {
        $booking = Bookings::find($id_booking);
        if (!$booking) {
            return redirect()->route('home')->withErrors('Booking not found');
        }

        $roomTypes = RoomType::find($room_type_id);

        if (!$roomTypes) {
            return redirect()->route('home')->withErrors('Room types not found');
        }

        return view('Booking.booking_room_process', compact('booking', 'roomTypes'));
    }

    //Untuk menyimpan data transaksi hall
    public function store(Request $request)
    {
        // Validasi bahwa 'extra_bed' adalah array (karena Anda menggunakan 'extra_bed[]')
        $request->validate([
            
        ]);

        Log::info('Request Data: ', $request->all());

        $id_booking = $request->id_booking;
        $id_type = $request->id_room_type;

        // Mengecek apakah 'extra_bed' ada dalam request, jika ada berarti dicentang
        $konfirmasi = !empty($request->extra_bed) ? 1 : 0;

        // Membuat transaksi kamar dengan data yang sudah diproses
        $transaksi = TransaksiKamar::create([
            'id_booking' => $id_booking,
            'id_room' => $id_type,
            'extra_bed' => $konfirmasi,
        ]);

        $booking = Bookings::find($id_booking);
        $roomType = RoomType::find($id_type);

        // Menyimpan data booking, RoomType, dan transaksi ke dalam session
        session(['id_booking' => $id_booking, 'booking' => $booking, 'roomType' => $roomType, 'transaksi' => $transaksi, 'extra_bed' => $konfirmasi]);

        $paymentController = new PaymentController();
        $paymentController->pendingPaymentHall($id_booking);

        return redirect()->route('paymentRoom', ['id' => $id_booking]);
    }


    // Untuk destroy bookings jika membatalkan transaksi
    public function destroy($id)
    {
        $booking = Bookings::find($id);

        $booking->delete();

        return redirect()->route('choose_room_type');
    }
}