@extends('dashboard.layouts.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.site_settings')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.site_settings')</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                @include('dashboard.includes.errors')
                
                <form action="{{Route('dashboard.settings.update' , $setting)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="col-md-6 pull-left form-group{{ $errors->has('site_mail') ? ' has-error' : '' }}">
                        <label>{{ __('site.site_email') }}</label>
                        <input id="site_mail" type="email" class="form-control" name="site_mail" value="{{ $setting->site_mail }}" autofocus>
                    </div>
                    <!--end site email -->

                    <div class="col-md-6 pull-right form-group{{ $errors->has('site_phone') ? ' has-error' : '' }}">
                        <label>{{ __('site.site_phone') }}</label>
                        <input id="site_phone" type="text" class="form-control" name="site_phone" value="{{ $setting->site_phone }}" autofocus>
                    </div><!-- end site phone -->

                    <div class="col-md-6 pull-left form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                        <label>{{ __('site.facebook') }}</label>
                        <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}" autofocus>
                    </div><!-- end site facebook -->
                    <div class="col-md-6 pull-right form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                        <label>{{ __('site.twitter') }}</label>
                        <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $setting->twitter }}" autofocus>
                    </div><!-- end site twitter -->
                    <div class="form-group col-md-6 pull-right">
                        <label>{{ __('site.logo') }}</label>
                        <input type="file" name="logo" class="form-control logo-img">
                        <div class="form-group">
                            <img src="{{ asset($setting->logo) }}" style="width: 100px" class="img-thumbnail logo-preview" alt="">
                        </div>
                    </div><!-- logo -->
                    <div class="form-group col-md-6 pull-left">
                        <label>{{ __('site.favicon') }}</label>
                        <input type="file" name="favicon" class="form-control image">
                        <div class="form-group">
                            <img src="{{ asset($setting->favicon) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>
                    </div><!--fav icon -->
                    <div class="col-md-12 form-group {{ $errors->has('site_status') ? ' has-error' : '' }}">
                        <label for="name">{{ __('site.site_status') }}</label>
                        <select name="site_status" class="form-control">
                            <option value="1" {{ ($setting->site_status == 1)? 'selected' : '' }}>{{ __('site.open') }}</option>
                            <option value="0" {{ ($setting->site_status == 0)? 'selected' : '' }}>{{ __('site.close') }}</option>
                        </select>
                           
                    </div><!-- end site status -->

                    
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @foreach (config('app.languages') as $key => $lang)
                                <li class="@if ($loop->index == 0) active @endif">
                                    <a  data-toggle="tab" href="#{{ $key }}" role="tab"
                                        aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                </li>
                            @endforeach          
                        </ul>
                        <div class="tab-content">
                            @foreach (config('app.languages') as $key => $lang)
                                <div class="tab-pane fade @if ($loop->index == 0) active in @endif"
                                    id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="form-group mt-3 col-md-12">
                                        <label>{{ __('site.site_name') }} - {{ $lang }}</label>
                                        <input type="text" name="{{$key}}[site_name]" class="form-control"
                                            placeholder="{{ __('site.site_name') }}"   value="{{$setting->translate($key)->site_name}}">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.site_desc') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[site_desc]" class="form-control" rows="4">{{$setting->translate($key)->site_desc}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.site_keywords') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[site_keywords]" class="form-control" rows="4">{{$setting->translate($key)->site_keywords}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.site_copyrights') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[site_copyrights]" class="form-control" rows="4">{{$setting->translate($key)->site_copyrights}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.site_about') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[site_about]" class="form-control" rows="4">{{$setting->translate($key)->site_about}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.site_close_msg') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[site_close_msg]" class="form-control" rows="4">{{$setting->translate($key)->site_close_msg}}</textarea>
                                    </div>
                                </div><!--end tab -->
                            @endforeach
                        </div>
                        
                        </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('site.update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection