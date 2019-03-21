@extends('layouts.app')
@section('content')
<div class="container">

  <div class="tab-wrap">   
    <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
    <label for="tab1">All bid</label>

    <div class="tab__content">        
        <div class="tab-pane fade in active" id="home">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>PROJECT NAME</th>
                <th>BIDS</th> {{-- how many bids are there?  --}}
                <th>AWARDED BID</th>  {{-- how much did u take the bid?!    --}}
                <th>TIME</th>  {{-- EX: 1 year ago   --}}
                <th>Status</th>  {{-- EX: completed or incomleted   --}}
                <th>Details</th>  {{-- EX: 1 year ago   --}}
              </tr>
            </thead>
            <tbody>    
              @foreach($data as $bid)
                <tr>
                  <td>{{$bid->id}}</td>
                  <td>{{(count((array)$bid->provider_ids))}}</td>
                  <td>{{$bid->avg('amount')}}</td>
                  <td>{{$bid->created_at}}</td>
                  <td>{{$bid->status}}</td>
                  <td> <button class="btn btn-default"><a href="{{route('bidDetails', ['bid_id' => $bid->id])}}">Details</a></button></td>
                </tr>
              @endforeach  
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
@endsection
