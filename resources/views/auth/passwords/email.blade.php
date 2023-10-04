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
                            <h3 class="m-0 text-center">{{ __('site.reset_password') }}</h3>
                        </div>
                    </div>


                </div>

                
                            <div class="col-md-8 offset-md-2">
                                @include('partials._errors')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('site.send_password') }}
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
