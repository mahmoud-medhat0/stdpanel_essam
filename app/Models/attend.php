<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attend extends Model
{
    use HasFactory;
    protected $table = 'attendence';
    protected $fillable = ['id','std_id','date','degree','created_at','branch_id','sec_type_id','attend_record','reset','hw','payed','attendence'];
    }
