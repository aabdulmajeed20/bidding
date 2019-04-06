@extends('layouts.app')
@section('content')
  @inject('Convert', 'App\CBX\Currency')

  <div class="container">
    <br/>
    @if (\Session::has('failed'))
      <div class="alert alert-danger">
        <p>{{ \Session::get('failed') }}</p>
      </div><br />
      @endif
    </div>
      <form method="post" action="{{route('addOffer', ['bid_id' => $bid_id])}}">
        @csrf

        <div class="row">
          <div class="col-md-5"></div>
          <div class="col-md-7">

              <label>Price Offer for {{ \App\Bid::find($bid_id)->first()->amount}} CBX (in <strong>{{Auth::guard('provider')->user()->currency}}</strong>):</label>
          </div>
          <div class="col-md-5"></div>
          <div class="form-group col-md-3">
            <input type="number" value="{{ $Convert->getPrice(Auth::guard('provider')->user()->currency, \App\Bid::find($bid_id)->first()->amount)}}" class="form-control" name="offerPrice" id="offerPrice" readonly>
          </div>
          <div class="col-md-1">
            <a href="#"><i class="fas fa-info-circle"></i></a>
          </div>
        </div>


        <div class="row">
          <div class="col-md-5"></div>
          <div class="col-md-7">

            <label>Price Premuim for Your Offer (in <strong>{{Auth::guard('provider')->user()->currency}}</strong>):</label>
          </div>

          <div class="col-md-5"></div>
          <div class="form-group col-md-3">
              <input type="number" placeholder="0.00" step="0.01" class="form-control" name="PremuimPrice" id="PremuimPrice" required>
          </div>

          <div class="col-md-1">
            <a href="#"><i class="fas fa-info-circle"></i></a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5"></div>
          <div class="col-md-7">

            <label>Total Offer (in <strong>{{Auth::guard('provider')->user()->currency}}</strong>):</label>
          </div>

          <div class="col-md-5"></div>
          <div class="form-group col-md-3">
              <input type="number" id="total" class="form-control" disabled>
          </div>

          <div class="col-md-1">
            <a href="#"><i class="fas fa-info-circle"></i></a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
   </div>

   <script type="text/javascript">
     $(document).ready(function(){

      $('#total').val(parseFloat($('#offerPrice').val()));
       $('#PremuimPrice').keyup(function(){

           $('#total').val(parseFloat($('#offerPrice').val()) + parseFloat($('#PremuimPrice').val()));


       });

     });
   </script>
   @endsection
