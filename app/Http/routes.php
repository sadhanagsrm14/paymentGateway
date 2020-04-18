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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/stripe', function () {
    return view('stripe');
});
Route::get('/paypal', function () {
    return view('paypal');
});
Route::get('/payUMoney', function () {
    return view('PayUMoney');
});

Route::post('/testdata', function () {
   $stripe = array(
          //First
          //"secret_key"      => "sk_test_wmnjELkBVFD3q4AtNp3OW7Gm",
          //"publishable_key" => "pk_test_kICkFBFwnM3NWymgZxxOPYAX"
        //Second
          "secret_key"      => "sk_test_a6wN9bdjJHIdau6FmPyXajOo00T6RCMYlz",
          "publishable_key" => "pk_test_zE4z0NIJ2SiYXeTkbaLg36PG00sSMWW4RP"
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        echo $token  = $_POST['stripeToken'];

        $customer = \Stripe\Customer::create(array(
            'email' => 'customer@example.com',
            'source'  => $token
        ));

        $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount'   => 5000,
            'currency' => 'usd'
        ));
        echo '<h1>Successfully charged $50.00!</h1>';
});
