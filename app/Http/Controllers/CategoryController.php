<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function index(){
        return view('categories', [
            "title" => "Category",
            "active" => "categories",
            "rows" => CategoryModel::latest()->get(),
        ]);
    }

    public function show(CategoryModel $categoryModel){
        return view('articles', [
            'title' => $categoryModel->name,
            "active" => "categories",
            'rows' => $categoryModel->article,
        ]);
    }

    // public function show($slug){
    //     return view('article', [
    //         "title" => "Article",
    //         "row" => ArticleModel::find($slug),
    //     ]);
    // }
}
