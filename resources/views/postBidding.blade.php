@extends('layouts.app')
@section('content')


  <div class="container">
    <br/>
    @if (\Session::has('failed'))
      <div class="alert alert-danger">
        <p>{{ \Session::get('failed') }}</p>
      </div><br />
      @endif

      <form method="post" action="{{route('postBid')}}">
        @csrf

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="amount">Amount of Baskets:</label>
            <input type="number" step="0.001" class="form-control" name="amount" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="cover">Cover Type:</label>
            <select class="form-control" id="cover" name="cover" required>
              <option disabled selected>-- SELECT --</option>
              <option value="g">Physical Grain</option>
              <option value="c">Cash Equivalent</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-6">
            <label for="market">Market:</label>
            <div class="radio">
              <label>
                <input type="radio" value="none" id="market" class="form-control" name="market" checked> <strong>International Market</strong>
              </label>
            </div>
          <hr />
          <div class="radio">
            <label>
              <input type="radio" value="local" id="market" class="form-control" name="market"> <strong>Local Market</strong> <small>[{{\App\User::where('_id',Session::get('user_id'))->first()->country}}]</small>
            </label>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
     </div>
   @endsection
