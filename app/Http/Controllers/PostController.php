<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        if (count($posts) != 0) {

            return PostResource::collection($posts);

        } else {

            return response()->json([
                'message' => 'Resource not found',
                'error' => 404
            ], 404);
            
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = json_decode($request->getContent());

        try {
            $post = Post::create([
                'title' => $inputs->title,
                'content' => $inputs->content,
            ]);

            return response()->json([
                'message' => 'Resource created successfully',
                'id' => $post->id,
            ], 201);

        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => $th->getMessage(),
                'error' => 400
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = Post::find($id);

            if ($post) {
                return new PostResource($post);
            }

            return response()->json([
               'message' => 'Resource not found',
               'error' => 404
               ], 404);
            

        } catch (\Throwable $th) {

            return response()->json([
                'message' => $th->getMessage(),
                'error' => 400
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = json_decode($request->getContent());

        try {
            $post = Post::find($id);

            if ($post) {
                $post->update([
                    'title' => $inputs->title,
                    'content' => $inputs->content,
                ]);

                return response()->json([
                    'message' => 'Resource updated successfully',
                    'id' => $post->id,
                ], 201);
            }

            return response()->json([
               'message' => 'Resource not found',
               'error' => 404
               ], 404);

            
        } catch (\Throwable $th) {

            return response()->json([
                'message' => $th->getMessage(),
                'error' => 400
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::find($id);

            if ($post) {
                Post::destroy($id);

                return response()->json([
                    'message' => 'Resource deleted successfully',
                    'id' => $post->id,

                ], 200);
            }

            return response()->json([
              'message' => 'Resource not found',
              'error' => 404
              ], 404);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'error' => 400
            ], 400);
        }
    }
}

