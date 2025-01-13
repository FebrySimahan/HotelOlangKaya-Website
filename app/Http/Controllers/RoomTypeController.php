<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isNull;

use App\Http\Controllers\RoomsController;

use Illuminate\Support\Facades\Log;

class RoomTypeController extends Controller
{
    public function index(RoomsController $roomsController)
    {
        $roomCount = $roomsController->countRoom();

        $roomTypes = RoomType::latest()->get();
        return view('Admin.admin_room_master', compact('roomTypes', 'roomCount'));
    }

    public function create()
    {
        return view('Admin.AdminCreateEdit.admin_room_create');
    }

    public function store(Request $request, RoomsController $roomsController)
    {
        Log::info('Request Data: ', $request->all());
        Log::info("Validation check.");

        // Validasi input
        $request->validate([
            'name_type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'number_of_room' => 'required|integer',
            'maximum_people' => 'required|integer',
            'bed_type' => 'required|string',
            'bathroom_type' => 'required|string',
            'consumption' => 'array',
            'heater' => 'required|string',
            'smoking' => 'required|string',
            'description' => 'required|string',
            'room_picture' => 'required',
        ]);

        $roomCount = $roomsController->countRoom();

        $cek = 100 - $roomCount + $request->number_of_room;
        Log::info('number of room: ', ['number_of_room' => $request->number_of_room]);
        Log::info('roomCount: ', ['roomCount' => $roomCount]);
        Log::info('Cek: ', ['cek' => $cek]);
        
        if(100 - $roomCount + $request->number_of_room > 100){
            return redirect()->route('room_type.create')->with('error', 'Jumlah kamar yang ingin ditambahkan melebihi kapasitas hotel');
        }


        Log::info("Validation passed.");
        Log::info('Request Data: ', $request->all());

        $facilities = [];
    
        if ($request->filled('bed_type')) {
            Log::info("Bed Type: ", [$request->input('bed_type')]);
            $facilities[] = 'Bed Type : '. $request->input('bed_type');
        }

        if ($request->filled('bathroom_type')) {
            Log::info("Bathroom Type: ", [$request->input('bathroom_type')]);
            $facilities[] = $request->input('bathroom_type');
        }

        //Debugging
        Log::info("Facilities Array: ", [$facilities]);

        if ($request->has('consumption')) {
            $facilities = array_merge($facilities, $request->consumption);
        }

        if ($request->has('heater')) {
            $facilities[] = 'Heater ' . $request->heater;
        }

        if ($request->has('smoking')) {
            $facilities[] = 'Smoking ' . $request->smoking;
        }

        $facilityString = implode(', ', $facilities);

        //Debugging
        Log::info("Facilities Array Final: ", [$facilities]);

        $image = $request->file('room_picture');
        if (is_null($image)) {
            $img = $roomType->room_picture;
        } else {
            $imgLocal = $image->move(public_path('AsetGambarRoom'), $image->getClientOriginalName());
            $img = $image->getClientOriginalName();
        }

        Log::info("Check 1");

        // Menyimpan data ke database
        $roomType = RoomType::create([
            'name_type' => $request->name_type,
            'price' => $request->price,
            'number_of_room' => $request->number_of_room,
            'maximum_people' => $request->maximum_people,
            'description' => $request->description,
            'facility' => $facilityString,
            'room_picture' => $img,
        ]);

        $roomsController = new RoomsController();
        $roomsController->assignRoomTypes($roomType);

        // Redirect dengan pesan sukses
        return redirect()->route('room_type.index')->with('success', 'Data Kamar Berhasil Ditambahkan');
    }



    public function edit($id)
    {
        $room_type = RoomType::find($id);

        $facilities = explode(', ', $room_type->facility);

        $heater = null;
        $smoking = null;

        foreach ($facilities as $key => $facility) {
            if (str_contains($facility, 'Heater')) {
                $heater = trim(str_replace('Heater', '', $facility)); 
            }
            if (str_contains($facility, 'Smoking')) {
                $smoking = trim(str_replace('Smoking', '', $facility));
            }
        }

        return view('Admin.AdminCreateEdit.admin_room_edit', compact('room_type', 'heater', 'smoking'));
    }



    public function update(Request $request, RoomsController $roomsController, $id)
    {
        $request->validate([
            'name_type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'number_of_room' => 'required|integer',
            'maximum_people' => 'required|integer',
            'bed_type' => 'required|string',
            'bathroom_type' => 'required|string',
            'consumption' => 'array',
            'heater' => 'required|string',
            'smoking' => 'required|string',
            'description' => 'required|string',
            'room_picture' => 'nullable|image',
        ]);

        $room_type = RoomType::find($id);

        $roomCount = $roomsController->countRoom();

        if($request->number_of_room <= $room_type->number_of_room){
            $roomsController->destroyRoomTypeId($id);
        }else if($request->number_of_room == $room_type->number_of_room){
            $roomsController->destroyRoomTypeId($id);
        }else if($request->number_of_room > $room_type->number_of_room){
            if(100 - $roomCount - $room_type->number_of_room < $request->number_of_room){
                return redirect()->route('room_type.edit', $room_type)->with('error', 'Jumlah kamar yang ingin ditambahkan melebihi kapasitas hotel');
            }else{
                $roomsController->destroyRoomTypeId($id);
            }
        }

        $facilities = [];
    
        if ($request->filled('bed_type')) {
            Log::info("Bed Type: ", [$request->input('bed_type')]);
            $facilities[] = $request->input('bed_type');
        }

        if ($request->filled('bathroom_type')) {
            Log::info("Bathroom Type: ", [$request->input('bathroom_type')]);
            $facilities[] = $request->input('bathroom_type');
        }

        //Debugging
        Log::info("Facilities Array: ", [$facilities]);

        if ($request->has('consumption')) {
            $facilities = array_merge($facilities, $request->consumption);
        }

        if ($request->has('heater')) {
            $facilities[] = 'Heater ' . $request->heater;
        }

        if ($request->has('smoking')) {
            $facilities[] = 'Smoking ' . $request->smoking;
        }

        $facilityString = implode(', ', $facilities);

        $image = $request->file('room_picture');
        if (is_null($image)) {
            $img =  $room_type->room_picture;
        } else {
            $imgLocal = $image->move(public_path('AsetGambarRoom'), $image->getClientOriginalName());
            $img = $image->getClientOriginalName();
        }

        $room_type->update([
            'name_type' => $request->name_type,
            'price' => $request->price,
            'number_of_room' => $request->number_of_room,
            'maximum_people' => $request->maximum_people,
            'description' => $request->description,
            'facility' => $facilityString,
            'room_picture' => $img,
        ]);

        $roomsController = new RoomsController();
        $roomsController->assignRoomTypes($room_type);

        return redirect()->route('admin_room_master')->with(['[*] Data Kamar Berhasil Diubah [*]']);
    }

    public function destroy(RoomsController $roomsController, $id)
    {
        $room_type = RoomType::find($id);
        $roomsController->destroyRoomTypeId($id);
        File::delete(public_path('AsetGambarRoom/' . $room_type->room_picture));
        $room_type->delete();
        return redirect()->route('admin_room_master')->with(['[*] Data Kamar Berhasil Dihapus [*]']);
    }
}
