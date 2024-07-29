<?php

namespace App\Http\Controllers;

use App\Jobs\SendPostEmail;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function search($term)
    {
        $posts = Post::search($term)->get();
        $posts->load('user:id,username,avatar');
        return $posts;
    }

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
        $input['title'] = strip_tags($input['title']);
        $input['body'] = strip_tags($input['body']);

        Post::create($input);

        dispatch(new SendPostEmail(['sendTo' => auth()->user()->email, 'name' => auth()->user()->username, 'title' => $request->title]));

        return redirect('/profile/' . auth()->user()->username)->with('success', 'پست شما با موفقیت ایجاد شد.');
    }

    public function storePostApi(Request $request)
    {
        $input = $request->validate([
            'title' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:20'],
        ]);

        $input['user_id'] = auth()->id();
        $input['title'] = strip_tags($input['title']);
        $input['body'] = strip_tags($input['body']);

        $post = Post::create($input);

        dispatch(new SendPostEmail(['sendTo' => auth()->user()->email, 'name' => auth()->user()->username, 'title' => $request->title]));

        return $post->id;
    }


    public function showSinglePost(Post $post)
    {
        return view('single-post', compact('post'));
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/profile/' . auth()->user()->username)->with('success', 'پست شما با موفقیت حذف شد.');
    }

    public function deleteApi(Post $post)
    {
        $post->delete();
        return 'Post deleted successfuly';
    }

    public function showEditForm(Post $post)
    {
        return view('edit-post', compact('post'));
    }

    public function updatePost(Post $post, Request $request)
    {
        $input = $request->validate([
            // 'title' => ['required', 'max:50']
            'title' => 'required|max:50',
            'body' => 'required'
        ]);

        $input['user_id'] = $post->user_id;
        $input['title'] = strip_tags($input['title']);
        $input['body'] = strip_tags($input['body']);

        $post->update($input);
        return back()->with('success', 'پست شما با موفقیت ویرایش شد.');
    }
}
