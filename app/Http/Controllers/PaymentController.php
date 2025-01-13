<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Payment;
use App\Models\TransaksiHall;
use App\Models\TransaksiKamar;
use App\Models\HallPackage;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function paymentForHall(Request $request, $id)
    {
        // Mengambil data transaksi berdasarkan id_booking
        $transaksi_hall = TransaksiHall::where('id_booking', $id)->first();

        if (!$transaksi_hall) {
            return redirect()->route('home')->withErrors('Booking tidak ditemukan');
        }

        // Mendapatkan informasi paket hall
        $hall_package = HallPackage::where('id_hall_package', $transaksi_hall->id_hall_package)->first();

        if (!$hall_package) {
            return redirect()->route('home')->withErrors('Paket hall tidak ditemukan');
        }

        // Mendapatkan data booking
        $booking = Bookings::where('id_booking', $id)->first();

        if (!$booking) {
            return redirect()->route('home')->withErrors('Data booking tidak ditemukan');
        }

        // Perhitungan harga berdasarkan jumlah hari
        $check_in_date = new \DateTime($booking->check_in_date);
        $check_out_date = new \DateTime($booking->check_out_date);
        $interval = $check_in_date->diff($check_out_date);
        $days = $interval->days;

        // Mengalikan harga dengan jumlah hari
        $price = $hall_package->price * $days;

        // Menghitung biaya ekstra jika peserta lebih banyak dari kapasitas
        if ($transaksi_hall->attendee_number > $hall_package->capacity) {
            $price += ($transaksi_hall->attendee_number - $hall_package->capacity) * 50000;
            $price += 10000; //Tambah biaya admin
        }

        // Mencari atau membuat entri pembayaran
        $payment = Payment::where('id_booking', $id)->first();

        // Jika pembayaran belum ada, buat entri baru
        if (!$payment) {
            $payment = new Payment();
            $payment->id_booking = $id;
        }

        // Menyimpan informasi pembayaran
        $payment->payment_method = $request->payment_method;
        $payment->payment_date = now();
        $payment->payment_status = 1; // Status pembayaran berhasil
        $payment->total_price = $price;
        $payment->save(); // Menyimpan atau memperbarui entri pembayaran

        // Redirect setelah pembayaran berhasil
        return redirect()->route('profile')->with('success', 'Pembayaran berhasil!');
    }


    public function pendingPaymentHall($id)
    {
        // Buat entri pembayaran dengan status pending (0)
        $payment = Payment::create([
            'id_booking' => $id,
            'payment_status' => 0, // Status pembayaran pending
        ]);

        // Kembalikan response JSON untuk memberi tahu frontend bahwa operasi berhasil
        return response()->json(['success' => true, 'message' => 'Pembayaran pending']);
    }

    public function paymentForRoom(Request $request, $id, $idRoomType)
    {
        // Mengambil data transaksi berdasarkan id_booking
        $transaksi_room = TransaksiKamar::where('id_booking', $id)->first();

        if (!$transaksi_room) {
            return redirect()->route('home')->withErrors('Booking tidak ditemukan');
        }

        // Mendapatkan informasi paket hall
        $room_type = RoomType::where('id_room_type', $idRoomType)->first();

        if (!$room_type) {
            return redirect()->route('home')->withErrors('Room tidak ditemukan');
        }

        // Mendapatkan data booking
        $booking = Bookings::where('id_booking', $id)->first();

        if (!$booking) {
            return redirect()->route('home')->withErrors('Data booking tidak ditemukan');
        }

        // Perhitungan harga berdasarkan jumlah hari
        $check_in_date = new \DateTime($booking->check_in_date);
        $check_out_date = new \DateTime($booking->check_out_date);
        $interval = $check_in_date->diff($check_out_date);
        $days = $interval->days;

        // Mengalikan harga dengan jumlah hari
        $price = $room_type->price * $days;

        // Menghitung biaya ekstra jika peserta lebih banyak dari kapasitas
        if ($transaksi_room->attendee_numberd> $room_type->capacity) {
            $price += ($transaksi_room->attendee_number - $room_type->capacity) * 50000;
            $price += 10000; //Tambah biaya admin
        }

        // Mencari atau membuat entri pembayaran
        $payment = Payment::where('id_booking', $id)->first();

        // Jika pembayaran belum ada, buat entri baru
        if (!$payment) {
            $payment = new Payment();
            $payment->id_booking = $id;
        }

        // Menyimpan informasi pembayaran
        $payment->payment_method = $request->payment_method;
        $payment->payment_date = now();
        $payment->payment_status = 1; // Status pembayaran berhasil
        $payment->total_price = $price;
        $payment->save(); // Menyimpan atau memperbarui entri pembayaran

        // Redirect setelah pembayaran berhasil
        return redirect()->route('profile')->with('success', 'Pembayaran berhasil!');
    }


    public function pendingPaymentRoom($id)
    {
        // Buat entri pembayaran dengan status pending (0)
        $payment = Payment::create([
            'id_booking' => $id,
            'payment_status' => 0,
        ]);
        return response()->json(['success' => true, 'message' => 'Pembayaran pending']);
    }


}