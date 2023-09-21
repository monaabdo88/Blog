@extends('dashboard.layouts.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.users')</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="box box-primary">
            <div class="box-body">
                @include('dashboard.includes.errors')
                
                <form action="{{Route('dashboard.users.update',$user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-md-6 float-left">
                        <label>{{ __('site.first_name') }}</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}"
                           >
                    </div>
                    <div class="form-group col-md-6 float-left">
                        <label>{{ __('site.last_name') }}</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"
                           >
                    </div>
                    <div class="form-group col-md-6 float-right">
                        <label>{{ __('site.email') }}</label>
                        <input type="text" name="email" class="form-control"
                            value="{{ $user->email }}" >
                    </div>
                
                    <div class="form-group col-md-6 float-right">
                        <label>{{ __('site.phone') }}</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ $user->phone }}" >
                    </div>

                    <div class="form-group col-md-6 float-left">
                        <label>{{ __('site.password') }}</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group col-md-6 float-left">
                        <label>{{ __('site.confirm Password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group col-md-6 float-left">
                        <label>{{ __('site.status') }}</label>
                        <select name="status" id="" class="form-control">
                          
                            <option value="admin" {{ ($user->status == 'admin')? 'selected': '' }}>{{ __('site.admin') }}</option>
                            <option value="writer" {{ ($user->status == 'writer')? 'selected': '' }}>{{ __('site.writer') }}</option>
                            <option value="user" {{ ($user->status == 'user')? 'selected': '' }}>{{ __('site.user') }}</option>
                        </select>
                       
                    </div>
                    <div class="form-group col-md-6 float-right">
                        <label>{{ __('site.gender') }}</label>
                        <select name="gender" id="" class="form-control">
                          
                            <option value="male" {{ ($user->gender == 'male')? 'selected': '' }}>{{ __('site.male') }}</option>
                            <option value="female" {{ ($user->gender == 'female')? 'selected': '' }}>{{ __('site.female') }}</option>
                        </select>
                       
                    </div>
                    <div class="form-group col-md-12">
                        <label>{{ __('site.about') }}</label>
                        <textarea name="about" class="form-control" rows="4">{{ $user->about }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label>{{ __('site.image') }}</label>
                        <input type="file" name="avatar" class="form-control image">
                        <div class="form-group">
                            <img src="{{ asset('uploads/users/'.$user->avatar) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>
                    </div><!--fav icon -->
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