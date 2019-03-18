@extends('layouts.app')
@section('content')
<div class="container">

  <div class="tab-wrap">   
    <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
    <label for="tab1">All bid</label>
  
    <input type="radio" id="tab2" name="tabGroup1" class="tab">
    <label for="tab2">Open Bid</label>
  
    <input type="radio" id="tab3" name="tabGroup1" class="tab">
    <label for="tab3">Closed Bid</label>
  
  
    <div class="tab__content">        
        <div class="tab-pane fade in active" id="home">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>PROJECT NAME</th>
                <th>BIDS</th> {{-- how many bids are there?  --}}
                <th>Bidder Name </th> {{-- how did you buy from!?   --}}
                <th>AWARDED BID</th>  {{-- how much did u take the bid?!    --}}
                <th>TIME</th>  {{-- EX: 1 year ago   --}}
                <th>Status</th>  {{-- EX: completed or incomleted   --}}
                <th>Details</th>  {{-- EX: 1 year ago   --}}
              </tr>
            </thead>
            <tbody>    
              @foreach($bids as $bid)
                <tr>
                  <td>{{$bid->id}}</td>
                  <td>provider name</td> {{-- {{($bid->provider_ids)->count()}} --}}
                  <td>avg bid</td> {{-- {{$bid->groupBy($bid->id)->avg(amount)}} --}}
                  <td>{{$bid->created_at}}</td>
                  <td>{{$bid->status}}</td>
                  <td>
                    <select id="selectbox" data-selected="">
                      <option value="" selected="selected" disabled="disabled">Select</option>
                      <option value="1">Repost</option>
                      <option value="2">Delete</option>
                    </select>
                  </td> 
                </tr>
              @endforeach  
            </tbody>
          </table>
      </div>
    </div>
  
    <div class="tab__content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NAME </th>
                    <th>BIDS</th>
                    <th>AVG BID</th>
                    <th>BID END DATE</th>
                    <th>Details</th>
                  </tr>
             </thead>
             <tbody>
                @foreach($bids as $bid)
                 <tr>
                     <td>{{$bid->id}}</td>
                     <td>provider name</td> {{-- {{($bid->provider_ids)->count()}} --}}
                     <td>avg bid</td> {{-- {{$bid->groupBy($bid->id)->avg(amount)}} --}}
                     <td>{{$bid->created_at}}</td>
                     <td> <button class="btn btn-default"><a href="{{route('bidDetails', ['bid_id' => $bid->id])}}">Details</a></button></td>
                  </tr>
                @endforeach  
              </tbody>
          </table>
    </div>
  
      <div class="tab__content">        
        <div class="tab-pane fade in active" id="home">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>PROJECT NAME</th>
                <th>BIDS</th> {{-- how many bids are there?  --}}
                <th>Bidder Name </th> {{-- who did you buy from!?   --}}
                <th>AWARDED BID</th>  {{-- how much did u take the bid?!    --}}
                <th>TIME</th>  {{-- EX: 1 year ago   --}}
                <th>Status</th>  {{-- EX: completed or incomleted   --}}
                <th>ACTION</th>  
              </tr>
            </thead>
            <tbody>   
              @foreach($bids as $bid)
                <tr>
                  <td>{{$bid->id}}</td>
                  <td>provider name</td> {{-- {{($bid->provider_ids)->count()}} --}}
                  <td>{{$bid->first()->user()->first()->name}}</td> {{-- get the user name  --}}
                  <td>max bidding</td> {{-- {{$bid->max(amount)}} --}}
                  <td>{{$bid->created_at}}</td>
                  <td>{{$bid->status}}</td>
    
                  <td>
                    <select id="selectbox" data-selected="">
                        <option value="" selected="selected" disabled="disabled">Select</option>
                        <option value="1">Repost</option>
                        <option value="2">Delete</option>
                      </select>
                  </td> 
              </tr>
              @endforeach  
            </tbody>
          </table>
      </div>
    </div>
  
  </div>
</div>
@endsection
