<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendRecord extends Model
{
    use HasFactory;
    protected $fillable = ['date','money','Branch_id','sec_id'];
}
