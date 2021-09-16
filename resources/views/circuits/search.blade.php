@extends('layouts.master')

@section('content')

@foreach ($circuits as $circuit)
<div class="col-md-6">
  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
        <small class="d-inline-block text-info mb-2">
          @foreach ($circuit->categories as $category)
              {{ $category->name }}{{ $loop->last ? '' : ', '}}
          @endforeach
        </small>
      <h5 class="mb-0">{{ $circuit->titre }}</h5>
      <div class="mb-1 text-muted">{{ $circuit->created_at->format('d/m/y') }}</div>
      <p class="mb-auto">{{ $circuit->sousTitre }}</p>
      <strong class="mb-auto">{{ $circuit->getPrix() }}</strong>
      <a href="{{ route('circuits.show', $circuit->slug) }}" class="stretched-link btn btn-info"><i class="fa fa-location-arrow" aria-hidden="true"></i> Voir la descripton de circuit</a>
    </div>
    <div class="col-auto d-none d-lg-block">
       <img src="{{ asset('storage/' . $circuit->image) }}" alt="">
    </div>          
  </div>
</div>
@endforeach


{{ $circuits->appends(request()->input())->links() }} 

@endsection