<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::controller('accounts', 'AccountsController');
Route::controller('perks', 'PerksController');
Route::controller('web', 'WebController');
// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');

Route::get('transactions', function () {
    return view('employees-transactions');
});
Route::get('logout', function(){
    if (Auth::check()){
        Auth::logout();
        return view('public');
    }
});

Route::get('/', function () {
    return view('public');
});
Route::get('/membersarea', function () {
    return view('membersarea');
});
Route::get('/forgot-password', function () {
    return view('forgot-password');
});
Route::get('/create-password', function () {
    return view('create-password');
});
Route::get('/yeeperks', function () {
    return view('yeeperks');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/perkdetails', function () {
    return view('perkdetails');
});

/*
Route::get('redeem', function () {
    if(!Auth::check()){
        return view('login');
    }
    return view('redeem');
});
*/
Route::get('/merch___', function () {
    $min = 1;
    $max = 99999;
    $year = date("Y");
    $membershipNumber = "";
    $temp = "";
    $isComplete = false;
    $merchants = App\Merchant::all();

    foreach ($merchants as $row) {
        $subcode = substr(str_replace(" ","",$row->company_name),0,3);
//dd($subcode);
        while(!$isComplete){
            $temp = rand($min, $max);
            if(strlen($temp) == 3){
                $membershipNumber = "YM".$subcode.$temp;
                $isComplete = true;
            }
        }
        //dd($membershipNumber);
        if ($isComplete == true){
            $merchant = App\Merchant::find($row->id);
            $merchant->merchant_code = strtoupper($membershipNumber);
            $merchant->save();
        }
        $membershipNumber = "";
        $isComplete = false;
    }
});
