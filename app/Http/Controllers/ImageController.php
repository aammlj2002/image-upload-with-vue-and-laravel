<?php

namespace App\Http\Controllers;

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
        // save images to database
    }
}
