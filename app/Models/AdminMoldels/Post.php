<?php

namespace App\Models\AdminMoldels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Post extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Title',
        'Content',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class , "category_id" , "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }


    public function image()
    {
        return $this->hasOne(Image::class , "post_id" , "id");
    }


    public function tags(){
        return $this->belongsToMany(Tag::class , "post_tag" , "post_id"  ,  "tag_id" );
    }
}
