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

      <form method="post" action="{{route('addOffer', ['bid_id' => $bid_id])}}">
        @csrf

      <div class="row">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-8">

              <label>Price Offer for {{ \App\Bid::where('_id',$bid_id)->first()->amount}} Baskets (in <strong>{{Auth::guard('provider')->user()->currency}}</strong>):</label>
          </div>
          <div class="col-md-4"></div>
          <div class="form-group col-md-5">
            <input type="number" value="{{ number_format($Convert->getPrice(Auth::guard('provider')->user()->currency, \App\Bid::where('_id',$bid_id)->first()->amount), 3)}}" class="form-control" name="offerPrice" id="offerPrice" readonly>
          </div>
          <div class="col-md-1">
            <a href="#"><i class="fas fa-info-circle"></i></a>
          </div>
        </div>


        <div class="row">
          <div class="col-md-4"></div>
            <div class="col-md-8">
              <label>Price premium for Your Offer (in <strong>{{Auth::guard('provider')->user()->currency}}</strong>):</label>
            </div>
            <div class="col-md-4"></div>
            <div class="form-group col-md-5">
                <input type="number" placeholder="0.00" step="0.001" class="form-control" name="premiumPrice" id="premiumPrice" required>
            </div>
            <div class="col-md-1">
              <a href="#"><i class="fas fa-info-circle"></i></a>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <label>Total Offer (in <strong>{{Auth::guard('provider')->user()->currency}}</strong>):</label>
            </div>

            <div class="col-md-4"></div>
            <div class="form-group col-md-5">
                <input type="number" id="total" class="form-control" disabled>
            </div>
            <div class="col-md-1">
              <a href="#"><i class="fas fa-info-circle"></i></a>
            </div>
          </div>
          <div class="row">

            <div class="col-md-5"></div>
            <div class="form-check col-md-3">
              <input type="checkbox" class="form-check-input" id="agreement1" required>
              <label class="form-check-label" for="agreement1">agreement1</label>
            </div>
            <div class="col-md-1">
              <a href="#"><i class="fas fa-info-circle"></i></a>
            </div>
          </div>
          <div class="row">

            <div class="col-md-5"></div>
            <div class="form-check col-md-3">
              <input type="checkbox" class="form-check-input" id="agreement2" required>
              <label class="form-check-label" for="agreement2">agreement2</label>
            </div>
            <div class="col-md-1">
              <a href="#"><i class="fas fa-info-circle"></i></a>
            </div>
          </div>
          <div class="row">

            <div class="col-md-5"></div>
            <div class="form-check col-md-3">
              <input type="checkbox" class="form-check-input" id="agreement3" required>
              <label class="form-check-label" for="agreement3">agreement3</label>
            </div>
            <div class="col-md-1">
              <a href="#"><i class="fas fa-info-circle"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6"></div>
            <div class="form-group col-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
          </div>

      </form>
   </div>

   <script type="text/javascript">
     $(document).ready(function(){

      $('#total').val(parseFloat($('#offerPrice').val().replace(",","")).toFixed(3));
       $('#premiumPrice').keyup(function(){

           $('#total').val((parseFloat($('#offerPrice').val()) + parseFloat($('#premiumPrice').val())).toFixed(3));


       });

     });
   </script>
   @endsection
