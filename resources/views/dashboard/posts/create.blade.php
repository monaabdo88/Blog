@extends('dashboard.layouts.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.posts')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.posts')</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                @include('dashboard.includes.errors')
                
                <form action="{{Route('dashboard.posts.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    
                    <div class="col-md-12 form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="name">{{ __('site.category') }}</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                           
                    </div><!-- end category -->
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
                    <div class="col-md-12 form-group {{ $errors->has('site_status') ? ' has-error' : '' }}">
                        <label for="name">{{ __('site.status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1">{{ __('site.active') }}</option>
                            <option value="0">{{ __('site.not_active') }}</option>
                        </select>
                           
                    </div><!-- end site status -->
                    <div class="form-group col-md-12">
                        <label>{{ __('site.image') }}</label>
                        <input type="file" name="main_img" class="form-control logo-img">
                        <div class="form-group">
                            <img src="#" style="width: 100px" class="img-main_img logo-preview" alt="">
                        </div>
                    </div><!-- logo -->
                    
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
                                        <label>{{ __('site.title') }} - {{ $lang }}</label>
                                        <input type="text" name="{{$key}}[title]" class="form-control"
                                            placeholder="{{ __('site.title') }}"   value="">
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.about') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[small_desc]" id="editor" rows="8" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.content') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[content]" id="editor" rows="8" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.tags') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[tags]" id="editor" rows="8" class="form-control"></textarea>
                                    </div>
                                </div><!--end tab -->
                            @endforeach
                        </div>
                        
                        </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('site.create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection