<?php

namespace App\Http\Controllers\backoffice;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Analytics;
use Spatie\Analytics\Period;
use Lava;
use App\Portfolio;
use Toastr;


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
        $source = public_path() . '/images/portfolio/tmp';
        File::deleteDirectory($source);

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

        $portfolioId = DB::table('portfolio')->where('title', '=', $portfolio->title)->get()->first();

        //Create frolder cars/id if not exists
        $source = public_path() . '/portfolio';
        $destination = public_path() . '/images/portfolio' . '/' . $portfolioId->id;

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        // car main features
        $this->storeImage('main-image', $portfolioId->id);
        $this->storeImage('slider', $portfolioId->id);

        //Delete tmp directory
        $source = public_path() . '/images/portfolio/tmp';

        File::deleteDirectory($source);

        Toastr::success('Project created with success.', 'Portfolio', ["positionClass" => "toast-top-center"]);


        return Redirect::to('admin/portfolio');
    }

    public function edit($id)
    {
        $services = DB::table('services')->get();
        $portfolio = DB::table('portfolio')->where('id', '=', $id)->get()->first();


        $source = public_path() . '/images/portfolio/tmp';

        File::deleteDirectory($source);

        //Create frolder cars/id if not exists
        $destination = public_path() . '/images/portfolio/tmp';

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0777, true);
        }

        $this->copyFolderToTmp('main-image', $id);
        $this->copyFolderToTmp('slider', $id);

        return view('backoffice.pages.portfolio.edit-portfolio', compact('portfolio', 'services'));
    }

    public function update(Request $request)
    {
        $source = public_path() . '/images/portfolio/' . $request->request->get('id');
        File::deleteDirectory($source);

        // car main features
        $this->storeImage('main-image', $request->request->get('id'));
        $this->storeImage('slider', $request->request->get('id'));

        $updatedPortfolio = array(
            'title' => $request->request->get('title'),
            'description' => $request->request->get('description'),
            'servicesId' => $request->request->get('servicesId'),
        );

        $source = public_path() . '/images/services/tmp';

        File::deleteDirectory($source);

        DB::table('portfolio')->where('id', $request->request->get('id'))->update($updatedPortfolio);

        Toastr::success('Project edited with success.', 'Portfolio', ["positionClass" => "toast-top-center"]);


        return Redirect::to('admin/portfolio');

    }

    public function destroy($id)
    {
        $portfolio = Portfolio::destroy($id);

        Toastr::success('Project deleted with success.', 'Portfolio', ["positionClass" => "toast-top-center"]);


        return Redirect::to('admin/portfolio');

    }

    public function imageUpload(Request $request)
    {
        $folder = $request->request->get('folder');
        $name = $request->request->get('name');

        $path = public_path() . '/images/portfolio/' . $folder . '/' . $name . '/';

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

        $path = public_path() . '/images/portfolio/' . $folder . '/' . $name . '/';

        $image = str_replace(' ', '', $image);

        File::delete($path . str_replace('"', "", $image));
    }


    public function storeImage($folder, $serviceId, $tmp = "")
    {
        if ($tmp == "") {
            $source = public_path() . '/images/portfolio/tmp/' . $folder;
        } else {
            $source = public_path() . '/images/portfolio/tmp/' . $tmp;
        }
        if (File::files($source)) {
            $destination = public_path() . '/images/portfolio' . '/' . $serviceId . '/' . $folder;
            File::copyDirectory($source, $destination);
        }
    }


    public function imageLoad(Request $request)
    {
        $id = $_GET['id'];
        $name = $_GET['name'];

        $path = public_path() . '/images/portfolio/' . $id . '/' . $name;

        if (File::exists($path)) {
            $files = File::allFiles($path);
            $data = array();

            foreach ($files as $file) {
                $details = array();
                $details['name'] = $file->getFileName();
                $details['path'] = '/images/portfolio/' . $id . '/' . $name . '/' . $file->getFileName();
                $details['size'] = $file->getSize();
                $data[] = $details;
            }

            echo json_encode($data);
        }
    }


    public function copyFolderToTmp($folder, $id, $tmp = "")
    {
        $source = public_path() . '/images/portfolio/' . $id . '/' . $folder;

        if (File::files($source)) {
            $destination = public_path() . '/images/portfolio/tmp/' . $folder;
            File::copyDirectory($source, $destination);
        }
    }
}
