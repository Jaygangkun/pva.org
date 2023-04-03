@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
<main class="main">
    <div class="container">
        <p>&nbsp;</p>
        <div class="post-section-wrap">
            <div class="row">
                <div class="col-lg-8">
                    <div style="margin-bottom: 70px;" class="post-content-area">                        
                        <div class="post-head" style="padding-top:30px;">
                            <h1>{{the_title(null, null, false)}}</h1>
                            <span>Posted By <span style="color:#000">{{get_the_author()}}</span> on {{the_date()}}</span>
                            <hr>
                            <div class="post-share">
                                <span class="title">Share This Article</span>
                                <div class="social-networks" style="justify-content: flex-start; margin-left:-4px">
                                    <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                                </div>
                            </div>                            
                        </div>
                        <div class="post_image" style="margin: 0 0 23px;">
                            {{the_post_thumbnail('full')}}
                        </div>
                        {!!the_content()!!}
                        <div class="comments">
                            {{comments_template()}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news-area">                        
                        <div class="sidebar-widget">
                            @if(get_field('sidebar_editor','options'))
                                {!!get_field('sidebar_editor','options')!!}
                            @endif
                        </div>
                        <div class="sidebar-widget">
                            @if(get_field('show_recent_posts','options'))
                                @include('views.partials.recent-posts')
                            @endif
                        </div>
                        <div class="sidebar-widget">
                            @if(get_field('show_tags','options'))
                                @include('views.partials.tags')
                            @endif

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endwhile
@endsection
