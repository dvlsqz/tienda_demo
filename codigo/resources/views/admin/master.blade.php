<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Config::get('cms.name') }} - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/static/css/admin.css?v='.time() )}}">
    <link rel="stylesheet" href="{{url('/static/css/mdalert.css' )}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <script src="https://kit.fontawesome.com/6f5a4bc953.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JavaScript and dependencies -->
    
    <script src="{{ url('static/libs/ckeditor/ckeditor.js?v='.time() )}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!--  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
    <script src="{{ url('static/js/admin.js?v='.time()) }}"></script>
    <script src="{{ url('static/js/mdalert.js') }}"></script>
        

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltrip"]').tooltrip()
        });
    </script>
</head>
<body>

    <div class="mdalert" id="md_alert_dom">
        <div class="md_alert_inside" id="md_alert_inside">
            <div class="md_alert_content" id="md_alert_content"> </div>
            <div class="md_alert_footer" id="md_alert_footer">
                <div class="md_alert_footer_other_btns" id="md_alert_footer_other_btns"> </div>
                <a href="#" class="md_alert_btn_close" id="md_alert_btn_close">Cerrar</a>
            </div>
        </div>
    </div>

    <div class="wrapper">

        <div class="col1">
            @include('admin.sidebar')
        </div>

        <div class="col2">

            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="page">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            </li>
                            @section('breadcrumb')
                            @show
                        </ul>
                    </nav>
                </div>
            </div>

            @if(Session::has('messages'))
                <div class="container">
                    <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:block; margin-bottom: 16px;">
                        {{ Session::get('messages') }}

                        @if( $errors->any() )
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <script>
                            $('.alert').slideDown();
                            setTimeout(function(){ $('.alert').slideUp(); },10000);
                        </script>
                    </div>
                </div>
            @endif

            @section('content')
            @show

        </div>

        
        

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>