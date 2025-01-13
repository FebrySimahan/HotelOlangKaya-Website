<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HallPackage;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isNull;

use Illuminate\Support\Facades\Log;

class HallPackageController extends Controller
{
    public function index()
    {
        $hallPackages = HallPackage::latest()->get();
        return view('Admin.admin_hall_package_master', compact('hallPackages'));
    }

    public function create()
    {
        return view('Admin.AdminCreateEdit.admin_hall_create');
    }

    public function store(Request $request){
        $request->validate([
            'package_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'services' => 'array',
            'others' => 'array',
            'consumption' => 'required|string',
            'description' => 'required|string',
            'package_picture' => 'required',
        ]);

        $facilities = [];
        if ($request->has('services')) {
            $facilities = array_merge($facilities, $request->services);
        }
        if ($request->has('others')) {
            $facilities = array_merge($facilities, $request->others);
        }

        if ($request->has('consumption')) {
            $facilities[] = 'Consumption ' . $request->consumption;
        }

        $facilityString = implode(', ', $facilities);

        $image = $request->file('package_picture');
        if (is_null($image)) {
            $img = $hall_package->package_picture;
        } else {
            $imgLocal = $image->move(public_path('AsetGambar'), $image->getClientOriginalName());
            $img = $image->getClientOriginalName();
        }

        Log::info('Request Data:', $request->all());

        $hall_package = HallPackage::create([
            'package_name' => $request->package_name,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'facility' => $facilityString,
            'description' => $request->description,
            'package_picture' => $img,
        ]);

        return redirect()->route('admin_hall_package_master')->with(['[*] Data Hall Package Berhasil Ditambahkan [*]']);
    }

    public function edit($id)
    {
        $hall_package = HallPackage::find($id);

        $facilities = explode(', ', $hall_package->facility);

        $consumption = null;
        foreach ($facilities as $key => $facility) {
            if (str_contains($facility, 'Consumption')) {
                $consumption = trim(str_replace('Consumption ', '', $facility));
                unset($facilities[$key]);
            }
        }

        return view('Admin.AdminCreateEdit.admin_hall_edit', compact('hall_package', 'consumption'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'services' => 'array',
            'others' => 'array',
            'consumption' => 'required|string',
            'description' => 'required|string',
            'package_picture',
        ]);

        $facilities = [];
        if ($request->has('services')) {
            $facilities = array_merge($facilities, $request->services);
        }
        if ($request->has('others')) {
            $facilities = array_merge($facilities, $request->others);
        }

        if ($request->has('consumption')) {
            $facilities[] = 'Consumption ' . $request->consumption;
        }

        $facilityString = implode(', ', $facilities);

        $hall_package = HallPackage::find($id);
        $image = $request->file('package_picture');
        if (is_null($image)) {
            $img = $hall_package->package_picture;
        } else {
            $imgLocal = $image->move(public_path('AsetGambar'), $image->getClientOriginalName());
            $img = $image->getClientOriginalName();
        }

        $hall_package->update([
            'package_name' => $request->package_name,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'facility' => $facilityString,
            'description' => $request->description,
            'package_picture' => $img,
        ]);

        return redirect()->route('admin_hall_package_master')->with(['[*] Data Hall Package Berhasil Diubah [*]']);
    }

    public function destroy($id)
    {
        $hall_package = HallPackage::find($id);
        File::delete(public_path('AsetGambar/' . $hall_package->package_picture));
        $hall_package->delete();
        return redirect()->route('admin_hall_package_master')->with(['[*] Data Hall Package Berhasil Dihapus [*]']);
    }
    
}
