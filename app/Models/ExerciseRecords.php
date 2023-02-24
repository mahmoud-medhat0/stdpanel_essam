<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseRecords extends Model
{
    use HasFactory;
    protected $fillable = ['date','created_at','Branch_id','sec_id','maximum'];
}
