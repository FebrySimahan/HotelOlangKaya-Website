<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Rooms;
use App\Http\Controllers\RoomTypeController;

use Illuminate\Support\Facades\Log;

class RoomsController extends Controller
{
    public function assignRoomTypes(RoomType $roomType)
    {
        // Ambil room yang masih kosong dan belum memiliki id_room_type
        Rooms::whereNull('id_room_type')
            ->limit($roomType->number_of_room) // Update sesuai dengan jumlah yang ada di RoomType
            ->update(['id_room_type' => $roomType->id_room_type]);

        Log::info('Room types have been successfully assigned to the rooms.');
    }

    public function countRoom()
    {
        // Menghitung jumlah kamar yang id_room_type-nya tidak null
        $count = Rooms::whereNull('id_room_type')->count();
        Log::info('Room count:', ['count' => $count]);

        return $count;
    }

    public function destroyRoomTypeId($id)
    {
        // Mengupdate semua room yang memiliki id_room_type yang sesuai
        $updated = Rooms::where('id_room_type', $id)->update(['id_room_type' => null]);

        // Cek apakah ada data yang diperbarui
        if ($updated) {
            return response()->json(['message' => 'Room type has been set to null for the specified rooms.'], 200);
        }

        // Jika tidak ada data ditemukan
        return response()->json(['message' => 'No rooms found with the specified room type.'], 404);
    }



}
