<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Analytics\Period;
use Auth;
use Analytics;
use Lava;
use Toastr;



class ContactsController extends Controller
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
        $contact = DB::table('contacts')->get()->first();

        return view('backoffice.pages.contacts.contacts', compact('contact'));
    }

    public function update()
    {
        $updatedContacts = array(
            'email' => $_POST['email'], 'phone' => $_POST['phone'], 'secondaryPhone' => $_POST['secondaryPhone'],
            'adress' => $_POST['adress'], 'facebook' => $_POST['facebook'], 'twitter' => $_POST['twitter'], 'linkedin' => $_POST['linkedin']
        );

        DB::table('contacts')->where('id', $_POST['id'])
            ->update($updatedContacts);

        Toastr::success('Contact info edited with success.', 'Contacts', ["positionClass" => "toast-top-center"]);

        return Redirect::to('admin/contacts');

    }

}
