<section class="news-area" style="margin-top:15px;">
    <!-- <h2 style="color: #000">Tags</h2>
    @php $terms = get_terms('post_tag',array('hide_empty'=>false)); @endphp
    <ul>
    @php 
    foreach($terms as $t) {
      echo '<li><a href="' . get_tag_link( $post_tag ) . '">' .$t->name.' ('.$t->count.')</a></li>';
    }
    @endphp
    </ul> -->


<style>
	.tagsul {
		max-height: 133px;
		overflow: hidden;
	}
</style>
<h2 style="color: #000">Tags</h2>
<?php $cat_args=array(
  'orderby' => 'count',
  	  'order' => 'DESC'
   );
?>
<ul class="tagsul"><?php 
$categories=get_categories($cat_args);
  foreach($categories as $category) {
    $args=array(
      'showposts' => -1,
      'category__in' => array($category->term_id),
      'caller_get_posts'=>1,
      
    );
    $posts=get_posts($args);
      if ($posts) {
        echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.' ('.$category->count.')</a></li> ';
        
      } // if ($posts
    } // foreach($categories
?></ul>
<a href="javascript::void(0)" id="viewalltags">See All </a>
</section>
<p>&nbsp;</p>


