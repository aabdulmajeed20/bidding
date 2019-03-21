@extends('layouts.app')
@section('content')
    

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
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="amount">offer:</label>
            <input type="number" step="0.001" class="form-control" name="price" required>
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