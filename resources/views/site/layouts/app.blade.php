<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> @yield('title' , $setting->translate(app()->getlocale())->site_name)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name ="description", content="@yield('meta_description',  $setting->site_desc)">
    <meta name ="keywords", content="@yield('meta_keywords',  $setting->site_keywords )">
    <!-- Favicon -->
    <link href="{{ asset($setting->favicon) }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
            <div class="col-12 col-md-8">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-white text-center py-2" style="width: 100px;">Tranding</div>
                    <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 100px); padding-left: 90px;">
                        @foreach ($lastFivePosts as $post)
                            <div class="text-truncate"><a class="text-secondary" href="{{Route('post',$post->id)}}">{{ $post->title }}</a></div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right d-none d-md-block">
                {{ Date('D Y,M,d') }}
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="{{route('index')}}" class="navbar-brand d-none d-lg-block">
                    <img src="{{ asset($setting->logo) }}" alt="">
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <img class="img-fluid" src="{{ asset($setting->logo) }}" alt="">
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('site.includes.navbar')
    <!-- Navbar End -->

    @yield('body')
    @include('site.includes.footer')
    <!-- Back to Top -->
    <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('front') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('front') }}/mail/jqBootstrapValidation.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('front') }}/js/main.js"></script>
    {{--preview image js--}}
    <script src="{{ asset('dashboard/js/custom/image_preview.js') }}"></script>

</body>

</html>
