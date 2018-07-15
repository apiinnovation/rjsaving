<?php

//Route::group( [ 'middleware' => ['web'] ], function () 
//{
//    //this route will use the middleware of the 'web' group, so session and auth will work here         
//    Route::get('/', function () {
//        dd( Auth::user() );
//    });       
//});



Route::auth();


Route::get('/', 'HomeController@index');
Route::get('/regis/{username?}', 'HomeController@regis');
Route::post('/updateUser', 'HomeController@updateUser');
Route::get('/regis_main/{fullname?}', 'HomeController@regis_main');



Route::resource('/TComMPrefix','TComMPrefixController');
Route::resource('/TComMDivision','TComMDivisionController');
Route::resource('/TStkMCustomer','TStkMCustomerController');
Route::any('/TStkMCustomer/add','TStkMCustomerController@add');
Route::any('/TStkMCustomer/addfind','TStkMCustomerController@addfind');


//branch
Route::get('/branch/{bchcode?}','BranchController@index');
Route::post('/branch/save','BranchController@save');
Route::any('/branch/del/{bchcode}','BranchController@del');

//เพิ่มหุ้น
Route::get('/stkup_main/{cuscode?}','stkUpController@main_list');
Route::get('/stkup/{docno?}','stkUpController@index');
Route::get('/stkup_getcus/{cuscode}','stkUpController@get_customer');
Route::post('/stkup_save','stkUpController@save');
Route::get('/findcus/{cuscode?}','cusController@findcus');


//ลดหุ้น
Route::get('/stkdown_main/{cuscode?}','stkDownController@main_list');
Route::get('/stkdown/{docno?}','stkDownController@index');
Route::get('/stkdown_getcus/{cuscode}','stkDownController@get_customer');
Route::post('/stkdown_save','stkDownController@save');
//Route::get('/findcus/{cuscode?}','cusController@findcus');
