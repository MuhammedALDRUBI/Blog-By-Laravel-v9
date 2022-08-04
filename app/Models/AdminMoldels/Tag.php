<?php

namespace App\Models\AdminMoldels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tag_name'
    ];


    public function posts(){
        return $this->belongsToMany(Post::class , "post_tag" , "tag_id" , "post_id" );
    }
}
