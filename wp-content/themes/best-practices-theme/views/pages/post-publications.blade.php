@extends('views.layouts.main')

@section('content')
    <div class="banner-publications">
        <div class="container">
            <h1>Publications: {{the_title()}}</h1>
        </div>
    </div>
    <main class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{get_home_url()}}">Home</a></li>
                <li><a href="{{get_home_url()}}/research-resources/">research & resources</a></li>
                <li><a href="{{get_home_url()}}/research-resources/publications/">publications</a></li>
                <li>{{the_title()}}</li>
            </ul>

            <div class="row">
                <div class="col-lg-8">
                    @include('views.pages.search-form')
                    <section class="general-content">
                        <h2>{{the_title()}}</h2>
                        @if (!empty(get_field('publication_content')))
                            <div class="publicationContent">
                                @php echo get_field('publication_content') @endphp
                            </div>
                        @endif
                        @if( have_rows('upload_document') )
                            @while( have_rows('upload_document') )
                                @php
                                the_row();
                                $document_title = get_sub_field('document_title');

                                // if document url available then consider it otherwise set file input
                                $documentFile   = get_sub_field('document');
                                $documentUrl    = get_sub_field('document_url');

                                if (! empty($documentUrl)) {
                                    $document = $documentUrl;
                                }else{
                                    $document = $documentFile;
                                }
                                
                                $title_url = get_sub_field('title_url');

                                @endphp
                                <div class="article-summary-content search publication">
                                    <h2>
                                        <a href="{!! $title_url !!}" target="_blank">
                                            {{$document_title}}
                                        </a>
                                    </h2>
                                    @php
                                    $buy_this_cpg_link = get_sub_field('buy_this_cpg_link');
                                    $cpg_link = get_sub_field('cpg_link');

                                    if($buy_this_cpg_link && $cpg_link) {
                                      @endphp
                                      <div style="margin-bottom: 10px;">
                                        <a href="{!! $cpg_link !!}" target="_blank" class="btn btn-medium secondary-background standard-width white">Buy this CPG</a>
                                      </div>
                                      @php
                                    }
                                    @endphp
                                    <a href="{!! $document !!}" target="_blank">Download PDF</a>
                                </div>
                            @endwhile
                        @endif
                    </section>
                </div>
                <div class="col-lg-4">
                    <div class="news-area">
                        <div class="sidebar-widget">
                            @include("views.partials.publications-sidebar")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
