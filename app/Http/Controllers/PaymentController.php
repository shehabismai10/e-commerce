<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;

class PaymentController extends Controller
{
    // View for Stripe payment
    public function Stripe(Request $request)
    {
        $total = session('cart_total', 0); // Default to 0 if not set
        return view('payment.stripe', compact('total'));
    }

    // Handle Stripe payment
    public function StripePost(Request $request)
    {



        //convert dollars to cents
        $total = session('cart_total', 0);
        $totalAmount = $total;
        $totalAmount=$totalAmount*100;





        // \Stripe\Stripe::setApiKey(config('.env(STRIPE_SECRET)'));
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));


        $session=\Stripe\Checkout\Session::create([

            'line_items'  =>[
                [
                    'price_data'=>[
                        'currency' =>'usd',
                        'product_data'=>[
                            'name'=>'send me money',
                        ],
                        'unit_amount'=>$totalAmount,
                    ],
                    'quantity'=>1,
                ],
            ],
            'mode' =>'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('stripe.post'),




        ]);












        // // Validate input
        // $request->validate([
        //     'total_amount' => 'required|numeric|min:0',
        //     'stripeToken' => 'required',
        // ]);

        // $totalAmount = $request->input('total_amount');

        // try {
        //     // Set Stripe API key
        //     Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        //     // Create a PaymentIntent
        //     $paymentIntent = Stripe\PaymentIntent::create([
        //         'amount' => $totalAmount * 100, // in cents
        //         'currency' => 'usd',
        //         'payment_method' => $request->stripeToken,
        //         'description' => 'Test payment from shehab ismail',
        //         'confirm' => true,
        //     ]);



        return redirect()->away($session->url);
    }


    public function success(){
        return view('payment.success');

    }


}


