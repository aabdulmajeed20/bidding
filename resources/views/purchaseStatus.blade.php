@extends('layouts.app')
@section('content')


  <div class="container">
    <br/>
    @if (\Session::has('failed'))
      <div class="alert alert-danger">
        <p>{{ \Session::get('failed') }}</p>
      </div><br />
      @endif

    @if ($purchase['status'] == 'success')
      <form>
        @csrf

        <div class="row">
          <div class="col-md-4"> </div>
          <div class="col-md-8">
              <h2>Contract Token:</h2>
          </div>
          <div class="col-md-2"></div>
          <div class="form-group col-md-7">
            <input type="text" class="form-control" value="{{$purchase['token']}}" readonly>
          </div>
          <div class="col-md-1">
            <a class="btn btn-primary" href="#"><i class="fas fa-clipboard"></i> Copy</a>
          </div>

          <div class="col-md-1">
            <a class="btn btn-primary" href="http://{{env('CBX_API')}}/Issuance/Claim/{{base64_encode($purchase['token'])}}"><i class="fas fa-wallet"></i> Claim</a>
          </div>
        </div>
      </form>

      <div class="card">
          <div class="card-body">
            <h5> Amount: {{$purchase['request']->amount}} Baskets</h5>

            <h5> Price: {{number_format(floatval(str_replace(',', "", $purchase['offer']->price)), 2)}} {{$purchase['offer']->currency}}</h5>
            <h5> premium: {{number_format(floatval(str_replace(',', "", $purchase['offer']->premium)), 2)}} {{$purchase['offer']->currency}}</h5>
            <h5> Price: {{number_format(floatval(str_replace(',', "", $purchase['offer']->price)) + floatval(str_replace(',', "", $purchase['offer']->premium)), 2)}} {{$purchase['offer']->currency}}</h5>
            <h5> Purchased From: {{\App\Provider::where('_id', $purchase['offer']->provider_id)->first()->name}}</h5>
          </div>
      </div>
    @endif
   </div>
   @endsection
