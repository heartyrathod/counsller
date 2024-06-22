<?php
/**
 * Template Name: Custom Page Template with Pagination
 */

get_header();

// Define pagination parameters
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'post', // Example post type
    'posts_per_page' => 5,
    'paged' => $paged
);

// Custom query
$query = new WP_Query( $args );

if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
        // Your post content here
        the_title( '<h2>', '</h2>' );
        the_content();
    endwhile;

    // Pagination
    $pagination_args = array(
        'base' => get_pagenum_link( 1 ) . '%_%',
        'format' => '/page/%#%',
        'current' => max( 1, $paged ),
        'total' => $query->max_num_pages,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
    );

    echo '<div class="pagination">';
    echo paginate_links( $pagination_args );
    echo '</div>';

    wp_reset_postdata();
else :
    echo '<p>No posts found</p>';
endif;

get_footer();
?>
