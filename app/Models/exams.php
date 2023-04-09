<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exams extends Model
{
    use HasFactory;
    protected $fillable = ['std_id','date','degree','created_at','branch_id','sec_type_id','exam_record','payed'];

}
