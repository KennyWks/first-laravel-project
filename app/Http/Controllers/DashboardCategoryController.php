<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('Administrator');
        return view('dashboard.categories.index', [
            'categories' => Category::filter(request(['search']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Administrator');
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Administrator');
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:category',
        ];

        $input = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ];

        $messages = [
            'required' => 'This field is required.',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('/dashboard/categories/create')->withErrors($validator)->withInput();
        }

        Category::create($input);

        return redirect('/dashboard/categories')->with('success', 'New category has added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('Administrator');
        return view('dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('Administrator');
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:category',
        ];

        $input = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ];

        $messages = [
            'required' => 'This field is required.',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('/dashboard/categories/create')->withErrors($validator)->withInput();
        }

        Category::where('id', $category->id)->update($input);

        return redirect('/dashboard/categories')->with('success', 'New categories has updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('Administrator');
        $data = Post::where('category_id', $category->id)->count();
        if ($data == 0) {
            Category::destroy($category->id);
            return redirect('/dashboard/categories')->with('success', 'Category has removed!');
        }

        return redirect('/dashboard/categories')->with("success", "Category hasn't removed!");
    }
}
