<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $fillable = ['test_id','question_id','question','answer_id','answer','IsTrue','language'];
}
