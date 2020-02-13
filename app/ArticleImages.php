<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImages extends Model
{
    protected $table = 'article_images';
    
    protected $fillable = [ 'image','article_id' ];
}
