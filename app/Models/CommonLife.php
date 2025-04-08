<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonLife extends Model
{
    protected $table        = 'livingTask';
    protected $fillable     = ['task_id' , 'user_id', 'title', 'description'];
}
