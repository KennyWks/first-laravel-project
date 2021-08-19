<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'exceprt', 'body'];
    protected $guarded = ['id'];
    protected $with = ['author', 'categoryModel'];

    public function scopeFilter($query, array $filters){
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //    return $query->where('title', 'like', '%'.$filters['search'].'%')->orWhere('body', 'like', '%'.$filters['search'].'%');
        // }
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('title', 'like', '%'.$search.'%')->orWhere('body', 'like', '%'.$search.'%');
        });

        $query->when($filters['categoryModel'] ?? false, function($query, $categoryModel){
            return $query->whereHas('categoryModel', function($query) use ($categoryModel){
                $query->where('slug', $categoryModel);
            });
        });

        $query->when($filters['author'] ?? false, function($query, $author){
            return $query->whereHas('author', function($query) use ($author){
                $query->where('username', $author);
            });
        });

        // $query->when($filters['author'] ?? false, fn($query, $author) =>
        //     $query->whereHas('author', fn($query) => 
        //         $query->where('username', $author)
        //     )
        // );
    }

    public function categoryModel(){
        return $this->belongsTo(CategoryModel::class); 
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
