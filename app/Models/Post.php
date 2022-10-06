<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Reaction;

class Post extends Model
{
    use HasFactory,Markable;
    protected $fillable = [
        'url',
        'tipo',
        'size',
        'palabras_clave',
        'user_id',
        'descripcion',
        'slug',
        'post_reactions_count',
        'categoria'
    ];
    public function categories()
    {
    return $this->belongsToMany(Category::class, 'post_category','posts_id',);
    }
    public function user($id)
   {
    return User::find($id);
    // return $this->belongsTo(User::class, 'user_id','id');
   }
   protected static $marks = [
    Reaction::class,
];
}
