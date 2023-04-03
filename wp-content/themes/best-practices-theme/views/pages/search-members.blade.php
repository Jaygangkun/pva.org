@php 
global $post;
@endphp
@extends('views.layouts.main')

@section('content')
<main class="main"> @include('views.partials.header-search-member')
    <div class="container"> @include('views.partials.breadcrumbs') </div>
    <section>
        <div class="container">
            <div class="row inner-bottom-xs">
                <div class="col-md-12 search-results">
                    <div class="navbar-form search results">
                        <form role="search" action="{{get_permalink($post->ID)}}" method="get" id="searchform">
                            <div id="" class="searchBox">
                                <label for="" id="" style="display:none;">Search for:</label>
                                <input name="searchtext" type="text" maxlength="1000" id="" class="form-control" value="{{$_GET['searchtext']}}">
                                <input type="submit" name="" value=">" id="" class="btn btn-default btn-submit icon-right-open">
                                <div id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchBox_pnlPredictiveResultsHolder" class="predictiveSearchHolder"></div>
                            </div>
                        </form>
                    </div>
                    <div id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchResults_srchResults_pnlSearchResults">
                    @php 
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(  
                        'post_status' => 'publish',
                        'post_type' => 'member',
                        'posts_per_page' => 5,
                        'paged'          => $paged,
                        'order'          => 'DESC',
                        's' => $_GET['searchtext']
                    );
                    $query = new WP_Query($args);
                    @endphp
                        @if ( $query->have_posts() )
                            @while ( $query->have_posts() )
                                @php 
                                    $query->the_post();
                                    $member_url = get_the_permalink();
                                    $story_page_url = get_field('story_page_url', get_the_ID());
                                    if($story_page_url && !empty($story_page_url))
                                    {
                                        $member_url = $story_page_url;
                                    }
                                @endphp
                                <div class="article-summary-content search" {{the_ID()}}>
                                    <div class="search-listing-image">
                                        <a href="{{$member_url}}" title="{{the_title()}}">
                                            @if ( has_post_thumbnail())
                                                @php
                                                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID());
                                                @endphp 
                                                <img class="img-responsive" src="{{$featured_img_url}}" alt="" title="">
                                            @else
                                                <img class="img-responsive" src="{{get_stylesheet_directory_uri()}}/public/images/member-default-thumbnail.jpg" alt="" title="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="search-listing-content">
                                        <h2><a href="{{$member_url}}">{{the_title()}}</a></h2>
                                        <p>
                                        @php
                                            $member_intro_text = get_field('member_intro_text', get_the_ID());
                                        @endphp
                                        @if(!empty($member_intro_text))
                                            {!! $member_intro_text !!}
                                        @else
                                            {!! the_excerpt() !!}
                                        @endif
                                        </p>
                                    </div>
                                </div>
                            @endwhile
                            <nav class="pagination">
                                {!! pagination_bar( $query ) !!}
                            </nav>
                            {{wp_reset_postdata()}}
                        @else
                         <span id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchResults_srchResults_lblNoResults" class="ContentLabel">Sorry but we could not find what you were looking for. Please try again.</span> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section ('no-content')
<main class="main"> @include('views.partials.header-search-member')
    <div class="container"> @include('views.partials.breadcrumbs') </div>
    <section>
        <div class="container">
            <div class="row inner-bottom-xs">
                <div class="col-md-12 search-results">
                    <div class="navbar-form search results">
                        <form role="search" action="@php echo site_url('/'); @endphp" method="get" id="searchform">
                            <div id="" class="searchBox">
                                <label for="" id="" style="display:none;">Search for:</label>
                                <input name="s" type="text" maxlength="1000" id="" class="form-control">
                                <input type="hidden" name="post_type" value="member" />
                                <input type="submit" name="" value=">" id="" class="btn btn-default btn-submit icon-right-open">
                                <div id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchBox_pnlPredictiveResultsHolder" class="predictiveSearchHolder"></div>
                            </div>
                        </form>
                    </div>
                    <div id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchResults_srchResults_pnlSearchResults"> <span id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchResults_srchResults_lblNoResults" class="ContentLabel">Sorry but we could not find what you were looking for. Please try again.</span> </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection