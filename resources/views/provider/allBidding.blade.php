@extends('layouts.app')
@section('content')
<div class="container">

  <div class="tab-wrap">
    <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
    <label for="tab1">All Requests</label>

    <div class="tab__content">
        <div class="tab-pane table-responsive fade in active " id="home">
          <table class="table table-bordered table-hover table-striped ">
            <thead>
              <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Offers Count</th>
                <th>Post Time</th>
                <th>Status</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>

              @foreach($data as $bid)
                @if ($bid->cover == Auth::guard('provider')->user()->cover && ($remaining_balance  >= $bid->amount && $remaining_balance !== false))
                  <tr class="
                  @if($bid->offer()->where('provider_id',Auth::guard('provider')->id())->count() > 0)
                    table-dark text-muted

                  @else
                    table-default
                  @endif
                  ">
                    <td>{{$bid->id}}</td>
                    <td>{{$bid->amount}} Baskets</td>
                    <td>{{$bid->offer()->count()}}</td>


                    <td>{{$bid->created_at->diffForHumans()}}</td>
                    @if ($bid->status == 'open')
                      <td><span class="text-success">Unfilled</span></td>
                    @else
                      <td><span class="text-danger">Filled</span></td>
                    @endif
                    <td> <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}">Details</a></td>
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
