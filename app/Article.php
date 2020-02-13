<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    protected $table = 'articles';
    
    protected $fillable = [ 'title','description','author' ];

    
}
