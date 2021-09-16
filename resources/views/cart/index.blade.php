@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="col-md-12">
    <h1>Ma liste des selections </h1>
</div>
@if (Cart::count() > 0)
 <div class="px-4 px-lg-0">
    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">Circuit</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Prix</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Nombre de place souhaité</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Supprimer</div>
                            </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach (Cart::content() as $circuit)
                             <tr>
                                  <th scope="row" class="border-0">
                                    <div class="p-2">
                                        <img src="{{ $circuit->model->image }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0"> <a href="{{ route('circuits.show', ['slug' => $circuit->model->slug]) }}" class="text-dark d-inline-block align-middle">{{ $circuit->model->title }}</a></h5>
                                            <span class="text-muted font-weight-normal font-italic d-block">Category:</span>
                                        </div>
                                      </div>
                                  </th>
                                  <td class="border-0 align-middle"><strong>{{ getPrix($circuit->subtotal()) }}</strong></td>
                                  <td class="border-0 align-middle">
                                    <select class="custom-select" name="qty" id="qty" data-id="{{ $circuit->rowId }}">
                                      @for ($i = 1; $i <= 10; $i++)
                                          <option value="{{ $i }}" {{ $circuit->qty == $i ? 'selected' : ''}}>
                                              {{ $i }}
                                          </option>
                                      @endfor
                                  </select>
                                    </td>
                                  <td class="border-0 align-middle">
                                      <form action="{{ route('cart.destroy', $circuit->rowId) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                      </form>
                                  </td>
                             </tr>
                            @endforeach
                         </tbody>
                    </table>
                    </div>
                    <!-- End -->
                </div>
             </div>
             <div class="row py-20 p-25 bg-white rounded shadow-sm">
                     <div class="col-lg-0">
                     <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Détails de la réservation </div>
                     <div class="p-4">
                        <p class="font-italic mb-4">Si vous détenez un code Coupon, entrez-le dans le champ ci-dessous</p>
                        <div class="input-group mb-4 border rounded-pill p-2">
                            <input type="text" placeholder="ABC-123" aria-describedby="button-addon3" class="form-control border-0">
                            <div class="input-group-append border-0">
                                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Appliquer le coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <p class="font-italic mb-4">Si vous souhaitez ajouter des précisions à votre réservation, merci de les rentrer dans le champ ci-dessous</p>
                    <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                </div>
            </div>
            
                        <ul class="list-unstyled mb-4">
                           <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous-total </strong><strong>{{ getPrix(Cart::subtotal()) }}</strong></li>
                           {{--<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li> --}}
                           <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Commission</strong><strong>{{ getPrix(Cart::tax()) }}</strong></li>
                           <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                            <strong>{{ getPrix(Cart::total()) }}</strong>
                           </li>
                        </ul>
                        <a href="{{ route('checkout.index') }}" class="btn btn-dark rounded-pill py-2 btn-block">Passer à la caisse</a>
                       </div>
                    </div>
               </div>
             </div>
        </div>
     </div>
 @else
 <div class="col-md-12">
  <h5>Votre panier est vide pour le moment.</h5>
  <p>Mais vous pouvez visiter notre  <a href="{{ route('circuits.index') }}">page de booking</a> pour faire votre séléction.
  </p>
</div>
 @endif

@endsection

@section('extra-js')
<script>
    var qty = document.querySelectorAll('#qty');
    Array.from(qty).forEach((element) => {
        element.addEventListener('change', function () {
            var rowId = element.getAttribute('data-id');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch((`/selection/${rowId}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'PATCH',
                    body: JSON.stringify({
                        qty: this.value
                    })
            }).then((data) => {
                console.log(data);
                location.reload();
            }).catch((error) => {
                console.log(error);
            });
        });
    });
</script>
@endsection

 



