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
                            <h3 class="m-0 text-center">{{ __('site.login') }}</h3>
                        </div>
                    </div>


                </div>

                
                            <div class="col-md-8 offset-md-2">
                                @include('partials._errors')
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
            
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-12 control-label">{{ __('site.email') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            
                                            
                                        </div>
                                    </div>
            
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">{{ __('site.password') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" required>
            
                                           
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('site.remember_me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('site.login') }}
                                            </button>
            
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('site.forget') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                
                           
                        </div>

        </div>
    </div>
</div>


@endsection
