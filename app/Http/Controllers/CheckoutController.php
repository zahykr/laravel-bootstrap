<?php

namespace App\Http\Controllers;

use App\Order;
use DateTime;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::count() <= 0) {
            return redirect()->route('circuits.index');
        }
        Stripe::setApiKey('sk_test_51GxCDEE7MNAa6RUBlkZjSAtRle8O9iDSzTwx3bb1XshKabtgu7ZRuj4yBTxypRZ5JpJwUUHJxFXxV1uxfELd2Zur00ssqQ2xqT');
        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),
            'currency' => 'eur',
         
          ]);
          $clientSecret = Arr::get($intent, 'client_secret');
        return view ('checkout.index', [
            'clientSecret' => $clientSecret
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->json()->all();
        $order = new Order();
        $order->payment_intent_id = $data['paymentIntent']['id'];
        $order->payment_amount = $data['paymentIntent']['amount'];
        $order->payment_created_at = (new DateTime())
            ->setTimestamp($data['paymentIntent']['created'])
            ->format('y-m-d H:i:s');
 
        $circuits = [];
        $i = 0;

        foreach (Cart::content() as $circuit) {
            $circuits['circuit_' . $i][] = $circuit->model->titre;
            $circuits['circuit_' . $i][] = $circuit->model->prix;
            $circuits['circuit_' . $i][] = $circuit->model->qty;
            $i++;

        }

        $order->circuits = serialize($circuits);
        $order->user_id = Auth()->user->id;
        $order->save();

        if ($data['paymentIntent']['status'] == 'succeeded') {
            Cart::destroy();
           Session::flash('success','Votre demande de réservation a été traitée avec succès');
            return response()->json(['success'=> 'Payment Intent Succeeded']);
        }else {
            return response()->json(['error'=> 'Payment Intent Not Succeeded']);
        }

      
    }

    public function thankyou(){
        return Session::has('success') ? view('checkout.thankyou') : redirect()->route('circuits.index');
  }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
