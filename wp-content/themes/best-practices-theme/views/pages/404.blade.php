@extends('views.layouts.main')

{{-- The loop is empty on a 404 so don't use 'content' --}}
@section('no-content')
    <h1>Oops! We can't find that page!</h1>
    <div class="container">
	    <form action="{{get_home_url()}}" method="_GET" class="emp-search-holder">
		    <input type="text" placeholder="" class="text-feild" name="s">
		    <button type="submit" class="submit"><i class="far fa-search"></i></button>
		</form>
	</div>
@endsection