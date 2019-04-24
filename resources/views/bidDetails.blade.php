@extends('layouts.app')
@section('content')
@inject('Convert', 'App\CBX\Currency')

<div class="container">

  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="panel panel-default text-left">
        <div class="panel-body">
          <p contenteditable="false"><strong>Issuer: {{$bid->user()->first()->firstname}} {{$bid->user()->first()->lastname}}</strong></p>
          <p contenteditable="false"><strong>Request Amount: {{$bid->amount}} Baskets</strong></p>
          <p contenteditable="false"><strong>Cover Type: {{$bid->cover == 'g'? 'Physical Grain' : 'Cash Equivalent'}}</strong></p>
          <p contenteditable="false"><strong>Total Offers: {{$bid->offer()->count()}}</strong></p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    @if(Auth::guard('provider')->check() && $offerable)
      <div class="col-md-3" style="margin-top: 10px">
        <figure class="card card-product">
          <figcaption class="info-wrap" style="padding: 10px;">
            <h6 class="title text-dots"><strong><a href="#">{{Auth::guard('provider')->user()->name}}</a></strong></h6>
            <div class="action-wrap text-center">
              <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newOfferModal" href="#">Make an Offer</a>
            </div> <!-- action-wrap -->
          </figcaption>
        </figure> <!-- card // -->
      </div> <!-- col // -->
      <div class="modal fade" id="newOfferModal" tabindex="-1" role="dialog" aria-labelledby="newOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="newOfferModalLabel">Place an Offer for {{$bid->amount}} Baskets</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="{{route('addOffer', ['bid_id' => $bid->id])}}">

            <div class="modal-body">
                @csrf
                <fieldset class="form-group">
                  <label for="offerPrice">Baskets Price for {{$bid->amount}} baskets in {{Auth::guard('provider')->user()->currency}}</label>
                  <input type="text" value="{{ number_format($Convert->getPrice(Auth::guard('provider')->user()->currency, $bid->amount), 2)}}" class="form-control" name="offerPrice" id="offerPrice" readonly>
                  <small class="text-muted">the price of {{$bid->amount}} baskets in USD multiplies by {{Auth::guard('provider')->user()->currency}} exchange rate</small>
                </fieldset>
                <fieldset class="form-group">
                  <label for="premiumPrice">Baskets Price for {{$bid->amount}} baskets in {{Auth::guard('provider')->user()->currency}}</label>
                  <input type="number" placeholder="0.00" step="0.01" class="form-control" name="premiumPrice" id="premiumPrice" required>
                  <small class="text-muted">the premium to your offer</small>
                </fieldset>
                <fieldset class="form-group">
                  <label for="total">Baskets Price for {{$bid->amount}} baskets in {{Auth::guard('provider')->user()->currency}}</label>
                  <input type="text" id="total" class="form-control" disabled>
                  <small class="text-muted">Offer + premium in {{Auth::guard('provider')->user()->currency}}</small>
                </fieldset>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> agreement1
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> agreement2
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> agreement3
                  </label>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit Offer</button>
            </div>
          </form>
          </div>
        </div>
        <script type="text/javascript">
        function numberWithCommas(number) {
            var parts = number.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
          $(document).ready(function(){
           $('#total').val($('#offerPrice').val());
           if($('#premiumPrice').val() != ''){
             final = numberWithCommas((parseFloat($('#offerPrice').val().replace(/,/g,"")) + parseFloat($('#premiumPrice').val())).toFixed(2));
             $('#total').val(final);
           }else{
             $('#total').val($('#offerPrice').val());
           }
            $('#premiumPrice').keyup(function(){
              if($('#premiumPrice').val() != ''){
                final = numberWithCommas((parseFloat($('#offerPrice').val().replace(/,/g,"")) + parseFloat($('#premiumPrice').val())).toFixed(2));
                $('#total').val(final);
              }else{
                $('#total').val($('#offerPrice').val());
              }

            });

          });
        </script>
      </div>
    @endif
    @if (isset($bid->offer_id))
      @php
      $offer = \App\Offer::where('_id',$bid->offer_id)->first();
      $underwriter = \App\Provider::where('_id',$offer->provider_id)->first();
      @endphp
      <div class="col-md-8" style="margin: 10px auto;">
        <figure class="card card-product">
          <figcaption class="info-wrap" style="padding: 10px;">
            <h3 class="title text-dots"><strong>Sold By:
              <a data-toggle="modal" data-target="#profile-{{$underwriter->id}}" href="#">{{Auth::guard('provider')->user()->name}}</a>
            <small>  - [{{$bid->updated_at}}]</small>
            </strong></h3>
            <div class="action-wrap text-justify">
              <strong class="price">Price : {{number_format(floatval(str_replace(',', "", $offer->price)), 2)}} {{$offer->currency}}</strong>
              <hr />
              <strong class="price">premium : {{number_format(floatval(str_replace(',', "", $offer->premium)), 2)}} {{$offer->currency}}</strong>
              <hr />
              <strong class="price">Total : {{number_format(floatval(str_replace(',', "", $offer->price)) + floatval(str_replace(',', "", $offer->premium)), 2)}} {{$offer->currency}}</strong>

              @if ($offer->currency != GeoIP(Request::ip())->currency)
                <small class="price">
                  ({{ number_format($Convert->covertPrice($offer->currency, GeoIP(Request::ip())->currency ,floatval(str_replace(',', "", $offer->price)) + floatval(str_replace(',', "", $offer->premium))), 2)}} {{GeoIP(Request::ip())->currency}})
                </small>

              @endif

            </div> <!-- action-wrap -->
          </figcaption>
        </figure> <!-- card // -->
      </div> <!-- col // -->

      <div class="modal fade" id="profile-{{$underwriter->id}}" tabindex="-1" role="dialog" aria-labelledby="profile-{{$underwriter->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="profile-{{$underwriter->id}}Label">{{$underwriter->name}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <dl class="">
                <dt>Underwriter Name</dt>
                <dd>{{$underwriter->name}}</dd>

                <dt>Underwriter Location</dt>
                <dd>{{$underwriter->city}}, {{$underwriter->country}}</dd>

                <dt>Underwriter Currency</dt>
                <dd>{{$underwriter->currency}}</dd>

                <dt>Underwriter Portfolio Size</dt>
                <dd>{{number_format($underwriter->portfolio_size)}} Baskets</dd>
              </dl>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    @else
      @foreach ($offers as $offer)
    <div class="col-md-3" style="margin-top: 10px">
      <figure class="card card-product">
        <figcaption class="info-wrap" style="padding: 10px;">

          <h6 class="title text-dots"><strong><a data-toggle="modal" data-target="#profile-{{$offer->provider()->first()->_id}}"  href="#">{{$offer->provider()->first()->name}}</a></strong></h6>
          <div class="action-wrap">
            <div class="price-wrap h5">
              <strong class="price">Price : {{number_format(floatval(str_replace(',', "", $offer->price)), 2)}} {{$offer->currency}}</strong>
              <hr />
              <strong class="price">premium : {{number_format(floatval(str_replace(',', "", $offer->premium)), 2)}} {{$offer->currency}}</strong>
              <hr />
              <strong class="price">Total : {{number_format(floatval(str_replace(',', "", $offer->price)) + floatval(str_replace(',', "", $offer->premium)), 2)}} {{$offer->currency}}</strong>

              @if ($offer->currency != GeoIP(Request::ip())->currency)
                <small class="price">
                  ({{ number_format($Convert->covertPrice($offer->currency, GeoIP(Request::ip())->currency ,floatval(str_replace(',', "", $offer->price)) + floatval(str_replace(',', "", $offer->premium))), 2)}} {{GeoIP(Request::ip())->currency}})
                </small>

              @endif

              <div class="modal fade" id="profile-{{$offer->provider()->first()->_id}}" tabindex="-1" role="dialog" aria-labelledby="profile-{{$offer->provider()->first()->_id}}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="profile-{{$offer->provider()->first()->_id}}Label">{{$offer->provider()->first()->name}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <dl class="">
                        <dt>Underwriter Name</dt>
                        <dd>{{$offer->provider()->first()->name}}</dd>

                        <dt>Underwriter Location</dt>
                        <dd>{{$offer->provider()->first()->city}}, {{$offer->provider()->first()->country}}</dd>

                        <dt>Underwriter Currency</dt>
                        <dd>{{$offer->provider()->first()->currency}}</dd>

                        <dt>Underwriter Portfolio Size</dt>
                        <dd>{{number_format($offer->provider()->first()->portfolio_size)}} Baskets</dd>
                      </dl>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- price-wrap.// -->

          <h6>
            <small style="float:left;">{{$offer->created_at->diffForHumans()}}</small>
            @if(!Auth::guard('provider')->check())
            <a href="{{route('buyOffer', ['id' => $offer->id])}}" class="btn btn-primary btn-sm float-right"> Buy </a>
            @elseif (Auth::guard('provider')->user()->id == $offer->provider_id)
              <a class="btn btn-danger btn-sm float-right text-white"><i class="fas fa-trash"></i></a>
            @endif
          </h6>
          </div> <!-- action-wrap -->
        </figcaption>
      </figure> <!-- card // -->
    </div> <!-- col // -->
  @endforeach
    @endif


@endsection
