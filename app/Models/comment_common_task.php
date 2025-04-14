<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment_common_task extends Model
{
    protected $table = 'comment_common_task';
    protected $primaryKey = 'id';
    protected $fillable = ['comment', 'user_id', 'title', 'description'];
}
