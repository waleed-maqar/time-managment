@include('layouts.header')
@auth
    <span class="position-fixed mr-1 btn sidebar-toggle element-toggle" data-element=".site-sidebar">
        <i class="fa-solid fa-bars fa-2x"></i>
    </span>
@endauth
<div class="main-site-container">
    @auth
        <aside class="mt-5 site-sidebar">
            @include('layouts.sidebar')
        </aside>
    @endauth
    <div class="site-content">
        @yield('content')
    </div>
</div>
@include('layouts.footer')
