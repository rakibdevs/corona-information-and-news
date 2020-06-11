<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Image;

class GalleryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$gallery = Gallery::get();
    	return view('admin.gallery', compact('gallery'));
    }

    public function store(Request $request)
    {
    	if($request->file != "" ) {
	        $file     = $request->file('file');
	        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
	        $img = Image::make($file);
	        if($img->width()>800){
	          	$img = $img->resize(800, null, function ($constraint) {
	                      	$constraint->aspectRatio();
	                  	});
	        }
	        $url  = 'media/images/'.$filename;

	        $featured = Image::make($file);
	        $featured->crop(650, 300);
	        $f_url = 'media/thumbnails/'.$filename;
	        

	        if($img->save($url)){
	        	$featured->save($f_url);
	        	Gallery::create([
	        		'url' => $filename
	        	]);
	        }

	        return response()->json(['uploaded' => $url]);
	    }
	}
}