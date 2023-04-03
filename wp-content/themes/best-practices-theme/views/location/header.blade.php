<section class="page-heading-band primary-background-heading">
    <div class="container">
        @if (!empty(get_field('head_title')))
            @php $title = get_field('head_title') @endphp
        @else
            @php $title = get_the_title() @endphp
        @endif
        <h1 class="white">{{$title}}</h1>
        @if (!empty(get_field('sub_title')))
            <p class="white">{!! get_field('sub_title') !!}</p>
        @endif
    </div>
</section>