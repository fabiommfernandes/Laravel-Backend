<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;
use Toastr;

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
        // Uncomment the code to display graphs with data from Google Analytics

        /* 
        $user = Auth::user();

        $pageViews = Analytics::fetchVisitorsAndPageViews(Period::days(7))[0]['pageViews'];
        $visitors = Analytics::fetchVisitorsAndPageViews(Period::days(7))[0]['visitors'];

        $users = Analytics::performQuery(Period::days(30), 'ga:users')->rows[0][0];

        $time = Analytics::performQuery(Period::days(30), 'ga:sessionDuration')[0][0] / 60;
        $time = number_format((float)$time, 0, '.', '') . 'h';

        $mostVisitedPages = Analytics::fetchMostVisitedPages(Period::days(7));
  
        $browsers = Analytics::fetchTopBrowsers(Period::days(7));

        $devices = app('App\Services\Devices')->devices();
        $devicesUsed = app('App\Services\Devices')->devicesUsed($devices);
        $trending = app('App\Services\Trending')->week();
        $countries = app('App\Services\Regions')->regions();

        $reasons = \Lava::DataTable();
        $reasons->addStringColumn('Devices')
            ->addNumberColumn(1);

        foreach ($devices as $device) {
            $reasons->addRow([$device['device'], (int)$device['pageviews']]);
        }

        \Lava::PieChart('devicesPie', $reasons, [
            'is3D' => false,
            'colors' => array('#ffffff'),
            'colorAxis' => [
                'colors' => ['#449eff', '005abb']
            ],
            'backgroundColor' => '#505050',
            'height' => 400,
            'chartArea' => [
                'width' => '75%',
                'height' => '70%'
            ]

        ]);


        return view('backoffice.pages.dashboard.dashboard', compact('pageViews', 'users', 'time', 'visitors', 'countries', 'devicesPie'));

        */

        
        return view('backoffice.pages.dashboard.dashboard');
    }

}
