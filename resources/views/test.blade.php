
<!-- history.blade.php -->
@extends('layouts.app')
@section('content')
  <div class="container">
    <h2> History</h2>
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br/>
     @endif
      <ul id="myTab" class="nav nav-tabs">
          <li class="active"><a href="#home" data-toggle="tab">All</a>
          </li>
          <li><a href="#receiver" data-toggle="tab">Received</a>
          </li>
          <li><a href="#sender" data-toggle="tab">Sent</a>
          </li>
      </ul>
      
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>PROJECT NAME</th>
                  <th>BIDS</th> {{-- how many bids are there?  --}}
                  <th>Bidder Name </th> {{-- how did you buy from!?   --}}
                  <th>AWARDED BID</th>  {{-- how much did u take the bid?!    --}}
                  <th>TIME</th>  {{-- EX: 1 year ago   --}}
                  <th>Details</th>  {{-- EX: 1 year ago   --}}
                </tr>
              </thead>
              <tbody>                
                <tr>
                  <td>majeed ZG!</td>
                  <td>8</td>
                  <td>3mk Ahmed</td>
                  <td>30 CBX</td>
                  <td>1 year ago</td>
                <td>
                    <select id="selectbox" data-selected="">
                        <option value="" selected="selected" disabled="disabled">Select</option>
                        <option value="1">Repost</option>
                        <option value="2">Delete</option>
                      </select>
                    </td> 
                </tr>
              </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="receiver">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Sender Name</th>
                    <th>amount</th>
                    <th>Date</th>
                    <th>Details</th>
                  </tr>
                </thead>
                    <tbody>                    
                      <tr>
                        <td>Hi there!</td>
                        <td>Hi there!</td>
                        <td>Hi there!</td>
                        <td> <button class="btn btn-default"><a href="">Details</a></button> </td>
                      </tr>
                    </tbody>
              </table>
        </div>

        <div class="tab-pane fade" id="sender">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                            <th>Receiver Name</th>
                            <th>amount</th>
                            <th>Date</th>
                            <th>Details</th>
                      </tr>
                    </thead>
                        <tbody>
                          <tr>
                                <td>Hi there!</td>
                                <td>Hi there!</td>
                                <td>Hi there!</td>
                                <td> <button class="btn btn-default"><a href=" ">Details</a></button></td>
                          </tr>
                        </tbody>
                  </table>
            </div>
      </div>
  </div>
  
  @endsection



