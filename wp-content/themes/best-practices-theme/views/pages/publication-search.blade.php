@extends('views.layouts.main')
@section('content')
    <main class="main">
        <div class="container">
            @include('views.partials.breadcrumbs')
            @include('views.pages.search-form')

            <section class="general-content-publications">
                <h2>
                    Search Results For: @php echo str_replace("+"," ",$_GET['s']); @endphp
                </h2>
                @php if ( have_posts() ) {  @endphp
                    <div id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone5_zC_SmartSearchResults_srchResults_pnlSearchResults">
                        @php while ( have_posts() ) {
                        the_post();  @endphp
                        <div class="article-summary-content search publication">
                            @php
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
                            <a href="{!! $link !!}" target="_blank">{{$text}}</a>
                        </div>
                        @php } @endphp
                    </div>
                @php } else { @endphp
                    <div class="noResult">
                        No result found
                    </div>
                @php }
                wp_reset_postdata(); @endphp
            </section>
        </div>
    </main>
@endsection
@section('no-content')
    <main class="main">
        <div class="container">
            @include('views.partials.breadcrumbs')
            @include('views.pages.search-form')

            <section class="general-content-publications">
                <h2>
                    Search Results For: @php echo str_replace("+"," ",$_GET['s']); @endphp
                </h2>
                <span id="p_lt_WebPartZone4_zP_pH_p_lt_WebPartZone3_zSearch_SmartSearchResults_srchResults_lblNoResults" class="ContentLabel">Sorry but we could not find what you were looking for. Please try again.</span>
            </section>
        </div>
    </main>
@endsection