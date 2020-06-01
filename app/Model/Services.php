<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'title', 'slag', 'category','image','duration','price','status','short_description', 'description', 'responsibilities_duties', 'required_things', 'rating'
    ];


    public function category(){
        return $this->belongsTo(Categories::class, 'category', 'id');
    }
}
