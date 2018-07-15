<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
         //dd();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required',
            'password' => 'required',
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],            
            'password' => bcrypt($data['password']),
            'XVEmpCode' => $data['XVEmpCode'],
            'XVPrecode' => $data['XVPrecode'],
            'XVPreName' => $data['XVPreName'],
            'XVUserFName' => $data['XVUserFName'],
            'XVUserLName' => $data['XVUserLName'],
            'XVBchCode' => $data['XVBchCode'],
            'XVBchName' => $data['XVBchName'],
            'XBIsSave' => $data['XBIsSave'],
            'XBIsApprove' => $data['XBIsApprove'],
            'XBIsReport' => $data['XBIsReport'],
            'XBIsPrint' => $data['XBisPrint'],
            'XBIsActive' => $data['XBIsActive'],
            'XVWhoEdit' => 'admin',
            'XVWhoCreate' => 'admin'          
        ]);
    }
}
