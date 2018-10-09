<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
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
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


        $source = public_path() . '/images/services/tmp';
        File::deleteDirectory($source);

        $services = DB::table('services')->get();
        return view('backoffice.pages.services.services', compact('services'));
    }

    public function create()
    {
        return view('backoffice.pages.services.add-services');
    }

    public function store(Request $request)
    {

        $service = new Services();

        $service->title = $request->request->get('title');
        $service->description = $request->request->get('description');

        $service->save();

        $serviceId = DB::table('services')->where('title', '=', $service->title)->get()->first();

        $source = public_path() . '/services';
        $destination = public_path() . '/images/services' . '/' . $serviceId->id;

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        $this->storeImage('main-image', $serviceId->id);

        $tmpFolder = public_path() . '/images/services/tmp';

        File::deleteDirectory($tmpFolder);


        return Redirect::to('admin/services');
    }


    public function edit($id)
    {
        $service = DB::table('services')->where('id', '=', $id)->get()->first();

        $destination = public_path() . '/images/services/tmp';

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        $this->copyFolderToTmp('main-image', $id);

        return view('backoffice.pages.services.edit-services', compact('service'));
    }

    public function update(Request $request)
    {

        $source = public_path() . '/images/services/' . $request->request->get('id');
        File::deleteDirectory($source);

        // car main features
        $this->storeImage('main-image', $request->request->get('id'));

        $updatedService = array(
            'title' => $request->request->get('title'),
            'description' => $request->request->get('description'),
        );

        $source = public_path() . '/images/services/tmp';

        File::deleteDirectory($source);

        DB::table('services')->where('id', $request->request->get('id'))->update($updatedService);

        return Redirect::to('admin/services');

    }

    public function destroy($id)
    {
        $portfolio = Portfolio::where('servicesId', '=', $id)->delete();
        $services = Services::destroy($id);

        return Redirect::to('admin/services');

    }

    public function imageUpload(Request $request)
    {
        $folder = $request->request->get('folder');
        $name = $request->request->get('name');

        $path = public_path() . '/images/services/' . $folder . '/' . $name . '/';

        $tmpImage = $_FILES[$name]["tmp_name"];

        $image = $_FILES[$name]['name'];

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $image = str_replace(' ', '', $image);
        File::copy($tmpImage, $path . '/' . $image);
        echo json_encode($image);
    }

    public function imageDelete(Request $request)
    {
        $folder = $request->request->get('folder');
        $name = $request->request->get('name');
        $image = $request->request->get('imageName');

        if (is_array($image)) {
            $image = $image[0];
        } else {
            $image = $image;
        }

        $path = public_path() . '/images/services/' . $folder . '/' . $name . '/';

        $image = str_replace(' ', '', $image);

        File::delete($path . str_replace('"', "", $image));
    }


    public function storeImage($folder, $serviceId, $tmp = "")
    {
        if ($tmp == "") {
            $source = public_path() . '/images/services/tmp/' . $folder;
        } else {
            $source = public_path() . '/images/services/tmp/' . $tmp;
        }
        if (File::files($source)) {
            $destination = public_path() . '/images/services' . '/' . $serviceId . '/' . $folder;
            File::copyDirectory($source, $destination);
        }
    }


    public function imageLoad(Request $request)
    {
        $id = $_GET['id'];
        $name = $_GET['name'];

        $path = public_path() . '/images/services/' . $id . '/' . $name;

        if (File::exists($path)) {
            $files = File::allFiles($path);
            $data = array();

            foreach ($files as $file) {
                $details = array();
                $details['name'] = $file->getFileName();
                $details['path'] = '/images/services/' . $id . '/' . $name . '/' . $file->getFileName();
                $details['size'] = $file->getSize();
                $data[] = $details;
            }

            echo json_encode($data);
        }
    }

    public function copyFolderToTmp($folder, $id, $tmp = "")
    {
        $source = public_path() . '/images/services/' . $id . '/' . $folder;

        if (File::files($source)) {
            $destination = public_path() . '/images/services/tmp/' . $folder;
            File::copyDirectory($source, $destination);
        }
    }

}
