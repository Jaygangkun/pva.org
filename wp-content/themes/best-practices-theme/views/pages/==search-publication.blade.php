@php 
global $post;
@endphp
@extends('views.layouts.main')

@section('content')
    <main class="main">
        <div class="container">
            @include('views.partials.breadcrumbs')
            <div class="row maincont">
                <div class="col-md-8 col-sm-12">
                    @include('views.pages.search-form')
                    <section class="general-content-publications">
                        <h2>
                            Search Results For: {{str_replace("+"," ",$_GET['searchtext'])}}
                        </h2>
                        <div id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone5_zC_SmartSearchResults_srchResults_pnlSearchResults">
                        @php 
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(  
                            //'suppress_filters' => false,
                            'post_status' => 'publish',
                            'post_type' => 'publications',
                            'posts_per_page' => 5,
                            'paged'          => $paged,
                            'order'          => 'DESC',
                            's' => $_GET['searchtext']
                        );
                        $query = new WP_Query($args);
                        //dump($query->request);
                        $keywords = array_map('strtolower', array_map('trim', explode(" ", str_replace("+"," ",$_GET['searchtext']))));
                        @endphp
                        @if ( $query->have_posts() )
                            @while ( $query->have_posts() )
                                @php 
                                    $query->the_post();
                                    $match_title = false;

                                    $post_categories = get_the_terms( get_the_ID(), 'publications_categories' );
                                    foreach($keywords as $keyword)
                                    {
                                        if(empty(trim($keyword))) continue;

                                        if(strstr(strtolower(get_the_title()), $keyword) || strstr(strtolower(get_the_content()), $keyword))
                                        {
                                            $match_title = true;
                                        }

                                        /*if ( ! empty( $post_categories ) && ! is_wp_error( $post_categories ) ) {
                                            foreach ( $post_categories as $category ) {
                                                if (strtolower($category->name) == strtolower($keyword)) {
                                                    $match_title = true;
                                                }
                                            }
                                        }*/
                                    }
                                @endphp
                                <div class="article-summary-content search publication">
                                    @if( have_rows('upload_document') )
                                        @while( have_rows('upload_document') )
                                            @php
                                            the_row();
                                            $match_document_title = false;
                                            $match_document_category = false;
                                            $document_title = get_sub_field('document_title');
                                            $document = get_sub_field('document');
                                            $document_category = get_sub_field('document_category');

                                            $terms = [];
                                            if(!empty($document_category) && is_array($document_category)) foreach($document_category as $doc_cat)
                                            {
                                                $term = get_term_by( 'id', $doc_cat, 'publications_categories');

                                                if($term && intval($term->term_id) > 0)
                                                {
                                                    $terms[] = strtolower($term->name);
                                                }
                                            }

                                            foreach($keywords as $keyword)
                                            {
                                                if(empty(trim($keyword))) continue;

                                                if(strstr(strtolower($document_title), $keyword))
                                                {
                                                    $match_document_title = true;
                                                }

                                                if(in_array($keyword, $terms))
                                                {
                                                    $match_document_category = true;
                                                }

                                                /*if(strstr(strtolower($term->name), $keyword))
                                                {
                                                    $match_document_category = true;
                                                }*/
                                            }
                                            @endphp
                                            @if($match_title == true || ($match_title == false && $match_document_title == true) || $match_document_category == true)
                                                <div class="article-summary-content search publication">
                                                    <h2>
                                                        <a href="{!! $document !!}" target="_blank">
                                                            {{$document_title}}
                                                        </a>
                                                    </h2>
                                                    <a href="{!! $document !!}" target="_blank">Download PDF</a>
                                                </div>
                                            @endif
                                        @endwhile
                                    @endif
                                    {{-- @php
                                    if (!empty(get_field('upload_pdf'))) {
                                        $link = get_field('upload_pdf');
                                        $text = "Download PDF";
                                    } else {
                                        $link = get_the_permalink();
                                        $text = "View";
                                    }
                                    @endphp
                                    <h2>
                                        <a href="{!! $link !!}" target="_blank">
                                            {{the_title()}}
                                        </a>
                                    </h2>
                                    <a href="{!! $link !!}" target="_blank">{{$text}}</a> --}}
                                </div>
                            @endwhile
                            <nav class="pagination">
                                {!! pagination_bar( $query ) !!}
                            </nav>
                            {{wp_reset_postdata()}}
                        @else
                            <span id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchResults_srchResults_lblNoResults" class="ContentLabel">Sorry but we could not find what you were looking for. Please try again.</span>
                        @endif
                    </section>
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
        </div>
    </main>
{{-- <main class="main">
    <div class="container">
            @include('views.partials.breadcrumbs')
            <div class="row">
                <div class="col-lg-8">
                    @include('views.pages.search-form')
                </div>
                <div class="col-lg-4">
                    @include('views.partials.publications-sidebar')
                </div>
            </div>
    </div>
</main> --}}
@endsection
