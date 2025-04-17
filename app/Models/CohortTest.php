<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CohortTest extends Model
{
    protected $table = 'cohort_test';
    protected $primaryKey = 'id';
    protected $fillable = ['cohort_id', 'test_id'];
}
