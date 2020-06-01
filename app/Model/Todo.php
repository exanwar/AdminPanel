<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    protected $fillable = [
        'todo', 'project_id', 'category','status','done_by','comment'
    ];

    public function project(){
        return $this->belongsTo(Projects::class, 'project_id', 'project_id');
    }

}
