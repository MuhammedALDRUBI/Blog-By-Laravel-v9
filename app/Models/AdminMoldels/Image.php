<?php

namespace App\Models\AdminMoldels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected  $table = "images";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'folder_path',
        'image_name',
        'post_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class , "post_id" , "id");
    }
}
