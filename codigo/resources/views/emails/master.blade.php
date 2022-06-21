<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body style="margin: 0px; padding: 0px; background-color: #f3f3f3;">
    <div style="
        display: block;
        max-width: 728px;
        margin: 0px auto;
        width: 60%;
    ">
    <img src="{{url('/static/imagenes/banner-emails1.png')}}" style="width: 100%; display: block;">
    
    <div style="
        background-color: #fff;
        padding: 24px;
    ">
        @yield('content')

        <hr>

        <div style="margin-top: 16px;">
            <p> <strong>Encuentranos en nuestras redes sociales:</strong> </p>
            @if( config('cms.social_facebook') != "" )
                <a href="{{ config('cms.social_facebook') }}" target="_blank" style="display: inline-block; margin-right: 6px;"> 
                    <img src="{{ url('/static/imagenes/facebook.png') }}" style="width: 36px; border-radius: 8px;"> 
                </a>
            @endif

            @if( config('cms.social_instagram') != "" )
                <a href="{{ config('cms.social_instagram') }}" target="_blank" style="display: inline-block; margin-right: 6px;"> 
                    <img src="{{ url('/static/imagenes/instagram.png') }}" style="width: 36px; border-radius: 8px;"> 
                </a>
            @endif

            @if( config('cms.social_whatsapp') != "" )
                <a href="{{ config('cms.social_whatsapp') }}" target="_blank" style="display: inline-block; margin-right: 6px;"> 
                    <img src="{{ url('/static/imagenes/whatsapp.png') }}" style="width: 36px; border-radius: 8px;"> 
                </a>
            @endif

            @if( config('cms.social_twitter') != "" )
                <a href="{{ config('cms.social_twitter') }}" target="_blank" style="display: inline-block; margin-right: 6px;"> 
                    <img src="{{ url('/static/imagenes/twitter.png') }}" style="width: 36px; border-radius: 8px;"> 
                </a>
            @endif

            @if( config('cms.social_youtube') != "" )
                <a href="{{ config('cms.social_youtube') }}" target="_blank" style="display: inline-block; margin-right: 6px;"> 
                    <img src="{{ url('/static/imagenes/youtube.png') }}" style="width: 36px; border-radius: 8px;"> 
                </a>
            @endif
        </div>
    </div>

    </div>
</body>
</html>