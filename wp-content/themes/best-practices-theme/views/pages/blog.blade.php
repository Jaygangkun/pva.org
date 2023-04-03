@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
<main class="main">
    <div class="container">
        <p>&nbsp;</p>
        <h1>Paralyzed Veterans of America Blog</h1>
        <p>&nbsp;</p>
        <div class="">
            <div class="row">
                <div class="col-lg-8">
                    
                    

                    @php
                    // the query

                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>5,'paged' => $paged)); @endphp
                     
                    @php if ( $wpb_all_query->have_posts() ) : @endphp
                     
                    
                     
                        <!-- the loop -->
                        @php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); @endphp

                       
                        <div class="post-listing post-item">
                            <div class="blog-post">
                                <div class="post-header">
                                    <h2><a href="@php the_permalink(); @endphp">@php the_title(); @endphp</a></h2>
                                    <div>Posted by <a class="author-link" href="{{home_url('/author')}}/{{get_the_author_meta('user_login')}}/">@php echo get_the_author(); @endphp</a> on @php echo get_the_date( 'l F j, Y' ); @endphp</div>

<!--Dec 29, 2020 10:00:00 AM--> 

                                </div>
                                <div class="social-icons">
                                @php //echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); @endphp




                                <span id="hs_cos_wrapper_blog_social_sharing" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_blog_social_sharing" style="" data-hs-cos-general-type="widget" data-hs-cos-type="blog_social_sharing">
<div class="hs-blog-social-share">
<ul class="hs-blog-social-share-list">
<li class="hs-blog-social-share-item hs-blog-social-share-item-twitter">
<!-- Twitter social share -->
<iframe id="twitter-widget-0" scrolling="no" allowtransparency="true" allowfullscreen="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" style="position: static; visibility: visible; width: 60px; height: 20px;" title="Twitter Tweet Button" src="https://platform.twitter.com/widgets/tweet_button.f88235f49a156f8b4cab34c7bc1a0acc.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=<?php echo get_home_url(); ?>&amp;size=m&amp;text=<?php echo the_title(); ?>&amp;time=1632916016767&amp;type=share&amp;url=<?php echo get_permalink(); ?>" data-url="<?php echo get_permalink(); ?>" frameborder="0"></iframe>
</li>
<li class="hs-blog-social-share-item hs-blog-social-share-item-linkedin">
<!-- LinkedIn social share -->
<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php the_permalink(); ?>">
<svg viewBox="0 0 24 24" width="24px" height="24px" x="0" y="0" preserveAspectRatio="xMinYMin meet">
      <g style="fill: currentColor">
        <rect x="-0.003" style="fill:none;" width="24" height="24"></rect>
        <path style="" d="M20,2h-16c-1.1,0-2,0.9-2,2v16c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V4C22,2.9,21.1,2,20,2zM8,19h-3v-9h3V19zM6.5,8.8C5.5,8.8,4.7,8,4.7,7s0.8-1.8,1.8-1.8S8.3,6,8.3,7S7.5,8.8,6.5,8.8zM19,19h-3v-4c0-1.4-0.6-2-1.5-2c-1.1,0-1.5,0.8-1.5,2.2V19h-3v-9h2.9v1.1c0.5-0.7,1.4-1.3,2.6-1.3c2.3,0,3.5,1.1,3.5,3.7V19z"></path>
      </g>
    </svg></xdoor-icon>Share</button></a>
</li>
<li class="hs-blog-social-share-item hs-blog-social-share-item-facebook">
<!-- Facebook share -->
<div class="fb-like fb_iframe_widget" data-href="<?php echo get_permalink(); ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="true" data-width="120" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=0&amp;href=<?php echo get_permalink(); ?>&amp;layout=button&amp;locale=en_GB&amp;sdk=joey&amp;share=true&amp;show_faces=false&amp;width=120"><span style="vertical-align: bottom; width: 120px; height: 28px;"><iframe name="f1a232bbdc78a6" data-testid="fb:like Facebook Social Plugin" title="fb:like Facebook Social Plugin" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" style="border: medium none; visibility: visible; width: 120px; height: 28px;" src="https://www.facebook.com/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df3de81ef31f35e4%26domain%3Dblog.pva.org%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fblog.pva.org%252Fff1300cc788dc%26relation%3Dparent.parent&amp;container_width=0&amp;href=<?php echo get_permalink(); ?>&amp;layout=button&amp;locale=en_GB&amp;sdk=joey&amp;share=true&amp;show_faces=false&amp;width=120" class="" width="120px" height="1000px" frameborder="0"></iframe></span></div>
</li>
</ul>
</div>
</span>
















                                </div>

                                
                                <div class="post-body clearfix">
                                    <!--post summary-->
                                    @php
                                    if(has_post_thumbnail()){ @endphp

                                        <div class="hs-featured-image-wrapper">
                                            <a href="@php the_permalink(); @endphp" title="" class="hs-featured-image-link">
                                                @php the_post_thumbnail(); @endphp
                                            </a>
                                        </div>
                                          
                                     @php
                                     }@endphp
                                    
                                </div>
                                <a class="more-link" href="@php the_permalink(); @endphp">Read More</a>
                                <div class="custom_listing_comments">
                                    <?php comments_number( '0', '1', '%' ); ?> Comments <a href="@php the_permalink(); @endphp#respond">Click here to read/write comments</a>
                                </div>
                            </div>
                        </div>
                        @php endwhile; @endphp
                        <!-- end of the loop -->
                     
                        <nav class="pagination">
                        {!! pagination_bar( $wpb_all_query ) !!}
                        </nav>
                   
                     
                        @php wp_reset_postdata(); @endphp
                     
                    @php else : @endphp
                        <p>@php _e( 'Sorry, no posts matched your criteria.' ); @endphp</p>
                    @php endif; @endphp


                    

                   
                </div>
                


                <div class="col-lg-4">
                    <div class="news-area">                        
                        <div class="sidebar-widget">
                            @if(get_field('sidebar_editor','options'))
                                {!!get_field('sidebar_editor','options')!!}
                            @endif
                        </div>
                        <div class="sidebar-widget">
                            @if(get_field('show_recent_posts','options'))
                                @include('views.partials.recent-posts')
                            @endif
                        </div>
                        <div class="sidebar-widget">
                            @if(get_field('show_tags','options'))
                                @include('views.partials.tags')
                            @endif

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endwhile
@endsection