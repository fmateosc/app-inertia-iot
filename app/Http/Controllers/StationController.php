<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');


        $stations = Station::filter($filters)
            ->paginate(20);

        return Inertia::render('Stations/Index', compact('stations'));
    }
}
