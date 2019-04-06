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
      <form method="post" action="{{route('postBid')}}">
        @csrf

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="amount">CBX Amount:</label>
            <input type="number" step="0.001" class="form-control" name="amount" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="cover">Coverage:</label>
            <select class="form-control" id="cover" name="cover" required>
              <option disabled selected>-- SELECT --</option>
              <option value="g">Physical Grain</option>
              <option value="c">Marked By Market (Cash Equivalent)</option>
            </select>
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
