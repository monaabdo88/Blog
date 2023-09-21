<header class="header" id="site-header">
    <div class="container">
        <div class="header-content-wrapper">
            <div class="logo">
                <div class="logo-text">
                    <div class="logo-title"><a href="{{ url('/') }}"> {{ $setting->site_name }}</a></div>
                </div>
            </div>

            <nav id="primary-menu" class="primary-menu">
                <a href='javascript:void(0)' id="menu-icon-trigger" class="menu-icon-trigger showhide">
                            <span id="menu-icon-wrapper" class="menu-icon-wrapper" style="visibility: hidden">
                                <svg width="1000px" height="1000px">
                                    <path id="pathD" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                                    <path id="pathE" d="M 300 500 L 700 500"></path>
                                    <path id="pathF" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
                                </svg>
                            </span>
                </a>
                <ul class="primary-menu-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    {{--  @foreach(get_cats(4) as $cat)
                        <li>
                            <a href="{{--url('/cats/'.$cat->id)--">{{--$cat->name
                            </a>
                           {{--  @if(getSubCount($cat->id) > 0)
                                <ul class="dropdown">
                                        @foreach(get_subCat($cat->id) as $sub)
                                            <li class="hover-ver2"><a href="{{--url('/cats/'.$sub->id)--">{{--$sub->name--</a></li>
                                       {{--  @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach--}}
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{-- Auth::user()->name --}}
                                </a>

                                <ul class="dropdown">
                                    <li class="hover-ver2"><a href="{{--url('/profile/'.Auth::user()->id)--}}">Profile</a> </li>
                                    @if(Auth::user()->admin == 1)
                                        <li class="hover-ver2"><a href="{{-- url('/admin/dashboard') --}}">Dashboard</a> </li>
                                    @endif
                                    <li class="hover-ver2"><a href="{{--url('/posts/create')--}}">Add Post</a> </li>
                                    <li class="hover-ver2"><a href="{{--url('/myPosts/'.Auth::user()->id)--}}">My Posts</a> </li>
                                    <li class="hover-ver2">
                                        <a href="{{-- route('logout') --}}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                </ul>

            </nav>
            <ul class="nav-add">
                <li class="search search_main" style="color: black; margin-top: 5px;">
                    <a href="#" class="js-open-search">
                        <i class="seoicon-loupe"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
