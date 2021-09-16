@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection




@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
  <div class="col-md-12">
    <a href="{{ route('cart.index') }}" class="btn btn-sm btn-secondary mt-3">Revenir au panier</a>
     <div class="row">
        <div class="col md-6 mx-auto">
           <h4 class="text-center pt-5">Procéder au paiement</h4>
           <form action="{{ route('checkout.store') }}" method="POST" class="my-4" id="payment-form">
              @csrf
              <div id="card-element">
              <!-- Elements will create input elements here -->
              </div>

              <!-- We'll put the error messages in this element -->
              <div id="card-errors" role="alert"></div>

              <button class="btn btn-success btn-block mt-3" id="submit">
                  <i class="fa fa-credit-card" aria-hidden="true"></i> Payer maintenant ({{ getPrix(Cart::total()) }})
              </button>
          </form>
       </div>
     </div>
</div>
    
@endsection

@section('extra-js')
   <script>
      //Suppression de la barre de navigation
    document.getElementsByClassName('blog-header')[0].classList.add("d-none");
    document.getElementsByClassName('nav-scroller')[0].classList.add("d-none");



    // Paiement Stripe
      var stripe = Stripe('pk_test_51GxCDEE7MNAa6RUBV7ezCab80RNDxsgP8xCmETaYy92lJCk46o2r0Yn5y6Etfodc6qUkJgNDwk2J2I7vrATaswjA00nsArAKFU');
      var elements = stripe.elements(); 
      var style = {
          base: {
          color: "#32325d",
          fontFamily: '"Raleway", Helvetica, sans-serif',
          fontSmoothing: "antialiased",
          fontSize: "16px",
          "::placeholder": {
          color: "#aab7c4"
          }
         },
         invalid: {
         color: "#fa755a",
         iconColor: "#fa755a"
         }
        };
     var card = elements.create("card", { style: style });
     card.mount("#card-element");
     var submitButton = document.getElementById('submit');
     
</script>   
@endsection
