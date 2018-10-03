<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;


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

        return Redirect::to('admin/contacts');

    }

}
