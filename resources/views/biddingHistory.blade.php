@extends('layouts.app')
@section('content')
<div class="container">

  <div class="tab-wrap">
    <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
    <label for="tab1">All Requests</label>

    <input type="radio" id="tab2" name="tabGroup1" class="tab">
    <label for="tab2">Open Requests</label>

    <input type="radio" id="tab3" name="tabGroup1" class="tab">
    <label for="tab3">Closed Requests</label>


    <div class="tab__content">
        <div class="tab-pane fade in active" id="home">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Request ID</th>
                <th>Amount</th>
                <th>Number of Offers	</th> {{-- how many bids are there?  --}}
                <th>Timestamp</th>  {{-- EX: 1 year ago   --}}
                <th>Status</th>  {{-- EX: 1 year ago   --}}
                <th colspan="2">Tools</th>  {{-- EX: completed or incomleted   --}}

              </tr>
            </thead>
            <tbody>
              @foreach($bids as $bid)
                <tr>
                  <td>{{$bid->id}}</td>
                  <td>{{$bid->amount}} CBX</td>
                  <td>{{$bid->offer()->count()}} offer(s)</td>
                  <td>{{$bid->created_at}}</td>
                  <td>{{$bid->status}}</td>
                  <td colspan="2">
                    <div class="row">
                      <div class="col-md-4">
                        <a class="btn btn-default" href="#"><i class="fas fa-flag"></i></a>
                      </div>
                      <div class="col-md-4">
                        <a class="btn btn-default" href="#"><i class="fas fa-trash"></i></a>
                      </div>
                      <div class="col-md-4">
                        <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}"><i class="fas fa-book-open"></i></a>
                      </div>
                    </div>
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
                    <th>Number of Offer	</th>
                    <th>AVG BID</th>
                    <th>BID END DATE</th>
                    <th>Details</th>
                  </tr>
             </thead>
             <tbody>
                @foreach($bids as $bid)
                 @if ($bid->status == 'open')
                  <tr>
                      <td>{{$bid->id}}</td>
                      <td>{{$bid->offer()->count()}}</td>
                      <td>avg bid</td> {{-- {{$bid->groupBy($bid->id)->avg(amount)}} --}}
                      <td>{{$bid->created_at}}</td>
                      <td> <button class="btn btn-default"><a href="{{route('bidDetails', ['bid_id' => $bid->id])}}">Details</a></button></td>
                    </tr>
                 @endif
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
                <th>Number of Offer	</th> {{-- how many bids are there?  --}}
                <th>Bidder Name </th> {{-- who did you buy from!?   --}}
                <th>AWARDED BID</th>  {{-- how much did u take the bid?!    --}}
                <th>TIME</th>  {{-- EX: 1 year ago   --}}
                <th>Status</th>  {{-- EX: completed or incomleted   --}}
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bids as $bid)
                @if ($bid->status == "close")
                  <tr>
                    <td>{{$bid->id}}</td>
                    <td>{{$bid->offer()->count()}}	</td> {{-- {{($bid->provider_ids)->count()}} --}}
                    <td>{{$bid->first()->user()->first()->name}}</td> {{-- get the user name  --}}
                    <td>{{$bid->offer()->max('price')}}</td> {{-- {{$bid->max(amount)}} --}}
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
               @endif
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

  </div>
</div>
@endsection
