@extends('site.layouts.app')
@section('meta_description')
        {{ strip_tags($post->content)}}
@endsection
@section('meta_keywords')
        الكلمات الدلالية
@endsection

@section('title')
{{$post->title}} - {{$setting->site_name}}
@endsection


@section('body')
 <!-- Breadcrumb Start -->
 <div class="container-fluid">
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="{{ route('index') }}">{{ __('site.home') }}</a>
            <a class="breadcrumb-item" href="{{ route('category',$post->category->parents->id) }}">{{ $post->category->parents->title }}</a>
            <a class="breadcrumb-item" href="{{ route('category',$post->category->id) }}">{{ $post->category->title }}</a>
            <span class="breadcrumb-item active">{{ $post->title }}</span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="{{asset('uploads/posts/'.$post->main_img)}}" style="object-fit: cover;">
                    <div class="overlay position-relative bg-light">
                        <div class="mb-3">
                            <a href="">{{$post->category->title}}</a>
                            <span class="px-1">/</span>
                            <span>{{$post->created_at->format('M d,Y')}}</span>
                        </div>
                        <div>
                            <h3 class="mb-3">{{$post->title}}</h3>
                            <p>{!! $post->smallDesc !!}</p>
                            <p>{!! $post->content !!}</p>
                        </div>
                    </div>
                </div>
                <!-- News Detail End -->

              

               
            </div>

          
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->


    
@endsection
