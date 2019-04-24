@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row text-center">

    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">

            <a href="{{route('createContract')}}" class="btn btn-lg btn-default">Create Contract</a>
        </div>
        <div class="col-md-6">

            <a href="{{route('allBidding')}}" class="btn btn-lg btn-default">Show Bidding</a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
