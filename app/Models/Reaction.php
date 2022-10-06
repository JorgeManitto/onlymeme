<?php

namespace App\Models;

use Maize\Markable\Mark;

class Reaction extends Mark
{

    public static function markableRelationName(): string
    {
        return 'reacters';
    }
    protected static function booted()
    {
        static::created(function (Reaction $reaction) {

            if ($reaction->markable_type === Post::class) {
                Post::where('id', $reaction->markable_id)->increment('post_reactions_count');
            }
        });
    }
}
