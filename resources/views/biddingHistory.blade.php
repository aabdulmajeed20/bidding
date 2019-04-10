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
                <th>Number of Offers	</th> 
                <th>Timestamp</th>  
                <th>Status</th>  
                <th colspan="2">Tools</th>  

              </tr>
            </thead>
            <tbody>
              @foreach($bids as $bid)
                <tr>
                  <td>{{$bid->id}}</td>
                  <td>{{$bid->amount}} CBX</td>
                  <td>{{$bid->offer()->count()}} offer(s)</td>
                  <td>{{$bid->created_at}}</td>

                  @if ($bid->status == "open")
                    <td><strong class="text-success">OPEN</strong></td>
                  @else
                    <td><strong class="text-danger">CLOSED</strong></td>
                  @endif
                  <td colspan="2">
                    <div class="row">
                      <div class="col-md-4">
                        <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-flag"></i></a>
                      </div>
                      @if ($bid->status == "open")
                        <div class="col-md-4">
                          <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-trash"></i></a>
                        </div>
                      @endif
                      <div class="col-md-4">
                        <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-book-open"></i></a>
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
                      <td>{{$bid->amount}} CBX</td>
                      <td>{{$bid->offer()->count()}} offer(s)</td>
                      <td>{{$bid->created_at}}</td>
                      <td colspan="2">
                        <div class="row">
                          <div class="col-md-4">
                            <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-flag"></i></a>
                          </div>
                          <div class="col-md-4">
                            <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-trash"></i></a>
                          </div>
                          <div class="col-md-4">
                            <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-book-open"></i></a>
                          </div>
                        </div>
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
                <th>Number of Offers</th>
                <th>Purchase Price</th> 
                <th>Timestamp</th> 
                <th colspan="2">Tools</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bids as $bid)
                @if ($bid->status == "closed")
                  <tr>
                    <td>{{$bid->id}}</td>
                    <td>{{$bid->offer()->count()}}	offer(s)</td> 
                    <td>{{$bid->offer()->max('price')}}</td>
                    <td>{{$bid->created_at}}</td>
                    <td colspan="2">
                      <div class="row">
                        <div class="col-md-6">
                          <a class="btn btn-default" href="#" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-flag"></i></a>
                        </div>
                        <div class="col-md-6">
                          <a class="btn btn-default" href="{{route('bidDetails', ['bid_id' => $bid->id])}}" data-toggle="tooltip" data-placement="right" title="write Description"><i class="fas fa-book-open"></i></a>
                        </div>
                      </div>
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
