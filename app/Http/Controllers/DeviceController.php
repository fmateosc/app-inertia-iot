<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        //$filters = $request->all('search');


        $devices = Device::paginate(10);

        return Inertia::render('Devices/Index', compact('devices'));
    }

    public function store(Request $request) {
        Device::create(
            $request->validate([
                'device_id' => "required|min:4|max:10|unique:devices",
                'name' => "required|min:4|max:20",
                'type' => "required|min:5|max:100"
            ])
        );

        return Redirect::route('dispositivos.index');
    }   
}
