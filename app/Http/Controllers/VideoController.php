<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function store(Request $request){
        $uploaded_file = $request->file;

        // $filename = time() . '.png';

        $up = Storage::disk('public')->put('posts/videos', $uploaded_file);
        // $uploaded_file = $request->file->storage('public/posts/videos');

        return response()->json([
            "message" => "Berhasil",
            "data" => "/storage/" . $up
        ]);
    }
}
