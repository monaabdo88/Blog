@extends('site.layouts.app')
@section('body')
<link href="{{ asset('site/css/app.css') }}" rel="stylesheet">

<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0 text-center">{{ __('site.register') }}</h3>
                        </div>
                    </div>


                </div>

                
                            <div class="col-md-8 offset-md-2">
                                @include('partials._errors')
                                <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
            
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name" class="col-md-4 control-label">{{ __('site.first_name') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
            
                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label for="last_name" class="col-md-4 control-label">{{ __('site.last_name') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>
            
                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">{{ __('site.email') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">{{ __('site.password') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" required>
            
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 control-label">{{ __('site.confirm Password') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">{{ __('site.phone') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>
            
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="col-md-4 control-label">{{ __('site.gender') }}</label>
            
                                        <div class="col-md-12">
                                            <select name="gender" class="form-control">
                                                <option value="Female" {{ (old('gender') == 'Female') ? 'selected':'' }}>{{__('site.female')}}</option>
                                                <option value="Male" {{ (old('gender') == 'Male') ? 'selected':'' }}>{{__('site.male')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="col-md-4 control-label">{{ __('site.about') }}</label>
            
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="about">{{old('about')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar" class="col-md-4 control-label">{{ __('site.image') }}</label>
            
                                        <div class="col-md-12">
                                            <input type="file" accept="image/*" onchange="preview_image(event)" name="avatar" class="form-control image">
                                            <br/>
            
                                            <div class="form-group">
                                                <img src="#" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                            </div>
            
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('site.register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                
                           
                        </div>

        </div>
    </div>
</div>


@endsection
@section('script')
    
    <script>
        CKEDITOR.replace( 'about' );
        function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    
@endsection