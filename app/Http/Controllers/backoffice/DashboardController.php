<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;


class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();


        $devices = app('App\Services\Devices')->devices();
        $devicesUsed = app('App\Services\Devices')->devicesUsed($devices);
        //returns most viewed pages
        $trending = app('App\Services\Trending')->week();
        //returns regions (only country atm)
        $countries = app('App\Services\Regions')->regions();

        dd($countries);
        //fetch visitors and page views for the past week

        return view('backoffice.pages.dashboard.dashboard');
    }

}
