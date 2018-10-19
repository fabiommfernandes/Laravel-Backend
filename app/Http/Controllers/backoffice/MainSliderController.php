<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Analytics\Period;
use Auth;
use Analytics;
use Lava;
use Toastr;

use App\MainSlider;


class MainSliderController extends Controller
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
        $source = public_path() . '/images/main-slider/tmp';
        File::deleteDirectory($source);

        $sliders = DB::table('mainslider')->get();

        return view('backoffice.pages.main-slider.main-slider', compact('sliders'));
    }

    public function create()
    {
        return view('backoffice.pages.main-slider.add-main-slider');
    }

    public function store(Request $request)
    {

        $slide = new Mainslider();

        $slide->title = $request->request->get('title');

        $slide->save();

        $slideId = DB::table('mainslider')->where('title', '=', $slide->title)->get()->first();

        $source = public_path() . '/main-slider';
        $destination = public_path() . '/images/main-slider/' . $slideId->id;

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        $this->storeImage('main-image', $slideId->id);

        $tmpFolder = public_path() . '/images/main-slider/tmp';

        File::deleteDirectory($tmpFolder);

        Toastr::success('Slide created with success.', 'Slider', ["positionClass" => "toast-top-center"]);

        return Redirect::to('admin/main-slider');
    }

    public function edit($id)
    {
        $slider = DB::table('mainslider')->where('id', '=', $id)->get()->first();

        $destination = public_path() . '/images/main-slider/tmp';

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        $this->copyFolderToTmp('main-image', $id);

        return view('backoffice.pages.main-slider.edit-main-slider', compact('slider'));
    }

    public function update(Request $request)
    {

        $source = public_path() . '/images/main-slider/' . $request->request->get('id');
        File::deleteDirectory($source);

        // car main features
        $this->storeImage('main-image', $request->request->get('id'));

        $updatedSlider = array(
            'title' => $request->request->get('title'),
        );

        $source = public_path() . '/images/main-slider/tmp';

        File::deleteDirectory($source);

        DB::table('mainslider')->where('id', $request->request->get('id'))->update($updatedSlider);

        Toastr::success('Slider edited with success.', 'Slider', ["positionClass" => "toast-top-center"]);


        return Redirect::to('admin/main-slider');

    }



    public function destroy($id)
    {
        $slider = Mainslider::destroy($id);

        Toastr::success('Slider deleted with success.', 'Slider', ["positionClass" => "toast-top-center"]);


        return Redirect::to('admin/main-slider');

    }

    public function imageUpload(Request $request)
    {
        $folder = $request->request->get('folder');
        $name = $request->request->get('name');

        $path = public_path() . '/images/main-slider/' . $folder . '/' . $name . '/';

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

        $path = public_path() . '/images/main-slider/' . $folder . '/' . $name . '/';

        $image = str_replace(' ', '', $image);

        File::delete($path . str_replace('"', "", $image));
    }

    public function imageLoad(Request $request)
    {
        $id = $_GET['id'];
        $name = $_GET['name'];

        $path = public_path() . '/images/main-slider/' . $id . '/' . $name;

        if (File::exists($path)) {
            $files = File::allFiles($path);
            $data = array();

            foreach ($files as $file) {
                $details = array();
                $details['name'] = $file->getFileName();
                $details['path'] = '/images/main-slider/' . $id . '/' . $name . '/' . $file->getFileName();
                $details['size'] = $file->getSize();
                $data[] = $details;
            }

            echo json_encode($data);
        }
    }

    public function storeImage($folder, $slideId, $tmp = "")
    {
        if ($tmp == "") {
            $source = public_path() . '/images/main-slider/tmp/' . $folder;
        } else {
            $source = public_path() . '/images/main-slider/tmp/' . $tmp;
        }
        if (File::files($source)) {
            $destination = public_path() . '/images/main-slider' . '/' . $slideId . '/' . $folder;
            File::copyDirectory($source, $destination);
        }
    }

    public function copyFolderToTmp($folder, $id, $tmp = "")
    {
        $source = public_path() . '/images/main-slider/' . $id . '/' . $folder;

        if (File::files($source)) {
            $destination = public_path() . '/images/main-slider/tmp/' . $folder;
            File::copyDirectory($source, $destination);
        }
    }


}
