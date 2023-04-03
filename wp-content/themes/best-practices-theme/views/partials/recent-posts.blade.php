<section class="news-area" style="margin-top: 25px;">
    <h2 style="color: #000">Recent Posts</h2>
    @php 
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 4, 
        'post_status' => 'publish'
    ));
    @endphp
    <div>
        <ul>
            @foreach($recent_posts as $posts)
                <li><a href="{{get_permalink($posts['ID'])}}">{{$posts['post_title']}}</a></li>
            @endforeach
        </ul>
    </div>
    
</section>
