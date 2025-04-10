<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonLife extends Model
{
    protected $table        = 'CommonLife';
    protected $primaryKey = 'task_id';
    protected $fillable     = ['user_id', 'title', 'description', 'done', 'effectuate_by_id', 'comments'];
}
