<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DevDept extends Model
{
    protected $table = 'dev_depts';

    protected $fillable = [
        'dev_id','project_id', 'dev_username', 'dev_name', 'dev_email', 'dev_type', 'dev_image','group', 'tasks'
    ];

    public function dev(){
        return $this->belongsTo(User::class, 'dev_id', 'id');
    }
}
