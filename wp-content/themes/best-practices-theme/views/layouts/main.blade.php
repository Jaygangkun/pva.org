<!DOCTYPE html>
<html>
    <head>
        @section('head')
            <meta charset="{{bloginfo( 'charset' )}}">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
            <link rel="profile" href="http://gmpg.org/xfn/11">

            {!! wp_head() !!}
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Source+Sans+Pro:wght@200;300;400;600;700&family=Titillium+Web:wght@200;300;400;700;900&display=swap" rel="stylesheet">
            <script src="https://kit.fontawesome.com/74d2999c27.js" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="{{public_path('bundle.css')}}">
            <link rel="stylesheet" href="{{mix('main.css')}}">
        @show
    </head>

    <body {{body_class()}}>
        <div class="wrapper">
            @section('header')
                @include('views.partials.header')
            @show

            @yield('pre-content')

            @section('the-loop')
                @if (have_posts())
                    @yield('content')
                @else
                    @yield('no-content')
                @endif
            @show

            @yield('post-content')

            @section('footer')
                @include('views.partials.footer')
            @show

            @section('scripts')
                <script src="{{public_path('bundle.js')}}"></script>
                <script src="{{mix('main.js')}}"></script>
                <script src="{{public_path('jquery.cookie.js')}}"></script>
                <script>
                    $(document).ready(function(){ 
                         $("#closepopup").click(function() { 
                              $("#black").fadeOut("slow");
                              $.cookie('show_home_popup', 1, { expires: 1, path: '/' });
                            });
                         });

                </script>
                <?php wp_footer(); ?>
            @show
        </div>
                  <?php 
                  $post = get_post();
		//echo $post->ID;
                  if($post->ID == 8689 && get_field('just_plane_wrong_popup','options'))
                  {
                    ?>
                    <style>
                    /* Leaving modal styles here so they can be easily modified, and there's no loading flash while loading the CSS. */
                    #black { height: 100%; background: #000000c2; position: fixed; top: 0; width: 100%; z-index: 999999; display: none; }
                    #modalImage{width: 700px !important;height:466px !important;}
                    #mobileImage{width: 400px !important;height:644px !important;}
                    </style>
                    <div id="black">
                    <div id="modalHome" title="Donate Now.">
                    <div id="closeIcon">
                    <a href="javascript:void(0);" id="closepopup"><img id="closeIconPic" src="{{public_path('images/close-icon2.png')}}"></a>
                    </div>
                    <a href="{{get_field('just_plane_wrong_popup_link','options')}}" target="_blank">
                       <img id="modalImage" src="{{get_field('just_plane_wrong_desktop_popup','options')['url']}}">
                    </a>
                    <a href="{{get_field('just_plane_wrong_popup_link','options')}}" target="_blank">
                       <img id="mobileImage" src="{{get_field('just_plane_wrong_mobile_popup','options')['url']}}">
                    </a>

                    </div>  
                    </div>
                  <script>
                    function getCookie (name) {
                        let value = `; ${document.cookie}`;
                        let parts = value.split(`; ${name}=`);
                        if (parts.length === 2) return parts.pop().split(';').shift();
                    }
                    // Only show modal if the cookie doesn't exist.
                    if(getCookie('show_home_popup') != 1) {
                        var modal = document.getElementById("black");
                        // Delay modal for SEO purposes.
                        setTimeout(function() {
                            modal.style.display = "block";
                        }, 3000);
                    }
                </script>
                    <?php
                  }
                  elseif ($post->ID != 8689 && get_field('show_home_popup','options'))
                  {
                  ?>
                    <style>
                    /* Leaving modal styles here so they can be easily modified, and there's no loading flash while loading the CSS. */
                    #black { height: 100%; background: #000000c2; position: fixed; top: 0; width: 100%; z-index: 999999; display: none; }
                    #modalImage{width: 700px !important;height:466px !important;}
                    #mobileImage{width: 400px !important;height:644px !important;}
                    </style>
                     <div id="black">
                    <div id="modalHome" title="Donate Now.">
                    <div id="closeIcon">
                    <a href="javascript:void(0);" id="closepopup"><img id="closeIconPic" src="{{public_path('images/close-icon2.png')}}"></a>
                    </div>
    				<a href="{{get_field('home_popup_link','options')}}" target="_blank">
                      <img id="modalImage" src="{{get_field('home_popup_desktop_image','options')['url']}}">
    				</a>
    				<a href="{{get_field('home_popup_link','options')}}" target="_blank">
                      <img id="mobileImage" src="{{get_field('home_popup_mobile_image','options')['url']}}">
    				</a>
                   </div>
                  </div>
                  <script>
                    function getCookie (name) {
                        let value = `; ${document.cookie}`;
                        let parts = value.split(`; ${name}=`);
                        if (parts.length === 2) return parts.pop().split(';').shift();
                    }
                    // Only show modal if the cookie doesn't exist.
                    if(getCookie('show_home_popup') != 1) {
                        var modal = document.getElementById("black");
                        // Delay modal for SEO purposes.
                        setTimeout(function() {
                            modal.style.display = "block";
                        }, 3000);
                    }
                </script>
                <?php
                 }
                ?>
    </body>

</html>