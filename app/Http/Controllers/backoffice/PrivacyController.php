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


class PrivacyController extends Controller
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
        $privacy = DB::table('policiestranslations')->get()->first();

        return view('backoffice.pages.privacy.privacy', compact('privacy'));
    }

    public function edit()
    {
        $privacy = DB::table('policiestranslations')->get()->first();

        return view('backoffice.pages.privacy.edit-privacy', compact('privacy'));
    }

    public function update(Request $request)
    {

        $updatedPrivacy = array('description' => $request->request->get('description'));

        DB::table('policiestranslations')->where('policiesId', $request->request->get('id'))
            ->update($updatedPrivacy);


        return Redirect::to('admin/privacy');
    }
}
