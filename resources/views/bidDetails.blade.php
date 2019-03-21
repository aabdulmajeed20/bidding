@extends('layouts.app')
@section('content')


<div class="container">
  @if(Auth::guard('provider')->check())
    <div class="create" style="margin-bottom: 14px;">
        <button type="button" class="btn btn- btn-lg"><a href="{{route('createOffer', ['bid_id' => $bid->id])}}">add offer</a></button>
    </div>
  @endif
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="panel panel-default text-left">
        <div class="panel-body">
          <p contenteditable="false">Your Bidding: {{$bid->amount}}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
      @foreach ($offers as $offer)  
    <div class="col-md-3" style="margin-top: 8px">
      <figure class="card card-product">
        <figcaption class="info-wrap" style="padding: 5px;">
          <h6 class="title text-dots"><a href="#">{{$offer->provider()->first()->name}}</a></h6>
          <div class="action-wrap">
            @if(!Auth::guard('provider')->check())
            <a href="{{route('buyOffer', ['price' => $offer->price])}}" class="btn btn-primary btn-sm float-right"> Buy </a>
            @endif
            <div class="price-wrap h5">
              <span class="price-new">{{$offer->price}} cbx</span>
            </div> <!-- price-wrap.// -->
          </div> <!-- action-wrap -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col // -->
  @endforeach
  <br><br><br>

@endsection