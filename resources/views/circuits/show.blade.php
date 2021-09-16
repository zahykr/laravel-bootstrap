@extends('layouts.master')


@section('content')
    

<div class="col-md-12">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <muted class="d-inline-block mb-2 text-info">
          @foreach ($circuit->categories as $category)
              {{ $category->name }}{{ $loop->last ? '' : ', '}}
          @endforeach
        </muted>
        <h5 class="mb-0">{{ $circuit->titre }}</h5>
        <span>{!! $circuit->description !!}</span><br>
        <strong class="mb-0 display-0 text-secondary">{{ $circuit->getPrix() }}</strong>
        <form action="{{ route('cart.store') }}" method="POST">
           @csrf 
           <input type="hidden" name="circuit_id" value="{{ $circuit->id }}">
            <button type="submit" class="btn btn-dark"> Ajouter à ma selection</button>
        </form>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img src="{{ asset('storage/' . $circuit->image) }}" alt="">
      </div>          
    </div>
  </div>

@endsection