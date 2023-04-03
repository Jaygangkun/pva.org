@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
    @if(get_field('full_image_header'))
    <div class="banner-section banner-full-bg" style="background-image: url({{get_field('full_image_header_image')['url']}});">
        <div class="container">
            <div class="text-holder" style="text-align:{{strtolower(get_field('full_header_content_alignment'))}}">
                {!! get_field('full_header_content') !!}
            </div>
        </div>
    </div>
    @endif
    @if(get_field('two_block_header'))  
    <div class="banner-section banner-{{strtolower(get_field('two_block_header_image_aignment'))}}">
        @if(strtolower(get_field('two_block_header_image_aignment')) == 'left')
        <div class="image-band" style="background-image: url({{get_field('two_block_header_image')['url']}});"></div>
        <div class="text-band primary-background" style="background:{{get_field('two_block_header_background')}}">
            <div class="text-wrap" style="text-align:{{strtolower(get_field('two_block_header_content_alignment'))}}">
                {!! get_field('two_block_header_content') !!}
            </div>
        </div>
        @else
        <div class="text-band primary-background" style="background:{{get_field('two_block_header_background')}}">
            <div class="text-wrap" style="text-align:{{strtolower(get_field('two_block_header_content_alignment'))}}">
                {!! get_field('two_block_header_content') !!}
            </div>
        </div>
        <div class="image-band" style="background-image: url({{get_field('two_block_header_image')['url']}});"></div>
        @endif
    </div>
    @endif
    <main class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{get_home_url()}}">Home</a></li>
            <li><a href="/about-us/our-members/">HERO STORIES</a></li>
            <li>{{the_title()}}</li>                       
        </ul> 
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