<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('Writer');
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->latest()->filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Writer');
        return view('dashboard.posts.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Writer');
        $input = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'category_id' => $request->input('category_id'),
            'image' => $request->file('image'),
            'body' => $request->input('body'),
        ];

        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required|unique:post',
            'category_id' => 'required',
            'image' => 'image|file|max:2024',
            'body' => 'required',
        ];

        $messages = [
            'required' => 'This field is required.',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('/dashboard/posts/create')->withErrors($validator)->withInput();
        }

        if ($request->file('image')) {
            $input['image'] = $request->file('image')->store('post-images');
        }

        $input['user_id'] = auth()->user()->id;
        $input['excerpt'] = Str::limit(strip_tags($request->body, 200));

        Post::create($input);

        return redirect('/dashboard/posts')->with('success', 'New post has added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('Writer');
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('Writer');
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('Writer');
        $input = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'category_id' => $request->input('category_id'),
            'image' => $request->file('image'),
            'body' => $request->input('body'),
        ];

        $rules = [
            'title' => 'required|max:255',
            'slug' => $request->input('slug') != $post->slug ? 'required|unique:post' : '',
            'category_id' => 'required',
            'image' => 'image|file|max:2024',
            'body' => 'required',
        ];

        $messages = [
            'required' => 'This field is required.',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('/dashboard/posts/'. $post->slug .'/edit')->withErrors($validator)->withInput();
        }

        $input['user_id'] = auth()->user()->id;
        $input['excerpt'] = Str::limit(strip_tags($request->body, 200));

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $input['image'] = $request->file('image')->store('post-images');
        }

        Post::where('id', $post->id)->update($input);

        return redirect('/dashboard/posts')->with('success', 'New post has updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('Writer');
        if ($post->image) {
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'New post has removed!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['value' => $slug]);
    }
}
