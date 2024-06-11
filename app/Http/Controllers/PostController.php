<?php

/**
 * @OA\Post(
 *  http://localhost:8000/login ; sirve para iniciar el login
 *     
 * )
 */


namespace App\Http\Controllers;
use App\Models\Post; 
use Inertia\Inertia;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
   
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->id(); // Asignar el ID del usuario autenticado
        $post->save();
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($request->all());

         // Guardar el log
         Log::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'action' => 'Actualizado',
        ]);

        return redirect()->route('posts.index')->with('success', 'Post actualizado correctamente.');
    }

    public function destroy(Post $post)
    {

        Log::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'action' => 'Eliminado',
        ]);

        $post->delete();


        return redirect()->route('posts.index')->with('success', 'Post eliminado correctamente.');
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $posts = Post::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('body', 'like', '%' . $keyword . '%')
            ->get();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }
}
