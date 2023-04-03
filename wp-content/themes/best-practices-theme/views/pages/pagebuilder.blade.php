@extends('views.layouts.main')
@section('content')
@while (have_posts()) @php the_post() @endphp
    
    
    {!!the_content()!!}
@endwhile
@endsection
