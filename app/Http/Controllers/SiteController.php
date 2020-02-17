<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Site;
use App\SitePing;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::with(['pings' => function ($query) {
            $query->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id) as id'))->from('site_pings')->groupBy('site_id');
            });
        }])->get();

        return view('sites/index', compact('sites'));
    }

    public function show(Site $site)
    {
        $site->pings = $site->pings()->paginate();
        return view('sites/ping', compact('site'));
    }
}
