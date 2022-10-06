<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =
    [
        'titulo',
        'slug',
        'color',
        'in_menu',
        'estado',
    ];
    public function posts(){

        return $this->belongsToMany(Post::class,'post_category','category_id','posts_id');
        // return $this->belongsToMany(Post::class,'post_category');
    }
}
