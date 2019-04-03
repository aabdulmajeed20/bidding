@extends('layouts.app')
@section('content')
<head>
  <meta charset="UTF-8">
  <title>Underline hover test</title>
  
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> --}}

  
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  
</head>

<div class="container "> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <a href="http://elwin.vdhazel.com/" target="_blank" class="link">Physical Grain</a>
                        </div>
                        <div class="col-md-6">
                            <a href="http://elwin.vdhazel.com/" target="_blank" class="link">Cash Equivalent</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br/>
</div>
  @endsection
