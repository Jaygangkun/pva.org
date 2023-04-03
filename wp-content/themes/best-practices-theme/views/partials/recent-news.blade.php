<section class="news-area">
    <h2 style="color: #000">Recent News</h2>
    @php 
    $posts_per_page = !empty(get_field('show_number_of_posts')) ? get_field('show_number_of_posts')*1 : 4;
    $news_array = get_posts(array(
        'post_type'      => array ('news'),
        'post_status'    => array ('publish'),
        'paged'          => 0,
        'posts_per_page' => $posts_per_page,
    ));
    @endphp
    @foreach($news_array as $news)
    <div class="news-list">
        <a href="{{get_post_permalink($news->ID)}}" class="image">
            <span class="icon"><i class="icon-plus-light1"></i></span>
            @if(get_the_post_thumbnail_url($news->ID))
                <img src="{{get_the_post_thumbnail_url($news->ID)}}" alt="image-description">
            @endif
        </a>
        <div class="description">
            <span class="date">{{date('F j, Y', strtotime($news->post_date))}}</span>
            <p><a href="{{get_post_permalink($news->ID)}}">{{$news->post_title}} </a></p>
        </div>
    </div>
    @endforeach
    <a href="{{home_url()}}/news-and-media/recent-news/" class="view"><span>View All</span> <i class="icon icon-arrow-right-solid"></i></a>
</section>