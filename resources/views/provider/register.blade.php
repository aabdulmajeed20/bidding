@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('underwriter.postRegister') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Orgniazation Name') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" value="{{ GeoIP(Request::ip())->country }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ GeoIP(Request::ip())->city }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iban" class="col-md-4 col-form-label text-md-right">{{ __('IBAN') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="iban" type="text" class="form-control" name="iban" placeholder="International Bank Account Number" required>
                            </div>
                        </div>

                        @php
                        $path = base_path() . "/resources/json/currencies.json";

                        $json = json_decode(file_get_contents($path), true);

                        @endphp

                          <div class="form-group row">
                              <label for="currency" class="col-md-4 col-form-label text-md-right">Preffered Currency <font color="red">*</font></label>

                              <div class="col-md-6">

                                <select class="form-control" name="currency" id="currency" required>


                                  @foreach ($json as $currency)

                                    @if ($currency['cc'] == GeoIP(Request::ip())->currency)
                                      <option value="{{$currency['cc']}}" selected>{{ $currency['name'] }}</option>

                                    @else
                                      <option value="{{$currency['cc']}}">{{ $currency['name'] }}</option>
                                    @endif

                                  @endforeach
                                </select>
                              </div>
                          </div>
                        <div class="form-group row">
                            <label for="cover" class="col-md-4 col-form-label text-md-right">Cover Type <font color="red">*</font></label>

                            <div class="col-md-6">
                              <select class="form-control" name="cover" id="cover" required>
                                <option selected disabled>-- Please Select --</option>
                                <option value="c">Cash Equivalent</option>
                                <option value="g">Physical Grain</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row Portfolio hide">
                            <label for="portfolio" class="col-md-4 col-form-label text-md-right">{{ __('Portfolio Size') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="portfolio" type="text" placeholder="Baskets Amount" class="form-control" name="portfolio" value="none" required>
                            </div>
                        </div>

                        <div class="form-group row Escrow hide">
                            <label for="escrow" class="col-md-4 col-form-label text-md-right">{{ __('Escrow Account') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="escrow" type="text" class="form-control" name="escrow" value="none" required >
                            </div>
                        </div>


                        <hr />

                        <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <font color="red">*</font></label>
                          <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                              @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} <font color="red">*</font></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#cover').on('change', function(){
      if($(this).children("option:selected").val() == 'g'){
        $('.Portfolio').removeClass('hide');
        $('#portfolio').val('');
      }else{
        $('.Portfolio').addClass('hide');
        $('#portfolio').val('none');
      }

      if($(this).children("option:selected").val() == 'c'){
        $('.Escrow').removeClass('hide');
        $('#escrow').val('');
      }else{
        $('.Escrow').addClass('hide');
        $('#escrow').val('none');
      }
    });
  });
</script>
@endsection
