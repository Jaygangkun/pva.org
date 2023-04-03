@extends('views.layouts.main')

@section ('no-content')
    <div class="banner-publications">
        <div class="container">
            <h1>No Results Found!</h1>
        </div>
    </div>
    <main class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{get_home_url()}}">Home</a></li>
                <li>Search Results</li>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <h1 style="display: block; text-align: center">Oops! We were not able to find any results!</h1>
                    <p>&nbsp;</p>
                    <div class="container">
                        <form action="{{get_home_url()}}" method="_GET" class="emp-search-holder">
                            <input type="text" placeholder="" class="text-feild" name="s">
                            <button type="submit" class="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('content')
<div class="banner-publications">
        <div class="container">
            <h1>{{sprintf('Search Results for: %s', get_search_query())}}</h1>
        </div>
    </div>
    <main class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{get_home_url()}}">Home</a></li>
                <li>Search Results</li>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                        @while (have_posts()) @php the_post() @endphp
                            <li>
                                <h2><a href="{{get_the_permalink()}}" style="color:#000">{{get_the_title()}}</a></h2>
                                {!!the_excerpt()!!}
                                <hr>
                            </li>
                        @endwhile
                    </ul>
                    {!!get_the_posts_pagination()!!}
                </div>
            </div>
        </div>
    </main>

@endsection
