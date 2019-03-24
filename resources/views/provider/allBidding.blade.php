@extends('layouts.app')
@section('content')
<div class="container">

  <div class="tab-wrap">
    <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
    <label for="tab1">All Requests</label>

    <div class="tab__content">
        <div class="tab-pane fade in active" id="home">
          <table class="table table-bordered table-hover table-striped ">
            <thead>
              <tr>
                <th>ID</th>
                <th>Offers Count</th> {{-- how many bids are there?  --}}
                <th>Offerable?</th>  {{-- how much did u take the bid?!    --}}
                <th>Post Time</th>  {{-- EX: 1 year ago   --}}
                <th>Status</th>  {{-- EX: completed or incomleted   --}}
                <th>Details</th>  {{-- EX: 1 year ago   --}}
              </tr>
            </thead>
            <tbody>
              @foreach($data as $bid)
                <tr>
                  <td>{{$bid->id}}</td>
                  <td>{{$bid->offer()->count()}}</td>
                  @if ($bid->offer()->where('provider_id',Auth::guard('provider')->id())->count() > 0)
                    <td><span class="text-danger">False</span></td>
                  @else
                    <td><span class="text-success">True</span></td>
                  @endif

                  <td>{{$bid->created_at}}</td>
                  @if ($bid->status == 'open')
                    <td><span class="text-success">OPEN</span></td>
                  @else
                    <td><span class="text-danger">CLOSED</span></td>
                  @endif
                  <td> <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}">Details</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
@endsection
