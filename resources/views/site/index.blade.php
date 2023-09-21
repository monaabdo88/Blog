@extends('site.layouts.app')
@section('content')
    <br/><br/><br/>
    <div class="container up-container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <article class="hentry post post-standard has-post-thumbnail sticky">

                    <div class="post-thumb">
                        <img src="{{--asset('uploads/'.first_post()->featured)--}}" alt="{{--first_post()->name--}}" style="height: 388px">
                        <div class="overlay"></div>
                        <a href="{{--asset('uploads/'.first_post()->featured)--}}" class="link-image js-zoom-image">
                            <i class="seoicon-zoom"></i>
                        </a>
                        <a href="{{--url('/post/'.first_post()->slug)--}}" class="link-post">
                            <i class="seoicon-link-bold"></i>
                        </a>
                    </div>

                    <div class="post__content">

                        <div class="post__content-info">

                            <h2 class="post__title entry-title ">
                                <a href="{{--url('/post/'.first_post()->slug)--}}">{{--first_post()->title--}}</a>
                            </h2>

                            <div class="post-additional-info">

                                        <span class="post__date">

                                            <i class="seoicon-clock"></i>

                                            <time class="published" datetime="2016-04-17 12:00:00">
                                               {{--first_post()->created_at->diffForHumans()--}}
                                            </time>

                                        </span>

                                <span class="category">
                                            <i class="seoicon-tags"></i>
                                            <a href="{{--url('/cats/'.first_post()->category->id)--}}">{{--first_post()->category->name--}}</a>
                                        </span>

                                <span class="post__comments">
                                            <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                                            6
                                        </span>

                            </div>
                        </div>
                    </div>

                </article>
            </div>
            <div class="col-lg-2"></div>
        </div>

        <div class="row">
            {{-- @foreach(get_posts_index() as $post) --}}
                <div class="col-lg-6">
                    <article class="hentry post post-standard has-post-thumbnail sticky">

                        <div class="post-thumb">
                            <img src="{{--asset('uploads/'.$post->featured)--}}" alt="{{--$post->title--}}" style="height: 310px">
                            <div class="overlay"></div>
                            <a href="{{--asset('uploads/'.$post->featured)--}}" class="link-image js-zoom-image">
                                <i class="seoicon-zoom"></i>
                            </a>
                            <a href="{{--url('/post/'.$post->slug)--}}" class="link-post">
                                <i class="seoicon-link-bold"></i>
                            </a>
                        </div>

                        <div class="post__content">

                            <div class="post__content-info">

                                <h2 class="post__title entry-title ">
                                    <a href="{{--url('/post/'.$post->slug)--}}">{{--$post->title--}}</a>
                                </h2>

                                <div class="post-additional-info">

                                        <span class="post__date">

                                            <i class="seoicon-clock"></i>

                                            <time class="published" datetime="2016-04-17 12:00:00">
                                                {{--$post->created_at->diffForHumans()--}}
                                            </time>

                                        </span>

                                    <span class="category">
                                            <i class="seoicon-tags"></i>
                                            <a href="{{--url('/cats/'.$post->category->id)--}}">{{--$post->category->name--}}</a>
                                        </span>

                                    <span class="post__comments">
                                            <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                                            6
                                        </span>

                                </div>
                            </div>
                        </div>

                    </article>
                </div>

                {{-- @endforeach --}}

        </div>
    </div>


    <div class="container-fluid">
        <div class="row medium-padding120 bg-border-color">
            <div class="container">
                {{-- @foreach(get_cats(3) as $cat) --}}
                    <div class="col-lg-12">
                        <div class="offers">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                    <div class="heading">
                                        <h4 class="h1 heading-title">{{--$cat->name--}}</h4>
                                        <div class="heading-line">
                                            <span class="short-line"></span>
                                            <span class="long-line"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="case-item-wrap">
                                    {{-- @foreach($cat->posts()->where('status',1)->take(3)->get() as $post) --}}
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="case-item">
                                                <div class="case-item__thumb">
                                                    <img src="{{--asset('uploads/'.$post->featured)--}}" alt="{{--$post->title--}}" style="height: 250px">
                                                </div>
                                                <h6 class="case-item__title"><a href="{{--url('/post/'.$post->slug)--}}">{{--$post->title--}}</a></h6>
                                            </div>
                                        </div>
                                        {{-- @endforeach --}}
                                  </div>
                            </div>
                        </div>
                        <div class="padded-50"></div>

                    </div>
                {{-- @endforeach --}}

            </div>
        </div>
    </div>

    <!-- Subscribe Form -->
@endsection

