<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $device = Device::where('instance_id', $request->instance_id)
            ->where('user_id', auth()->id())->firstOrFail();

        $res = Http::post('http://localhost:5000/send-message', [
            'instance_id' => $device->instance_id,
            'number' => $request->number,
            'message' => $request->message,
        ]);

        return response()->json($res->json());
    }
}
