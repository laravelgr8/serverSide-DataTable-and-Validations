<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function pay(){
    //     return view('payment-form');
    // }

    // public function payment(Request $request){
    //     $data=$request->all();
    //     \Stripe\Stripe::setApiKey('sk_test_51MBgcsSC4b1LIgo4Z06JQG50Fnz9XYQUySgLVD1GCHD87eertEwAI6PDKAasHfMzmjbgAmXisFRBVdTyHJ3VmdxX00Q2HXWMlp'); //Serret key
    //     $charge = \Stripe\Charge::create([
    //       'source' => $_POST['stripeToken'],
    //       'description' => "10 cucumbers from Roger's Farm",
    //       'amount' => 500,
    //       'currency' => 'inr',
    //     ]);

    //     dd($charge);
    // }


    
}
