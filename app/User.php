<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'TComMUser';
    protected $fillable=['username', 'password', 'XVEmpCode', 'XVPrecode', 'XVPreName', 'XVUserFName', 'XVUserLName', 'XVBchCode', 'XVBchName', 'XBIsSave', 'XBIsApprove', 'XBIsReport', 'XBisPrint', 'XVWhoEdit', 'XVWhoCreate', 'XTWhenEdit', 'XTWhenCreate'];
    //public $timestamps = false;
    //protected $primaryKey = 'username';




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
