<?php

namespace App\Models\AdminMoldels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cat_name',
        'parent_cat'
    ];

    public function parent_cat()
    {
        return $this->belongsTo(Category::class , "parent_cat" , "id");
    }

    public function child_cats()
    {
        return $this->hasMany(Category::class , "parent_cat" , "id");
    }

    public function posts()
    {
        return $this->hasMany(Post::class , "category_id" , "id");
    }
}
