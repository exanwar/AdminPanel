<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Todo;
use App\Model\DevDept;

class Projects extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'project_id','name', 'slag', 'logo','category_id','customer_id','reference_id','description','invoice','ammount','starting_date','deadline','duration', 'status', 'privacy'
    ];

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function referal(){
        return $this->belongsTo(User::class, 'reference_id', 'id');
    }

    public function todos(){
        $short = 'desc';
        return $this->hasMany(Todo::class, 'project_id', 'project_id');
    }

    public function devs(){
        return $this->hasMany(DevDept::class, 'project_id', 'project_id');
    }
}
