<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blog_models';

    protected $fillable = [
        'title', 'slag', 'category','tag','author','description','status','image'
    ];

    public function category(){
        return $this->belongsTo(Categories::class, 'category');
    }

    public function author(){
        return $this->belongsTo(User::class, 'author');
    }
}
