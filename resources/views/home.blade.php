@extends('layouts.app')

@section('content')
<div class="container">
    <div class="create">
        <button type="button" class="btn btn-success btn-lg">Create bidding</button>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{$name}} </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <a href=" {{route('bidding')}} " class="btn btn-success full-button"><h3>Open Bid</h3></a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('biddingHistory') }}" class="btn btn-primary full-button"><h3>Show bidding History</h3></a>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    <br/>
</div>
@endsection
