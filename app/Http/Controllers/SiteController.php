<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Site;
use App\SitePing;

class Controller extends Controller
{
    public function index()
    {
        $sites = Site::with(['pings' => function ($query) {
            $query->orderBy('id', 'desc')->limit(1);
        }])->get();

        return view('sites/index', compact('sites'));
    }

    public function show(Site $site)
    {
        $site->pings = $site->pings()->paginate();
        return view('sites/ping', compact('site'));
    }
}
