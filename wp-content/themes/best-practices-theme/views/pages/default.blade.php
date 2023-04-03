@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
	@if(has_post_thumbnail())
		<div class="container post-thumb">
			{{the_post_thumbnail('full') }}
		</div>
	@else
	@if(get_field('full_image_header'))
	<div class="banner-section banner-full-bg @if(get_field('mobile_header_image')['url']) no-bg-mobile @endif" style="background-image: url({{get_field('full_image_header_image')['url']}});">
		<img src="{{get_field('mobile_header_image')['url']}}" class="formobile">
		<div class="container">
			<div class="text-holder" style="text-align:{{strtolower(get_field('full_header_content_alignment'))}}">
				{!! get_field('full_header_content') !!}
			</div>
		</div>
	</div>
	@endif
	@if(get_field('two_block_header'))	
	<div class="banner-section banner-{{strtolower(get_field('two_block_header_image_aignment'))}}" style="padding-top:0px !important">
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
	@endif
    <main class="main">
		<div class="container">
			@include('views.partials.breadcrumbs')
		    {!!the_content()!!}
		    <p>&nbsp;</p>
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
