<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TComMPrefix extends Model
{
        protected $table ='TComMPrefix';
        protected $fillable=['XVPreCode','XVPreName','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate'];

}
