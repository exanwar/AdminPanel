<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'slag', 'author', 'status'
    ];

    public function posts(){
        return $this->hasMany(Blogs::class, 'id');
    }

    public function author(){
        return $this->belongsTo(User::class, 'author');
    }
}
