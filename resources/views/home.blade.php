@extends('layouts.app')

@section('content')
<div class="container">
    <div class="create">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row text-center">
                        <div class="col-md-6">
                         <a class="btn btn-success btn-lg" href="{{ route('addBid') }}"><h3>Create Request</h3></a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('biddingHistory') }}" class="btn btn-primary btn-lg"><h3>Show bidding History</h3></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br/>
</div>
@endsection
