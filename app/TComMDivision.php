<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TComMDivision extends Model
{
    protected $table ='TComMDivision';
    protected $fillable=['XVDivCode','XVDivName','XVBchCode','XVWhoEdit','XVWhoCreate','XTWhenEdit','XTWhenCreate'];
    //protected $primaryKey='XVDivCode';
    //protected $foreignkey='XVBchCode';


    public function TComMBranch() {
        //return $this->belongsTo(TComMBranch::class, 'XVBchCode'); //กําหนด FK ด้วย
    }    
}
