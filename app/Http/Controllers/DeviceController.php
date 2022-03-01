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
        $filters = $request->all('search');

        $devices = Device::filter($filters)
            ->paginate(5);

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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'device_id' => "required|min:4|max:10|unique:devices,device_id,".$request->id,
            'name' => "required|min:4|max:20",
            'type' => "required|min:5|max:100"
        ]);

        $device = Device::find($id);

        $device->device_id = $request->device_id;
        $device->name = $request->name;
        $device->type = $request->type;

        $device->save();

        return Redirect::route('dispositivos.index');
    }

    public function activarDesactivar(Request $request, $device)
    {
        $id = $device;

        $device = Device::find($id);

        $device->selected = !$device->selected;
        $device->save();

        return Redirect::route('dispositivos.index');
    }
}
