<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;
use App\Admin;
use App\User;
use Toastr;


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
        //check for user type (if publisher redirects)
        $user = Auth::user();
        $type = $user->getAttributes()['type'] != '3';
        
        if($type == false)  return redirect('admin/');
     

        $admins = DB::table('admins')->where('type', '!=', '1')->orderBy('type')->get();
        $users = DB::table('users')->get();
        $allUsers = array();

        if (!empty($admins)) {
            foreach ($admins as $admin) {
                array_push($allUsers, $admin);
            }
        }

        if (!empty($users)) {

            foreach ($users as $user) {
                $user->isUser = 'true';
                array_push($allUsers, $user);
            }
        }

        return view('backoffice.pages.users.users', compact('allUsers'));
    }

    public function create()
    {
        return view('backoffice.pages.users.add-users');
    }

    public function store(Request $request)
    {

        if ($request->request->get('type') == '4') {
            $user = new User();

            $user->firstName = $request->request->get('name');
            $user->lastName = $request->request->get('lastname');
            $user->email = $request->request->get('email');
            $user->password = bcrypt($request->request->get('password'));
            $user->type = $request->request->get('type');

            $user->save();


        } else {
            $admin = new Admin();
            $admin->firstName = $request->request->get('name');
            $admin->lastName = $request->request->get('lastname');
            $admin->email = $request->request->get('email');
            $admin->password = bcrypt($request->request->get('password'));
            $admin->type = $request->request->get('type');

            $admin->save();

        }

        /*if ($admin->type == '4') {
            if (User::where('email', '=', $admin->email)->count() > 0 || Admin::where('email', '=', $admin->email)->count() > 0) {
                return Redirect::to('admin/users/create');
            } else {
                $user->save();
            }
        } else {
            if (Admin::where('email', '=', $admin->email)->count() > 0 || User::where('email', '=', $admin->email)->count() > 0) {
                return Redirect::to('admin/users/create');
            } else {
                $admin->save();
            }
        }*/

        Toastr::success('User created with success.', 'Users', ["positionClass" => "toast-top-center"]);

        return Redirect::to('admin/users');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|dumbpwd|confirmed',
        ]);
    }

    protected function myProfile($id)
    {
        $user = Auth::User();
        $current = $user->getAttributes();
        return view('backoffice.pages.users.my-profile', compact("current", "user"));
    }

    protected function storeMyProfile(Request $request)
    {
        $admin = new Admin();

        $updatedUser = array(
            'firstName' => $request->request->get('name'),
            'lastName' => $request->request->get('lastname'),
            'email' => $request->request->get('email'),
            'password' => bcrypt($request->request->get('password')),
        );

        DB::table('admins')->where('id', $request->request->get('id'))->update($updatedUser);

        $user = Auth::User();
        $current = $user->getAttributes();

        Toastr::success('Profile edited with success.', 'Users', ["positionClass" => "toast-top-center"]);

        return Redirect::to('admin/users');
    }

}
