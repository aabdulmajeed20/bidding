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
          <div class="form-group col-md-8">
            <input type="text" class="form-control" value="{{$purchase['token']}}" readonly>
          </div>
          <div class="col-md-2">
            <a class="btn btn-primary" href="#"><i class="fas fa-clipboard"></i> Copy</a>
          </div>
        </div>
      </form>

      <div class="card">
          <div class="card-body">
            <h5> Amount: {{$purchase['request']->amount}} CBX</h5>
            <h5> Price: {{$purchase['offer']->price}} SAR</h5>
          </div>
      </div>
    @endif
   </div>
   @endsection
