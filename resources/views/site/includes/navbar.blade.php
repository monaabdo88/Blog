<div class="container-fluid p-0 mb-3">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
        <a href="" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{route('index')}}" class="nav-item nav-link active">{{ __('site.home') }}</a>
                @foreach ($categories as $category)
                    <div class="nav-item dropdown">
                        <a  @if (count($category->children) == 0) href="{{Route('category',$category->id)}}" @else href='#' @endif class="nav-link  @if (count($category->children) > 0) dropdown-toggle  @endif"
                            @if(count($category->children) > 0)  data-toggle="dropdown" @endif
                             >{{ $category->title }}</a>
                        @if (count($category->children) > 0)
                            <div class="dropdown-menu rounded-0 m-0">
                                @foreach ($category->children as $child)
                                    <a href="{{Route('category',$child->id)}}" class="dropdown-item">{{ $child->title }}</a>
                                @endforeach


                            </div>
                        @endif
                    </div>
                @endforeach
                
                @if (Auth::guest())
                    <a href="{{route('login')}}" class="nav-item nav-link">{{ __('site.login') }}</a>
                    <a href="{{route('register')}}" class="nav-item nav-link">{{ __('site.register') }}</a>
                @else
                <a href="{{ route('dashboard.users.edit', Auth::user()->id) }}" class="nav-item nav-link">{{ __('site.profile') }}</a>
                <a href="{{ route('dashboard.posts.create') }}" class="nav-item nav-link">{{ __('site.add_post') }}</a>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="nav-item nav-link">
                    {{ __('site.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
                
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    </a>
                    <div class="dropdown-menu rounded-0 m-0">

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach

                    </div>
                </div>        
            </div>
        </div>
    </nav>
</div>