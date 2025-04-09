<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonLife extends Model
{
    protected $table        = 'CommonLife';
    protected $fillable     = ['user_id', 'title', 'description'];
}
