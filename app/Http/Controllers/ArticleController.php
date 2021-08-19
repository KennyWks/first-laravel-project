<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\User;

class ArticleController extends Controller
{ 
    public function index(){
        
        $title = '';
        if(request('categoryModel')){
            $category = CategoryModel::firstWhere('slug', request('categoryModel'));
            $title = ' in ' . $category->name;
        }

        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        
        return view('articles', [
            "title" => "All Article " .$title,
            "active" => "article",
            "rows" => ArticleModel::latest()->filter(request(['search', 'categoryModel', 'author']))->paginate(7)->withQueryString(),
            //lazy load
            // "rows" => ArticleModel::latest()->get(),
            // "rows" => ArticleModel::all(),
        ]);
    }

    public function show(ArticleModel $articleModel){
        return view('article', [
            "title" => "Single Article",
            "active" => "article",
            "row" => $articleModel,
        ]);
    }

    // public function show($slug){
    //     return view('article', [
    //         "title" => "Article",
    //         "row" => ArticleModel::find($slug),
    //     ]);
    // }
}
