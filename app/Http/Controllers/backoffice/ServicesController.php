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
use App\Language;
use App\ServicesTranslations;
use Toastr;



class ServicesController extends Controller
{

    private $ServiceImage; 

    public function __construct()
    {
        $this->middleware('auth:admin');
        $ServiceImage = ''; 
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
        $servicesTranslations = DB::table('services_translations')->get(); 

        return view('backoffice.pages.services.services', compact('services', 'servicesTranslations'));
    }

    public function create()
    {
        return view('backoffice.pages.services.add-services');
    }

    public function store(Request $request)
    {
        // create artist
        $service = new Services();
        $service->save();

        //get artist ID
        $serviceId = Services::all()->last()->id;

        //create PT translation
        $servicePt = new ServicesTranslations();       
        $servicePt->title = $request->request->get('title-pt'); 
        $servicePt->description = $request->request->get('description-pt');
        $servicePt->servicesId = $serviceId; 
        $servicePt->languageId = Language::all()->get(0)->id;  //lang
        $servicePt->save();

        //Create artist folder if doesn't  exists
        $source = public_path() . '/services';
        $destination = public_path() . '/images/services' . '/' . $serviceId;

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        //save img uploaded
        $this->storeImage('main-image', $serviceId);

        //Delete tmp directory
        $source = public_path() . '/images/services/tmp';

        File::deleteDirectory($source);

        //get filename 
        $currentImg = File::allFiles(public_path() . $this->ServiceImage)[0]->getRelativePathname();
        //update artist with img path
        DB::table('services')->where('id', $serviceId)->update(['image' => $this->ServiceImage . '/'.  $currentImg]);

        Toastr::success('Service created with success.', 'Services', ["positionClass" => "toast-top-center"]);

        return Redirect::to('admin/services');
    }


    public function edit($id)
    {
        $service = DB::table('services')->where('id', '=', $id)->get()->first();

        $servicePt = DB::table('services_translations')->where([['servicesId', '=', $id], ['languageId', '=', '1']])->get()->first();
                
        $destination = public_path() . '/images/services/tmp';

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        $this->copyFolderToTmp('main-image', $id);

        return view('backoffice.pages.services.edit-services', compact('service', 'servicePt', 'serviceEn', 'serviceFr'));
    }

    public function update(Request $request)
    {

        $source = public_path() . '/images/services/' . $request->request->get('id');
        File::deleteDirectory($source);

        // artist main image
        $this->storeImage('main-image', $request->request->get('id'));

        $source = public_path() . '/images/services/tmp';
        File::deleteDirectory($source);

        // update artist PT
        $updatedServicePt = array(
            'title' => $request->request->get('title-pt'),
            'description' => $request->request->get('description-pt'),
        );

        DB::table('services_translations')->where([['servicesId', '=', $request->request->get('id')], ['languageId', '=', '1']])->update($updatedServicePt);
        
        // update artist EN
        $updatedServiceEn = array(
            'title' => $request->request->get('title-en'),
            'description' => $request->request->get('description-en'),
        );

        DB::table('services_translations')->where([['servicesId', '=', $request->request->get('id')], ['languageId', '=', '2']])->update($updatedServiceEn);
        
        // update artist FR
        $updatedServiceFr = array(
            'title' => $request->request->get('title-fr'),
            'description' => $request->request->get('description-fr'),
        );

        DB::table('services_translations')->where([['servicesId', '=', $request->request->get('id')], ['languageId', '=', '3']])->update($updatedServiceFr);
        
        //get filename
        $currentImg = File::allFiles(public_path() . $this->ServiceImage)[0]->getRelativePathname();
        //update sponsor with img path
        DB::table('services')->where('id', $request->request->get('id'))->update(['image' => $this->ServiceImage . '/'.  $currentImg]);

        Toastr::success('Service edited with success.', 'Services', ["positionClass" => "toast-top-center"]);

        return Redirect::to('admin/services');


    }

    public function destroy($id)
    {
        $portfolio = Portfolio::where('servicesId', '=', $id)->delete();
        $services = Services::destroy($id);

        Toastr::success('Service deleted with success.', 'Services', ["positionClass" => "toast-top-center"]);


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

        $this->ServiceImage = strstr($destination, '/images'); 
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
