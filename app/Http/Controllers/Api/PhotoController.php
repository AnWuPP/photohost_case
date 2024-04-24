<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all(['id', 'name', 'created_at']);
        return response()->json($photos->toJson());
    }

    public function show(Photo $photo)
    {
        return response()->json($photo->toJson());
    }
}
