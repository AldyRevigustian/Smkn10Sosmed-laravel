<?php

namespace App\Http\Controllers;

use App\Models\ImageStory;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::where('user_id', auth()->user()->id)->first();
        // $images = $story->imageStory;

        // dd($images);

        return response([
            'stories' => Story::orderBy('created_at', 'desc')->with('user:id,name,image')->get()
        ], 200);
    }

    public function indexImage(Request $request )
    {
        return response([
            'stories' => ImageStory::where('user_id', $request->user_id)->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $this->saveImage($request->image, 'posts');

        $saveImage = ImageStory::create([
            'user_id' => auth()->user()->id,
            'image' => $image
        ]);

        $cek = Story::where('user_id', auth()->user()->id)->first();
        // dd($cek);
        if ($cek == null) {
            Story::create([
                'user_id' => auth()->user()->id,
                // 'image_id' => $saveImage->id
            ]);
        }


        return response([
            'message' => 'Story created.',
            // 'stories' => $stories,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }
}
