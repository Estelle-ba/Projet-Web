<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CohortBilan extends Model
{
    protected $table = 'cohorts_bilan';
    protected $primaryKey = 'id';
    public $fillable =['test_id','test_language','ratting','total','user_id'];
}
