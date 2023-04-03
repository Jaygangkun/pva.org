@extends('views.layouts.main')

@section('content')
    @while (have_posts()) @php the_post() @endphp
    <div class="row">
        <div class="two-col-band-content">
            @php
            $style = 'style="background: url('.get_the_post_thumbnail_url().')"';
            @endphp
            <div class="two-col-band band-bg" @php echo $style;  @endphp>
                <div class="band-col-text pull-right">
                    <div class="black"></div>
                </div>
            </div>
            <div class="two-col-band primary-background">
                <div class="band-col-text pull-left">
                    <div class="white">
                        <h1 style="margin-bottom: 15px;">{{the_title()}}</h1>
                        <h3>
                            {!! get_field('head_text') !!} <a href="mailto:{!! get_field('header_email') !!}">{!! get_field('header_email') !!}</a><br>
							<!-- https://pva.org/buybooks -->
                            <span class="btn-widget text-left" style="margin-top: 20px; display: block">
                              <a href="https://pva.org/buybooks" class="btn btn-large secondary-background standard-width white" target="_blank" onclick="loadJS('https://tag.simpli.fi/sifitag/e5ea8820-7b08-013b-abe7-0cc47abd0334.js');">Buy Our Books</a>
<!-- start of simpli.fi after button code -->
								<script type="application/javascript">
function loadJS(file) {
    // DOM: Create the script element
    var jsElm = document.createElement("script");
    // set the type attribute
    jsElm.type = "application/javascript";
    // make the script element load file
    jsElm.src = file;
    // finally insert the element to the body element in order to load the script
    document.body.appendChild(jsElm);
}
</script>
<!-- End of simpli.fi after button code -->
                            </span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="container">
            @include('views.partials.breadcrumbs')
            <div class="row">
                <div class="col-lg-8">
                    @include('views.pages.search-form')
                    @php
                    $args = array (
                    'post_type' => 'publications',
                    'orderby'   => 'title',
                    'order'     => 'ASC',
                    );
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) {
                    @endphp
                    <section class="general-content-publications">
                        <div class="pd-30"></div>
                        {!!the_content()!!}
                    </section>
                    @php }
                    wp_reset_postdata();
                    @endphp
                </div>
                <div class="col-lg-4">
                    @include('views.partials.publications-sidebar')
                </div>
            </div>
        </div>
    </main>
    @endwhile
@endsection
