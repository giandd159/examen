<?php

namespace App\Http\Controllers;
use App\Models\Post; 
use App\Models\Log; 
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Post $post)
    {
        $logs = $post->logs()->orderBy('created_at', 'desc')->get();

        return inertia('Logs/Index', [
            'post' => $post,
            'logs' => $logs, 
        ]);
    }
}