<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;
use JWTAuth;
use Validator;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.jwt', ['except' => [
            'index'
        ]]);
    }

    public function index()
    {
        $posts = Post::with('category')->get();

        return response()->json($posts, 200);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if(!$user = JWTAuth::parseToken()->authenticate()) {
//            return response()->json(['message' => 'User not found'], 401);
//        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $user = JWTAuth::parseToken()->toUser();
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        if ($request->get('image')) {
            $image = $request->get('image');
            $filename = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $location = public_path('posts/images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $post->image = $filename;
        }

        $post->save();
//        if ($request->get('image')) {
//            $image = $request->get('image');
//            return response()->json(['name' => $request->file('image')->getClientOriginalName()], 201);
//        } else {
//            return response()->json(['error' => 'no image'], 201);
//        }
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
