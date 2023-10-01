<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('uploads/users/'.auth()->user()->avatar) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ active_page('') }}"><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>{{ __('site.dashboard') }}</span></a></li>
            @can('view', $setting)
                <li class="{{ active_page('settings') }}"><a href="{{ route('dashboard.settings.index') }}"><i class="fa fa-th"></i><span>{{ __('site.site_settings') }}</span></a></li>
            @endcan
            @can('view', $setting)
                <li class="{{ active_page('categories') }}"><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-th"></i><span>{{ __('site.categories') }}</span></a></li>
            @endcan
            <li class="{{ active_page('posts') }}"><a href="{{ route('dashboard.posts.index') }}"><i class="fa fa-th"></i><span>{{ __('site.posts') }}</span></a></li>
            <li class="{{ active_page('users') }}"><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>{{ __('site.users') }}</span></a></li>
            
        </ul>

    </section>

</aside>

