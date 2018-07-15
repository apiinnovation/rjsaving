<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TComMBranch extends Model
{
    protected $table ='TComMBranch';
    protected $fillable=['XVBchCode','XVBchName','XVBchPhone','XVBchFax','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate'];

}