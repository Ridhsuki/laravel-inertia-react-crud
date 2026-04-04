<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'content'
    ];
}
