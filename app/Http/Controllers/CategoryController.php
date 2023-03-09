<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        return view('categories', [
            "title" => "Category",
            "rows" => Category::latest()->get(),
        ]);
    }

    public function show(Category $category){
        return view('posts', [
            'title' => $category->name,
            'rows' => $category->post,
        ]);
    }
}
