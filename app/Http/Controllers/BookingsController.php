<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\HallPackage;
use App\Models\RoomType;

class BookingsController extends Controller
{
    //Untuk show data booking 
    public function index()
    {
        $bookings = Bookings::all();
        return view('bookings.index', compact('bookings'));
    }

    //Untuk menyimpan data booking
    public function store(Request $request, $id_user)
    {
        try {
            $request->validate([
                'check_in_date' => 'required|date',
                'check_out_date' => 'required|date|after:check_in_date',
                'hall_package_id' => 'required|exists:hall_package,id_hall_package',
            ]);

            $booking = Bookings::create([
                'id_user' => $id_user,
                'id_hall_package' => $request->hall_package_id,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
            ]);

            //Ni gatau, tanya GPT aja aku jg gak paham ajax siala 1 ni
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Booking berhasil!',
                    'redirect_url' => route('booking_hall_process', [
                        'id_booking' => $booking->id_booking,
                        'hall_package_id' => $request->hall_package_id
                    ]),
                ]);
            }

            //Pergi ke halaman booking_hall_process dengan membawa atribut id_booking dan hall_package_id
            return redirect()->route('booking_hall_process', [
                'id_booking' => $booking->id_booking, 
                'hall_package_id' => $request->hall_package_id
            ]);
            
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ]);
            }
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function storeRoom(Request $request, $id_user)
    {
        try {
            $request->validate([
                'check_in_date' => 'required|date',
                'check_out_date' => 'required|date|after:check_in_date',
                'room_type_id' => 'required|exists:room_type,id_room_type',
            ]);

            $booking = Bookings::create([
                'id_user' => $id_user,
                'id_room_type' => $request->room_type_id,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
            ]);

            //Ni gatau, tanya GPT aja aku jg gak paham ajax siala 1 ni
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Booking berhasil!',
                    'redirect_url' => route('booking_room_process', [
                        'id_booking' => $booking->id_booking,
                        'room_type_id' => $request->room_type_id
                    ]),
                ]);
            }

            //Pergi ke halaman booking_hall_process dengan membawa atribut id_booking dan hall_package_id
            return redirect()->route('booking_room_process', [
                'id_booking' => $booking->id_booking, 
                'room_type_id' => $request->room_type_id
            ]);
            
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ]);
            }
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
