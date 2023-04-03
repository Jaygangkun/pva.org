@extends('views.layouts.main')

@section('content')
@while (have_posts()) 
    @php
    the_post();
    $member_tag_line = get_field('member_tag_line', get_the_ID());
    $member_intro_text = get_field('member_intro_text', get_the_ID());
    $member_rank = get_field('member_rank', get_the_ID());
    if(!empty($member_tag_line))
    {
        $member_tag_line = ' - ' . $member_tag_line;
    }
    $member_image = get_the_post_thumbnail_url(get_the_ID(), array(600,600));
    if(!$member_image)
    {
        $member_image = get_stylesheet_directory_uri() . '/public/images/member-default-thumbnail.jpg';
    }
    @endphp
    <div class="banner-section banner-left" style="background:#01588c;">
        <div class="image-band" style="background-image: url({{$member_image}});"></div>
        <div class="text-band primary-background" style="background:#01588c;">
            <div class="text-wrap" style="text-align:left;">
                <div class="band-col-text pull-left">
                    <div class="white">
                        <div class="band-col-text-heading">
                            <h1>{{the_title()}}{{$member_tag_line}}</h1>
                        </div>
                        <div class="band-col-text-subtitle">{{$member_rank}}</div>
                        <div class="band-col-text-summary">{{$member_intro_text}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main">
    <div class="container">
        @include('views.partials.breadcrumbs')
        <div class="post-section-wrap">
            <div class="row">
                <div class="col-lg-12">
                    <div class="post-share">
                        <span class="title">Share This Article</span>
                        <div class="social-networks" style="justify-content: flex-start; margin-left:-4px">
                            <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                        </div>
                    </div>
                    <div class="maincont">
                        {!!the_content()!!}
                    </div>
                    <p>&nbsp;</p>
                    <div class="post-share">
                        <span class="title">Share This Article</span>
                        <div class="social-networks" style="justify-content: flex-start; margin-left:-4px">
                            <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
@endwhile
@endsection