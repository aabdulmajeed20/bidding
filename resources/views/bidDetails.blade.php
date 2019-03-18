@extends('layouts.app')
@section('content')


<div class="container">
<<<<<<< HEAD:resources/views/bidDetails.blade.php
    <div class="create" style="margin-bottom: 14px;">
        <button type="button" class="btn btn-success btn-lg">bid</button>
    </div>
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="panel panel-default text-left">
        <div class="panel-body">
          <p contenteditable="false">Your Bidding: {{$bid->amount}}</p>
=======

  <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default text-left">
          <div class="panel-body">
          <p contenteditable="false">Your Bidding: {{$user->name}}</p>
          </div>
>>>>>>> cb8a26c962f2ae99e0a11bd6d034fb3e15ff63d0:resources/views/bidding.blade.php
        </div>
      </div>
    </div>
  </div> 
  <div class="row">
    <div class="col-md-3">
      <figure class="card card-product">
        <figcaption class="info-wrap">
          <h6 class="title text-dots"><a href="#">Bidder name</a></h6>
          <div class="action-wrap">
            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
            <div class="price-wrap h5">
              <span class="price-new">cbx1280</span>
              <del class="price-old">cbx1980</del>
            </div> <!-- price-wrap.// -->
          </div> <!-- action-wrap -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col // -->
    <div class="col-md-3">
      <figure class="card card-product">
        <figcaption class="info-wrap">
          <h6 class="title text-dots"><a href="#">The The provider Name!</a></h6>
          <div class="action-wrap">
            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
            <div class="price-wrap h5">
              <span class="price-new">cbx280</span>
            </div> <!-- price-wrap.// -->
          </div> <!-- action-wrap -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col // -->
    <div class="col-md-3">
      <figure class="card card-product">
        <figcaption class="info-wrap">
          <h6 class="title text-dots"><a href="#">The provider Name!</a></h6>
          <div class="action-wrap">
            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
            <div class="price-wrap h5">
              <span class="price-new">cbx280</span>
            </div> <!-- price-wrap.// -->
          </div> <!-- action-wrap -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col // -->
    <div class="col-md-3">
      <figure class="card card-product">
        <figcaption class="info-wrap">
          <h6 class="title text-dots"><a href="#">The The provider Name!</a></h6>
          <div class="action-wrap">
            <a href="#" class="btn btn-primary btn-sm float-right"> Buy </a>
            <div class="price-wrap h5">
              <span class="price-new">cbx280</span>
            </div> <!-- price-wrap.// -->
          </div> <!-- action-wrap -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col // -->
  </div> <!-- row.// -->
  </div> 
  <!--container end-->

  <br><br><br>
  <article class="bg-secondary mb-3">  
  <div class="card-body text-center">
      <h4 class="text-white">جميع الحقوق محفوظة لي!  </h4>
  <p class="h5 text-white">عمك أحمد</p>   <br>
  <i class="fa fa-window-restore "></i></a></p>
  </div>
  </article>  

@endsection