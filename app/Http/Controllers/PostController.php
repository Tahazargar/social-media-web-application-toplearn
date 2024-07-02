<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showCreatePostForm()
    {
        return view('create-post');
    }

    public function storePost(Request $request)
    {
        $input = $request->validate([
            'title' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:20'],
        ]);

        $input['user_id'] = auth()->id();
        Post::create($input);
        return 'Done';
    }

    public function showSinglePost(Post $post)
    {
        return view('single-post', compact('post'));
    }
}
