<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create')
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function store(CreatePostsRequest $request)
    {
        // upload the image to storage
        $image = $request->image->store('posts');

        // create the post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        // flash a message
        session()->flash('success', 'Post created successfully.');

        // redirect user
        return redirect(route('posts.index'));

    }

    public function show($id)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('posts.create')
            ->with('post', $post)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function update(UpdatePostsRequest $request, Post $post)
    {
        // dd($request->all());

        // save only important request data to variable
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category_id', 'user_id']);

        // check if there is an image
        if ($request->hasFile('image')) {
            // upload the image to a variable
            $image = $request->image->store('posts');

            // delete old image
            $post->deleteImage();

            $data['image'] = $image;
        }

        // check if tags came in then sync
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        // update attributes
        $post->update($data);

        // flash a message
        session()->flash('success', 'Post updated successfully.');

        // redirect user
        return redirect(route('posts.index'));

    }

    public function destroy($id)
    {
        // find the post
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        // dd($post);

        // delete post
        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
        } else {
            $post->delete();
        }
        // flash a message
        session()->flash('success', 'Post deleted successfully.');
        // redirect to posts home
        return redirect()->route('posts.index');
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        // flash a message
        session()->flash('success', 'Post restored successfully.');

        // redirect to posts home
        return redirect()->back();
    }
}
