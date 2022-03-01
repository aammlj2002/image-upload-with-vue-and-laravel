<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view("image.index");
    }
    public function show()
    {
        // return all images
    }
    public function store(Request $request)
    {
        // validate the incoming file
        if (!$request->hasFile("image")) {
            return response()->json(["error"=>"there is no image present"], 400);
        }
        $request->validate([
            'image'=>"required|file|image"
        ]);

        // save the file in storage
        $path = $request->file('image')->store("public/images");
        if (!$path) {
            return response()->json(["error"=>"the file could not be save"], 500);
        }
        // make a image model
        $uploadedFile = $request->file("image");
        $image = Image::create([
            "name"=>$uploadedFile->hashName(),
            "extension"=>$uploadedFile->extension(),
            "size"=>$uploadedFile->getSize()
        ]);

        // return that image model to frontend
        return $image;
    }
}
