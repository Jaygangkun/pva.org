@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
    <div class="visual-slider">
        @foreach(get_field('visual_internal_slider') as $internal_slider)
        <div class="slide">
            <div class="bg-image" style="background-image: url({{$internal_slider['visual_internal_slide_image']}});"></div>
            <div class="caption">
                <div class="container">
                    {!!$internal_slider['visual_internal_slide_content']!!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <main class="main">
        <div class="container">
            @include('views.partials.breadcrumbs')
            <div class="row maincont">
                <div class="col-md-12">
                    {!!the_content()!!}
                </div>
            </div>
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