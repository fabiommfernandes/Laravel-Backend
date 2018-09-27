<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;
use App\Services;
use App\Portfolio;



class ServicesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = DB::table('services')->get();
        return view('backoffice.pages.services.services', compact('services'));
    }

    public function create()
    {
        return view('backoffice.pages.services.add-services');
    }

    public function edit($id)
    {
        $service = DB::table('services')->where('id', '=', $id)->get()->first();

        return view('backoffice.pages.services.edit-services', compact('service'));
    }

    public function update()
    {
        $updatedService = array(
            'title' => $_POST['title'],
            'description' => $_POST['description'],
        );

        DB::table('services')->where('id', $_POST['id'])->update($updatedService);

        return Redirect::to('admin/services');

    }

    public function destroy($id)
    {
        $portfolio = Portfolio::where('servicesId', '=', $id)->delete();
        $services = Services::destroy($id);

        return Redirect::to('admin/services');

    }

}
