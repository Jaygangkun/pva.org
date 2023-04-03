<?php

/**
 * custom post type for News
 */
function news_custom_post_type (){
    
    $labels = array(
        'name' => 'News and Media',
        'singular_name' => 'News Item',
        'add_new' => 'Add News',
        'all_items' => 'All News',
        'add_new_item' => 'Add News',
        'edit_item' => 'Edit News',
        'new_item' => 'New News',
        'view_item' => 'View News',
        'search_item' => 'Search News',
        'not_found' => 'No News found',
        'not_found_in_trash' => 'No News found in trash',
        'parent_item_colon' => 'Parent News'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'news-and-media-center/recent-news', 'with_front' => FALSE),
        'capability_type' => 'post',
        'hierarchical' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ),
        'taxonomies' => array('news_category', 'post_tag'),
         register_taxonomy(
            'news_category',
            'jobs',
            array(
                'hierarchical' => true,
                'label' => 'News Categories',
                'query_var' => true,
                'show_in_nav_menus'=> true,
                'rewrite' => array( 'hierarchical' => true, 'slug' => 'news-and-media', 'with_front' => FALSE )
            ) 
        ),
        'menu_position' => 7,
        'exclude_from_search' => false
    );
    register_post_type('News', $args);
}

function create_new_url_querystring() {
    add_rewrite_rule(
        'blog/([^/]*)$',
        'index.php?name=$matches[1]',
        'top'
    );

    add_rewrite_tag('%blog%','([^/]*)');
}

function append_query_string( $url, $post, $leavename ) {

    if ( $post->post_type != 'post' )
            return $url;
    
    
    if ( false !== strpos( $url, '%postname%' ) ) {
            $slug = '%postname%';
    }
    elseif ( $post->post_name ) {
            $slug = $post->post_name;
    }
    else {
        $slug = sanitize_title( $post->post_title );
    }
    
    $url = home_url( user_trailingslashit( 'blog/'. $slug ) );

    return $url;
}

function mv_meta_in_search_query( $pieces, $args ) {
    global $wpdb;

    if ( ! empty( $args->query['s'] ) && $args->query['post_type'] == 'publications' ) { // only run on search query.
        $keywords        = explode(' ', $args->query['s']);
        $escaped_percent = $wpdb->placeholder_escape(); // WordPress escapes "%" since 4.8.3 so we can't use percent character directly.
        $query           = "";

        foreach ($keywords as $word)
        {
            //var_dump($word);
            if(empty(trim($word))) continue;

            $search_term = get_term_by( 'name', trim($word), 'publications_categories' );

            $query .= " (publications_postmeta_selector.meta_value LIKE '{$escaped_percent}{$word}{$escaped_percent}' AND publications_postmeta_selector.meta_key LIKE 'upload_document_{$escaped_percent}_document_title') OR ";
            /*$query .= " (publications_terms.name LIKE '{$escaped_percent}{$word}{$escaped_percent}') OR ";*/

            if($search_term && intval($search_term->term_id) > 0)
            {
                $query .= " (publications_category_selector.meta_key LIKE 'upload_document_{$escaped_percent}_document_category' AND FIND_IN_SET({$search_term->term_id}, publications_category_selector.meta_value)) OR ";
            }
        }

        if ( ! empty( $query ) ) { // append necessary WHERE and JOIN options.
            $pieces['where'] = str_replace( "AND ((({$wpdb->posts}.post_title LIKE '{$escaped_percent}", "( {$query} (({$wpdb->posts}.post_title LIKE '{$escaped_percent}", $pieces['where'] );
            $pieces['join'] = $pieces['join'] . " LEFT JOIN {$wpdb->postmeta} AS publications_postmeta_selector ON ({$wpdb->posts}.ID = publications_postmeta_selector.post_id) ";
            $pieces['join'] = $pieces['join'] . " LEFT JOIN {$wpdb->postmeta} AS publications_category_selector ON ({$wpdb->posts}.ID = publications_category_selector.post_id) ";
            

            //$pieces['join'] = $pieces['join'] . " LEFT JOIN {$wpdb->terms} AS publications_terms ON (publications_terms.term_id = publications_category_selector.meta_value AND publications_category_selector.meta_key LIKE 'upload_document_{$escaped_percent}_document_category') ";


            /*$pieces['join'] = $pieces['join'] . " LEFT JOIN {$wpdb->term_relationships} AS publications_term_relationships ON ({$wpdb->posts}.ID = publications_term_relationships.object_id) ";
            $pieces['join'] = $pieces['join'] . " LEFT JOIN {$wpdb->term_taxonomy} AS publications_term_taxonomy ON (publications_term_relationships.term_taxonomy_id = publications_term_taxonomy.term_taxonomy_id AND publications_term_taxonomy.taxonomy = 'publications_categories') ";
            $pieces['join'] = $pieces['join'] . " LEFT JOIN {$wpdb->terms} AS publications_terms ON (publications_term_taxonomy.term_id = publications_terms.term_id) ";*/
            $pieces['groupby'] = "{$wpdb->posts}.ID";

            //dump($pieces['where']);
            $pieces['where'] = ' AND ' . str_replace( "AND (({$wpdb->posts}.post_title", "OR (({$wpdb->posts}.post_title", $pieces['where'] );
        }
        //dump($pieces);
    }

    return $pieces;
}

function acf_document_category_update_value( $value, $post_id, $field, $original )
{
    if($field['return_format'] == 'id' && is_array($value) && count($value) > 0)
    {
        return implode(",", $value);
    }

    return $value;
}

function acf_document_category_load_value( $value, $post_id, $field )
{
    $value = get_post_meta($post_id*1, $field['name'], true);
    
    if($field['return_format'] == 'id' && !empty($value))
    {
        return explode(",", $value);
    }

    return $value;
}

function html_head_code()
{
    global $post;

    if($post && isset($post->ID) && intval($post->ID) > 0)
    {
        $head_html_code = get_field('head_html_code', $post->ID);

        if(!empty(trim($head_html_code)))
        {
            echo "\n<!-- Custom Head HTML Start -->\n";
            echo $head_html_code;
            echo "\n<!-- Custom Head HTML End -->\n";
        }
    }
}

add_action( 'init', 'news_custom_post_type' );
add_action( 'init', 'create_new_url_querystring', 999 );
add_filter( 'post_link', 'append_query_string', 10, 3 );
add_filter( 'posts_clauses', 'mv_meta_in_search_query', 20, 2 );
add_filter( 'acf/update_value/name=document_category', 'acf_document_category_update_value', 10, 4);
add_filter( 'acf/load_value/name=document_category', 'acf_document_category_load_value', 10, 3);

add_action( 'wp_head', 'html_head_code', 999);

flush_rewrite_rules();