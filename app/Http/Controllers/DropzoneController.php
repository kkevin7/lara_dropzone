<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File;

class DropzoneController extends Controller
{
    function index()
    {
     return view('dropzone');
    }

    public function upload_chucks(Request $request)
    {
        $file = $request->file('file');

        // $path = \Storage::disk('uploads')->path("chunks/{$file->getClientOriginalName()}");
        $path = public_path("images/{$file->getClientOriginalName()}");

        \File::append($path, $file->get());

        // if ($request->has('is_last') && $request->boolean('is_last')) {
        //     $name = basename($path, '.part');

        //     File::move($path, $name);
        // }

        return response()->json(['uploaded' => true]);
    }
    // public function upload_chucks(Request $request)
    // {
    //     $file = $request->file('file');

    //     $path = \Storage::disk('uploads')->path("chunks/{$file->getClientOriginalName()}");
    //     // public_path("images/{$file->getClientOriginalName()}")

    //     \File::append($path, $file->get());

    //     if ($request->has('is_last') && $request->boolean('is_last')) {
    //         $name = basename($path, '.part');

    //         File::move($path, "/path/to/public/someid/{$name}");
    //     }

    //     return response()->json(['uploaded' => true]);
    // }


    function upload(Request $request)
    {
     $image = $request->file('file');

     $imageName = time() . '.' . $image->extension();

     $image->move(public_path('images'), $imageName);

     return response()->json(['success' => $imageName]);
    }

    function fetch()
    {
     $images = \File::allFiles(public_path('images'));
     $output = '<div class="row">';
     foreach($images as $image)
     {
      $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset('images/' . $image->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
            </div>
      ';
     }
     $output .= '</div>';
     echo $output;
    }

    function delete(Request $request)
    {
     if($request->get('name'))
     {
      \File::delete(public_path('images/' . $request->get('name')));
     }
    }
}
