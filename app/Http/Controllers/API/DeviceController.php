<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();

        return response()->json(['devices' => $devices]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
        ]);

        $device = Device::create([
            'name' => $request->name,
            'model' => $request->model,
        ]);

        return response()->json(['message' => 'Device registered successfully', 'device' => $device]);
    }
    
}
