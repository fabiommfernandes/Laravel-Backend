<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;


class UsersController extends Controller
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
        $admins = DB::table('admins')->orderBy('type')->get();
        $users = DB::table('users')->get();
        $allUsers = array();

        if (!empty($admins)) {
            foreach ($admins as $admin) {
                array_push($allUsers, $admin);
            }
        }

        if (!empty($user)) {

            foreach ($users as $user) {
                array_push($allUsers, $user);
            }
        }

        return view('backoffice.pages.users.users', compact('allUsers'));
    }

    public function create()
    {
        return view('backoffice.pages.users.add-users');
    }
}
