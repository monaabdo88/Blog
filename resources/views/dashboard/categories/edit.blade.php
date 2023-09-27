@extends('dashboard.layouts.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.categories')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.categories')</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                @include('dashboard.includes.errors')
                
                <form action="{{Route('dashboard.categories.update',$category)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
                    <div class="col-md-12 form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                        <label for="name">{{ __('site.category') }}</label>
                        <select name="parent_id" class="form-control">
                            <option value="0" {{ ($category->parent_id == 0) ? 'selected' : '' }}>{{ __('site.main_category') }}</option>
                            @foreach ($categories as $item)
                                @if ($item->id != $category->id)
                                    <option value="{{$item->id}}" {{ ($category->parent_id == $item->id) ? 'selected' : '' }}>{{$item->title}}</option>
                                @endif
                            @endforeach
                        </select>
                           
                    </div><!-- end site status -->
                    <div class="col-md-12 form-group {{ $errors->has('site_status') ? ' has-error' : '' }}">
                        <label for="name">{{ __('site.status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ ($category->status == 1) ? 'selected' : '' }}>{{ __('site.active') }}</option>
                            <option value="0" {{ ($category->status == 0) ? 'selected' : '' }}>{{ __('site.not_active') }}</option>
                        </select>
                           
                    </div><!-- end site status -->
                    <div class="form-group col-md-12">
                        <label>{{ __('site.image') }}</label>
                        <input type="file" name="thumbnail" class="form-control logo-img">
                        <div class="form-group">
                            <img src="{{ asset('uploads/categories/'.$category->thumbnail) }}" style="width: 100px" class="img-thumbnail logo-preview" alt="">
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
                                            placeholder="{{ __('site.title') }}" value="{{$category->translate($key)->title}}">
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label>{{ __('site.description') }} - {{ $lang }}</label>
                                        <textarea name="{{$key}}[description]" class="form-control" rows="4">{{$category->translate($key)->description}}</textarea>
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