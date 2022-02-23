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

    
}
