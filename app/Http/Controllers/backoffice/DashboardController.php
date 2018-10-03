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
        //fetch the most visited pages for today and the past week
        $mostPage = Analytics::fetchMostVisitedPages(Period::days(7));

        //fetch visitors and page views for the past week
        $visitors = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        dd($mostPage, $visitors);

        return view('backoffice.pages.dashboard.dashboard');
    }

}
