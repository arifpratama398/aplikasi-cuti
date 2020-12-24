<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@include('partials.topbar')
@include('partials.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @yield('header')    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('message'))
                    <div class="callout {{ Session::get('alert-class', 'alert-info') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="this.parentElement.remove()">×</button>                            
                        {{ Session::get('message') }}
                        @if(Session::has('content_no')) Data dengan no: {{ Session::get('content_no') }} @endif
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>        
    </section>
</div>    
</div>
@include('partials.javascripts')
</body>
</html>
