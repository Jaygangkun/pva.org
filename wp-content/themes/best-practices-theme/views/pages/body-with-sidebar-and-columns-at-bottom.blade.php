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
            @include('views.partials.breadcrumbs')
            <div class="row maincont">
                <div class="col-md-8 col-sm-12">
                    {!!the_content()!!}
                </div>
                <div class="col-md-4 col-sm-12">
                    @if(get_field('show_sidebar_editor'))
                    <div class="sidebar-widget">
                        {!!get_field('sidebar_editor')!!}
                    </div>
                    @endif
                    @if(get_field('show_news_feed'))
                    <div class="sidebar-widget">
                        @include("views.partials.recent-news")
                    </div>
                    @endif
                    @if(get_field('show_sidebar_editor_2'))
                    <div class="sidebar-widget">
                        {!!get_field('sidebar_editor_2')!!}
                    </div>
                    @endif
                </div>
            </div>
            @if(get_field('show_full_width_section_content'))
            <div class="row maincont">
                <div class="col-md-12">
                    {!!get_field('show_full_width_section_content')!!}
                </div>
            </div>
            @endif
            
            @if(get_field('show_column_left') && get_field('show_column_center_(news_feed)') && get_field('show_column_right'))
            <div class="row maincont">
                <div class="col-md-4 col-sm-12">
                    {!!get_field('column_left')!!}
                </div>
                <div class="col-md-4 col-sm-12">
                    @include("views.partials.recent-news")
                </div>
                <div class="col-md-4 col-sm-12">
                    {!!get_field('column_right')!!}
                </div>
            </div>
            @elseif(get_field('show_column_left') && get_field('show_column_center_(news_feed)'))
            <div class="row maincont">
                <div class="col-md-6 col-sm-12">
                    {!!get_field('column_left')!!}
                </div>
                <div class="col-md-6 col-sm-12">
                    @include("views.partials.recent-news")
                </div>
            </div>

            @elseif(get_field('show_column_left') && get_field('show_column_right'))
            <div class="row maincont">
                <div class="col-md-6 col-sm-12">
                    {!!get_field('column_left')!!}
                </div>
                <div class="col-md-6 col-sm-12">
                    {!!get_field('column_right')!!}                    
                </div>
            </div>
            @elseif(get_field('show_column_center_(news_feed)') && get_field('show_column_right'))
            <div class="row maincont">
                <div class="col-md-6 col-sm-12">
                    @include("views.partials.recent-news")
                </div>
                <div class="col-md-6 col-sm-12">
                    {!!get_field('column_right')!!}
                </div>
            </div>
            @elseif(get_field('show_column_left') || get_field('show_column_center_(news_feed)') || get_field('show_column_right'))
            <div class="row maincont">
                @if(get_field('show_column_left'))
                <div class="col-sm-12">
                    {!!get_field('column_left')!!}
                </div>
                @elseif(get_field('show_column_center_(news_feed)'))
                <div class="col-md-6 col-sm-12">
                    @include("views.partials.recent-news")
                </div>
                @elseif(get_field('show_column_right'))
                <div class="col-sm-12">
                    {!!get_field('column_right')!!}
                </div>
                @endif
            </div>
            @endif
        </div>
    </main>
@endwhile
@endsection