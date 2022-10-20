<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class students extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','email','password','phone'
    ,'p_phone','verified'];
}
