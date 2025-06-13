<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    public function store(Request $request)
    {
        $device = new Device();
        $device->user_id = auth()->id();
        $device->name = $request->name;
        $device->instance_id = Str::uuid();
        $device->status = 'disconnected';
        $device->save();
        return response()->json([
            'data' => $device,
            'message' => 'Berhasil Menambahkan Device'
        ]);
    }

    public function index()
    {
        return response()->json(['data' => auth()->user()->device]);
    }
    public function update(Request $request)
    {
        $device = Device::where('instance_id', $request->instance_id)->first();
        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        $device->status = $request->status;
        $device->number = $request->phone;
        $device->save();

        return response()->json(['message' => 'Status updated']);
    }
}
