@extends('views.layouts.main')

@section('content')
    <main class="main">
        <div class="container">
            @include('views.partials.breadcrumbs')

            <div class="row">
                <div class="col-md-8 inner-right-sm">
                    <section>
                        @php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array (
                        'post_type'      => 'news',
                        'posts_per_page' => 15,
                        'paged'          => $paged,
                        'order'          => 'DESC',
                        'tax_query'      => array (
                        array (
                        'taxonomy' => 'news_category',
                        'field'    => 'id',
                        'terms'    => 7,
                        ),
                        ),
                        );
                        $postsList = new WP_Query($args);
                        @endphp
                        @if ( $postsList->have_posts() )
                            @while ( $postsList->have_posts() )
                                @php $postsList->the_post(); @endphp

                                <section class="list-summary">
                                    <div class="list-summary-img icon-overlay icn-link">
                                        @if (has_post_thumbnail())
                                            <a href="{{the_permalink()}}">
                                                <span class="icn-more"></span>
                                                <img src="{{the_post_thumbnail_url()}}" title="" alt="{{the_title()}}">
                                            </a>
                                        @endif
                                    </div>
                                    <div class=" list-summary-content">
                                        <div class="list-summary-heading">
                                            <h2>
                                                <a href="{{the_permalink()}}">
                                                    {{the_title()}}
                                                </a>
                                            </h2>
                                            <div class="list-summary-date"><span class="list-summary-date-label">Post Date:</span>{{ get_the_date( 'F j, Y' )}}</div>
                                        </div>
                                        @php echo the_excerpt() @endphp
                                        <div class="article-btn">
                                            <a href="{{the_permalink()}}" class="btn btn-medium">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </section>
                            @endwhile
                            <nav class="pagination">
                                @php pagination_bar( $postsList ); @endphp
                            </nav>
                            @php
                            wp_reset_postdata();
                            @endphp
                        @endif
                    </section>
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
    </main>
@endsection