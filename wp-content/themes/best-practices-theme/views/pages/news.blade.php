@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
<main class="main">
    <div class="container">
        @include('views.partials.breadcrumbs')
        <div class="post-section-wrap">
            <div class="row">
                <div class="col-lg-8">
                    <div class="post-content-area">
                        <div class="post_image">
                            {{the_post_thumbnail('full')}}
                        </div>
                        <div class="post-head">
                            @if(get_field('custom_heading_for_news'))
                            <h1>{{get_field('custom_heading_for_news')}}</h1>
                            @else
                            <h1>{{the_title(null, null, false)}}</h1>
                            @endif
                            @if(get_field('hide_post_date'))
                            @else
                            <span class="date">Post Date: {{the_date()}}</span>
                            @endif
                            @if(get_field('hide_social_share'))
                            @else
                            <div class="post-share">
                                <span class="title">Share This Article</span>
                                <div class="social-networks" style="justify-content: flex-start; margin-left:-4px">
                                    <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                                </div>
                            </div>                            
                            @endif
                        </div>
                        {!!the_content()!!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news-area">                        
                        <div class="sidebar-widget">
                            @include("views.partials.recent-news")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endwhile
@endsection
