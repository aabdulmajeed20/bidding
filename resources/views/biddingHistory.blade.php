@extends('layouts.app')
@section('content')
<div class="container">

  <div class="tab-wrap">
    <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
    <label for="tab1">All Requests</label>

    <input type="radio" id="tab2" name="tabGroup1" class="tab">
    <label for="tab2">Unfilled Requests</label>

    <input type="radio" id="tab3" name="tabGroup1" class="tab">
    <label for="tab3">Filled Requests</label>


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
                  <td>{{$bid->amount}} Baskets</td>
                  <td>{{$bid->offer()->count()}} offer(s)</td>
                  <td>{{$bid->created_at->diffForHumans()}}</td>

                  @if ($bid->status == "open")
                    <td><strong class="text-success">Unfilled</strong></td>
                  @else
                    <td><strong class="text-primary">Filled</strong></td>
                  @endif
                  <td colspan="2">
                    <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}"><i class="fas fa-book-open"></i> Details</a>
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
                    <th>Request ID </th>
                    <th>Amount</th>
                    <th>Number of Offers</th>
                    <th>Timestamp</th>
                    <th colspan="2">Tools</th>
                  </tr>
             </thead>
             <tbody>
                @foreach($bids as $bid)
                 @if ($bid->status == 'open')
                  <tr>
                      <td>{{$bid->id}}</td>
                      <td>{{$bid->amount}} Baskets</td>
                      <td>{{$bid->offer()->count()}} offer(s)</td>
                      <td>{{$bid->created_at->diffForHumans()}}</td>
                      <td colspan="2">
                        <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}"><i class="fas fa-book-open"></i> Details</a>
                      </td>
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
                <th>Request ID</th>
                <th>Number of Offers</th> {{-- how many bids are there?  --}}
                <th>Purchase Price</th>  {{-- how much did u take the bid?!    --}}
                <th>Timestamp</th>  {{-- EX: 1 year ago   --}}
                <th colspan="2">Tools</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bids as $bid)
                @if ($bid->status == "closed")
                  <tr>
                    <td>{{$bid->id}}</td>
                    <td>{{$bid->offer()->count()}}	offer(s)</td> {{-- {{($bid->provider_ids)->count()}} --}}
                    <td>{{--intval(\App\Offer::where('_id', $bid->offer_id)->first()->price + intval(\App\Offer::where('_id', $bid->offer_id)->first()->premium)}}</td> {{-- {{$bid->max(amount)}} --}}
                  </td>
                    <td>{{$bid->created_at->diffForHumans()}}</td>
                    <td colspan="2">
                        <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}"><i class="fas fa-book-open"></i> Details</a>
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
