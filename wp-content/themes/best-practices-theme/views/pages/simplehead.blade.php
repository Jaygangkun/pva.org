@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
	<div class="banner-publications">
        <div class="container">
            <h1>{{the_title()}}</h1>
        </div>
    </div>
    <main class="main">
		<div class="container">
			@include('views.partials.breadcrumbs')
		    {!!the_content()!!}
		</div>
	</main>
@endwhile
@endsection
