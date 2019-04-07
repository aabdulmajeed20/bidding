@extends('layouts.app')
@section('content')


<div class="container">
  @if(Auth::guard('provider')->check() && $offerable)
    <div class="create" style="margin-bottom: 14px;">
        <a class="btn btn-primary btn-lg" href="{{route('createOffer', ['bid_id' => $bid->id])}}">Add an offer</a>
    </div>
  @endif
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="panel panel-default text-left">
        <div class="panel-body">
          <p contenteditable="false"><strong>Request Amount: {{$bid->amount}} CBX</strong></p>
          <p contenteditable="false"><strong>Coverage Type: {{$bid->cover == 'g'? 'Physical Grain' : 'Marked By Market'}}</strong></p>
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
            <a href="{{route('buyOffer', ['id' => $offer->id])}}" class="btn btn-primary btn-sm float-right"> Buy </a>
            @endif
            <div class="price-wrap h5">
              <span class="price-new">{{$offer->price + $offer->premuim}} {{$offer->currency}}</span>
            </div> <!-- price-wrap.// -->
          </div> <!-- action-wrap -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col // -->
  @endforeach
  <br><br><br>

@endsection
