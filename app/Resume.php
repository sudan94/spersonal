<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = "resume";
    protected $fillable = ['name','started','ended','institution','description','type'];
}
