<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = ['id','name','username','email','password','phone'
    ,'p_phone','verified','sec_type_id','gender','sumprep'];
}
