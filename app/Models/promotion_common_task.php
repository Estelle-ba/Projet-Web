<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promotion_common_task extends Model
{
    protected $table = 'promotion_common_task';
    protected $primaryKey = 'promotion_task_id';
    protected $fillable = ['promotion', 'task_id'];
}
