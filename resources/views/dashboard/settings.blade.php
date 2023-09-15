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
                <form class="form-horizontal" method="post" action="{{ route('dashboard.updateSettings') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="form-group{{ $errors->has('site_name') ? ' has-error' : '' }}">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            
                                <label class="col-md-2 control-label pull-left text-center">@lang('site.' . $localeCode . '.site_name')</label>
                                <div class="col-md-10">
                                    <input id="site_name" type="text" name="{{ $localeCode }}[site_name]" class="form-control" value="{{ $settings->{'site_name:'.$localeCode.''} }}">
                                    <br/>
                                </div>
                            
                            <!---- end site_name--->

                        @endforeach
                        
                    </div>
                    <div class="form-group{{ $errors->has('site_email') ? ' has-error' : '' }}">
                        <label for="site_email" class="col-md-2 control-label pull-left text-center">{{ __('site.site_email') }}</label>

                        <div class="col-md-10">
                            <input id="site_email" type="email" class="form-control" name="site_email" value="{{ $settings->site_email }}" autofocus>
                            <br/>
                            
                        </div>
                    </div>
                    <!--end site email -->
                    <div class="form-group{{ $errors->has('site_phone') ? ' has-error' : '' }}">
                        <label for="site_phone" class="col-md-2 control-label pull-left text-center">{{ __('site.site_phone') }}</label>

                        <div class="col-md-10">
                            <input id="site_phone" type="text" class="form-control" name="site_phone" value="{{ $settings->site_phone }}" autofocus>
                            <br/>
                            
                        </div>
                    </div>
                    <!--end site phone -->
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        
                    
                        <div class="form-group{{ $errors->has('site_desc') ? ' has-error' : '' }}">
                            <label for="site_desc" class="col-md-2 control-label pull-left text-center">{{ __('site.'.$localeCode.'.site_desc') }}</label>

                            <div class="col-md-10">
                                <textarea name="{{ $localeCode }}[site_desc]" class="form-control" id="site_desc" rows="4">{{ $settings->{'site_desc:'.$localeCode.''} }}</textarea>
                                <br/>
                                
                            </div>
                        </div>
                        <!-- end site description-->
                        <div class="form-group {{ $errors->has('site_keywords') ? ' has-error' : '' }}">
                            <label for="site_keywords" class="col-md-2 control-label pull-left text-center">{{ __('site.'.$localeCode.'.site_keywords') }}</label>

                            <div class="col-md-10">
                                <textarea name="{{ $localeCode }}[site_keywords]" class="form-control" id="site_keywords" rows="4">{{ $settings->{'site_keywords:'.$localeCode.''} }}</textarea>
                                <br/>
                                
                            </div>
                        </div>
                        <!--end site keywords-->
                        <div class="form-group {{ $errors->has('site_about') ? ' has-error' : '' }}">
                            <label for="site_keywords" class="col-md-2 control-label pull-left text-center">{{ __('site.'.$localeCode.'.site_about') }}</label>

                            <div class="col-md-10">
                                <textarea name="{{ $localeCode }}[site_about]" class="form-control" id="site_about" rows="4">{{ $settings->{'site_about:'.$localeCode.''} }}</textarea>
                                <br/>
                                
                            </div>
                        </div>
                        <!--end site about-->
                    @endforeach
                    <div class="form-group{{ $errors->has('site_status') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label pull-left text-center">{{ __('site.site_status') }}</label>

                        <div class="col-md-10">
                            <select name="status" class="form-control">
                                <option value="1">{{ __('site.open') }}</option>
                                <option value="0">{{ __('site.close') }}</option>
                            </select>
                            <br/>
                            
                        </div>
                    </div>
                    <!-- end site status -->
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="form-group{{ $errors->has('site_close') ? ' has-error' : '' }}">
                            <label for="site_close" class="col-md-2 control-label pull-left text-center">{{ __('site.'.$localeCode.'.site_close_msg') }}</label>

                            <div class="col-md-10">
                                <textarea name="{{ $localeCode }}[site_close_msg]" id="site_close_msg" class="form-control" rows="4">{{ $settings->{'site_close_msg:'.$localeCode.''} }}</textarea>
                                <br/>
                                
                            </div>
                        </div><!--end site text close -->
                        <div class="form-group {{ $errors->has('site_copyrights') ? ' has-error' : '' }}">
                            <label for="site_copyrights" class="col-md-2 control-label pull-left text-center">{{ __('site.'.$localeCode.'.site_copyrights') }}</label>

                            <div class="col-md-10">
                                <textarea name="{{ $localeCode }}[site_copyrights]" class="form-control" id="site_copyrights" rows="4">{{ $settings->{'site_copyrights:'.$localeCode.''} }}</textarea>
                                <br/>
                                
                            </div>
                        </div>
                        <!--end site copyrights-->
                    @endforeach
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