<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;
use App\Portfolio;


class PortfolioController extends Controller
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
        $portfolios = DB::table('portfolio')->get();
        return view('backoffice.pages.portfolio.portfolio', compact('portfolios'));
    }

    public function create()
    {
        $services = DB::table('services')->get();

        return view('backoffice.pages.portfolio.add-portfolio', compact('services'));
    }

    public function store(Request $request)
    {

        $portfolio = new Portfolio();

        $portfolio->title = $request->request->get('title');
        $portfolio->description = $request->request->get('description');
        $portfolio->servicesId = $request->request->get('servicesId');

        $portfolio->save();

        return Redirect::to('admin/portfolio');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::destroy($id);

        return Redirect::to('admin/portfolio');

    }
}
