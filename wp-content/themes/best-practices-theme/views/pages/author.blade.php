@php 
global $wp_query;
@endphp
@extends('views.layouts.main')

@section('content')
<main class="main">
    <div class="container">
        <p>&nbsp;</p>
        <h1>Paralyzed Veterans of America Blog</h1>
        <p>&nbsp;</p>
        <div class="">
            <div class="row">
                <div class="col-lg-8">                     
                    @if ( have_posts() )
                        <!-- the loop -->
                        @while (have_posts())
                            @php
                            the_post()
                            @endphp

                        <div class="blog-post">                        
                        <div class="post-listing">
                            <div class="post-item">
                                <div class="post-header">
                                    <h2><a href="{{the_permalink()}}">{{the_title()}}</a></h2>
                                    <div>Posted by <a class="author-link" href="{{home_url('/author')}}/{{get_the_author_meta('user_login')}}/">{{get_the_author()}}</a> on {{get_the_date( 'l F j, Y' )}}</div>

<!--Dec 29, 2020 10:00:00 AM--> 

                                </div>

                                
                                <div class="post-body clearfix">
                                    <!--post summary-->
                                    @if(has_post_thumbnail())
                                        <div class="hs-featured-image-wrapper">
                                            <a href="{{the_permalink()}}" title="" class="hs-featured-image-link">
                                                {{the_post_thumbnail()}}
                                            </a>
                                        </div>
                                     @endif
                                </div>
                                <a class="more-link" href="{{the_permalink()}}">Read More</a>
                                <div class="custom_listing_comments">
                                    {!! comments_number( '0', '1', '%' ) !!} Comments <a href="{{the_permalink()}}">Click here to read/write comments</a>
                                </div>
                            </div>
                        </div>
                        </div>    
                        @endwhile
                        <!-- end of the loop -->
                     
                        <nav class="pagination">
                        {!! pagination_bar( $wp_query ) !!}
                        </nav>                     
                    @else
                        <p>{{_e( 'Sorry, no posts matched your criteria.' )}}</p>
                    @endif
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
@endsection