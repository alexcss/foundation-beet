//How to Display Custom Post Type
    <?php $arg = array(
        'post_type'	    => 'post_type_name', /*<-- Enter name of Custom Post Type here*/
        'order'		    => 'ASC',
        'orderby'	    => 'menu_order',
        'posts_per_page'    => -1
    );
    $the_query = new WP_Query( $arg );
    if ( $the_query->have_posts() ) : ?>
        <div id="post-type" class="post-type">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?><!-- BEGIN of Post -->
                <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
            <?php endwhile; ?><!-- END of Post -->
        </div><!-- END of .post-type -->
    <?php endif; wp_reset_query(); ?>


// Display Custom Post Type with pagination
    <?php query_posts('post_type=post&post_status=publish&posts_per_page=2&paged='. get_query_var('paged')); ?> /*<-- Enter name of Custom Post Type and count of posts on page here-->*/
	<?php if ( have_posts() ) : ?>
	    <?php while ( have_posts() ) : the_post(); ?><!-- BEGIN of Post -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <h6>Written by <?php the_author_link(); ?> on <?php the_time(get_option('date_format')); ?></h6>
                <?php if ( has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                        <?php the_post_thumbnail(); ?>
                    </a>
                <?php endif; ?>
                <?php the_excerpt(); ?>
            </article>
	    <?php endwhile; ?><!-- END of Post -->
	<?php endif; ?>
    <div class="pagination"><?php echo foundationpress_pagination(); ?></div><!-- END of .pagination -->


// How To Display ACF Gallery
    <div class="gallery">
        <?php $images = get_field('gallery'); /*<-- Enter Gallery name here-->*/
        if( $images ): ?>
            <?php foreach( $images as $image ): ?>
                <div class="large-4 medium-4 small-12 columns">
                    <img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <p><?php echo $image['caption']; ?></p>
                </div><!-- END of .columns-->
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


// How To Display ACF Options
    <?php add_filter('acf/options_page/settings', 'my_options_page_settings');
	function my_options_page_settings($options) {
	    $options['title'] = __('My Options');
	    $options['pages'] = array(
            __('Header'),
            __('Sidebar'),
            __('Contacts'),
            __('Footer')
	    );
	    return $options;
	} ?>

// How to Display Repeater Field
    <?php if( have_rows('services_with_excerpt') ): ?>
        <?php while( have_rows('services_with_excerpt') ): the_row();
            // Declare variables below
            $icon = get_sub_field('services_with_excerpt_image');
            $title = get_sub_field('services_with_excerpt_title');
            $text = get_sub_field('services_with_excerpt_excerpt');
            $more = get_sub_field('services_with_excerpt_read_more');
            $more_link = get_sub_field('services_with_excerpt_read_more_link');
            // Use variables below ?>
            <div class="large-3 medium-3 small-12 columns">
                <img src="<?php echo $icon; ?>" />
                <h3><?php echo $title; ?></h3>
                <p><?php echo $text; ?></p>
                <a class="more" href="<?php echo $more_link; ?>"><?php echo $more; ?></a>
            </div><!--end of .columns -->
        <?php endwhile; ?>
    <?php endif; ?>

// Custom excerpt example
    <?php
        $trimmed_content = wp_trim_words( get_the_content(), 40, '<a href="'. get_permalink() .'"> ...Read More</a>' );
        echo $trimmed_content;
    ?>

// Flexible content
    <?php if (is_front_page()) { ?> <!--is_home | is_blog | is_page(42) | is_page(array(5,7,164)-->
	    <!-- Do stuff here-->
    <?php } ?>

    <!------=OR=-------->
    <?php if ( is_front_page() ) { ?>
	    <!-- Do stuff here-->
    <?php } else { ?>
	    <!-- Do stuff on other pages-->
    <?php } ?>


// Add class to the_post_thumbnail
    <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?> /*<-- Enter Classes here-->*/

// WP_Query Description
<?php
/**
* WordPress Query Comprehensive Reference
*
* CODEX: http://codex.wordpress.org/Class_Reference/WP_Query
* Source: http://core.trac.wordpress.org/browser/tags/3.3.1/wp-includes/query.php
*/

$args = array(

//////Author Parameters - Show posts associated with certain author.
    'author' => 1,2,3,                        //(int) - use author id [use minus (-) to exclude authors by ID ex. 'author' => -1,-2,-3,]
    'author_name' => 'luetkemj',              //(string) - use 'user_nicename' (NOT name)

//////Category Parameters - Show posts associated with certain categories.
    'cat' => 5,//(int) - use category id.
    'category_name' => 'staff', 'news',       //(string) - use category slug (NOT name).
    'category__and' => array( 2, 6 ),         //(array) - use category id.
    'category__in' => array( 2, 6 ),          //(array) - use category id.
    'category__not_in' => array( 2, 6 ),      //(array) - use category id.

//////Tag Parameters - Show posts associated with certain tags.
    'tag' => 'cooking',                       //(string) - use tag slug.
    'tag_id' => 5,                            //(int) - use tag id.
    'tag__and' => array( 2, 6),               //(array) - use tag ids.
    'tag__in' => array( 2, 6),                //(array) - use tag ids.
    'tag__not_in' => array( 2, 6),            //(array) - use tag ids.
    'tag_slug__and' => array( 'red', 'blue'), //(array) - use tag slugs.
    'tag_slug__in' => array( 'red', 'blue'),  //(array) - use tag slugs.

//////Taxonomy Parameters - Show posts associated with certain taxonomy.
  //Important Note: tax_query takes an array of tax query arguments arrays (it takes an array of arrays)
  //This construct allows you to query multiple taxonomies by using the relation parameter in the first (outer) array to describe the boolean relationship between the taxonomy queries.
    'tax_query' => array(                     //(array) - use taxonomy parameters (available with Version 3.1).
    'relation' => 'AND',                      //(string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
      array(
        'taxonomy' => 'color',                //(string) - Taxonomy.
        'field' => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
        'terms' => array( 'red', 'blue' ),    //(int/string/array) - Taxonomy term(s).
        'include_children' => true,           //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
        'operator' => 'IN'                    //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
      ),
      array(
        'taxonomy' => 'actor',
        'field' => 'id',
        'terms' => array( 103, 115, 206 ),
        'include_children' => false,
        'operator' => 'NOT IN'
      )
    ),

//////Post & Page Parameters - Display content based on post and page parameters.
    'p' => 1,                               //(int) - use post id.
    'name' => 'hello-world',                //(string) - use post slug.
    'page_id' => 1,                         //(int) - use page id.
    'pagename' => 'sample-page',            //(string) - use page slug.
    'pagename' => 'contact_us/canada',      //(string) - Display child page using the slug of the parent and the child page, separated ba slash
    'post_parent' => 1,                     //(int) - use page id. Return just the child Pages.
    'post__in' => array(1,2,3),             //(array) - use post ids. Specify posts to retrieve.
    'post__not_in' => array(1,2,3),         //(array) - use post ids. Specify post NOT to retrieve.
    //NOTE: you cannot combine 'post__in' and 'post__not_in' in the same query

//////Type & Status Parameters - Show posts associated with certain type or status.
    'post_type' => array(                   //(string / array) - use post types. Retrieves posts by Post Types, default value is 'post';
            'post',                         // - a post.
            'page',                         // - a page.
            'revision',                     // - a revision.
            'attachment',                   // - an attachment. The default WP_Query sets 'post_status'=>'published', but atchments default to 'post_status'=>'inherit' so you'll need to set the status to 'inherit' or 'any'.
            'my-post-type',                 // - Custom Post Types (e.g. movies)
            ),
    'post_status' => array(                 //(string / array) - use post status. Retrieves posts by Post Status, default value i'publish'.
            'publish',                      // - a published post or page.
            'pending',                      // - post is pending review.
            'draft',                        // - a post in draft status.
            'auto-draft',                   // - a newly created post, with no content.
            'future',                       // - a post to publish in the future.
            'private',                      // - not visible to users who are not logged in.
            'inherit',                      // - a revision. see get_children.
            'trash'                         // - post is in trashbin (available with Version 2.9).
            ),

    //NOTE: The 'any' keyword available to both post_type and post_status queries cannot be used within an array.
    'post_type' => 'any',                    // - retrieves any type except revisions and types with 'exclude_from_search' set to true.
    'post_status' => 'any',                  // - retrieves any status except those from post types with 'exclude_from_search' set to true.

//////Pagination Parameters
    'posts_per_page' => 10,                 //(int) - number of post to show per page (available with Version 2.1). Use 'posts_per_page'=-1 to show all posts. Note if the query is in a feed, wordpress overwrites this parameter with the stored 'posts_per_rss' option. Treimpose the limit, try using the 'post_limits' filter, or filter 'pre_option_posts_per_rss' and return -1
    'posts_per_archive_page' => 10,         //(int) - number of posts to show per page - on archive pages only. Over-rides showposts anposts_per_page on pages where is_archive() or is_search() would be true
    'nopaging' => false,                    //(bool) - show all posts or use pagination. Default value is 'false', use paging.
    'paged' => get_query_var('page'),       //(int) - number of page. Show the posts that would normally show up just on page X when usinthe "Older Entries" link.
    //NOTE: You should set get_query_var( 'page' ); if you want your query to work with pagination. Since Wordpress 3.0.2, you dget_query_var( 'page' ) instead of get_query_var( 'paged' ). The pagination parameter 'paged' for WP_Query() remains the same.

//////Offset Parameter
    'offset' => 3,                          //(int) - number of post to displace or pass over.

//////Order & Orderby Parameters - Sort retrieved posts.
    'order' => 'DESC',                      //(string) - Designates the ascending or descending order of the 'orderby' parameter. Defaultto 'DESC'.
                                              //Possible Values:
                                              //'ASC' - ascending order from lowest to highest values (1, 2, 3; a, b, c).
                                              //'DESC' - descending order from highest to lowest values (3, 2, 1; c, b, a).
    'orderby' => 'date',                    //(string) - Sort retrieved posts by parameter. Defaults to 'date'.
                                              //Possible Values://
                                              //'none' - No order (available with Version 2.8).
                                              //'ID' - Order by post id. Note the captialization.
                                              //'author' - Order by author.
                                              //'title' - Order by title.
                                              //'date' - Order by date.
                                              //'modified' - Order by last modified date.
                                              //'parent' - Order by post/page parent id.
                                              //'rand' - Random order.
                                              //'comment_count' - Order by number of comments (available with Version 2.9).
                                              //'menu_order' - Order by Page Order. Used most often for Pages (Order field in the EdiPage Attributes box) and for Attachments (the integer fields in the Insert / Upload MediGallery dialog), but could be used for any post type with distinct 'menu_order' values (theall default to 0).
                                              //'meta_value' - Note that a 'meta_key=keyname' must also be present in the query. Note alsthat the sorting will be alphabetical which is fine for strings (i.e. words), but can bunexpected for numbers (e.g. 1, 3, 34, 4, 56, 6, etc, rather than 1, 3, 4, 6, 34, 56 as yomight naturally expect).
                                              //'meta_value_num' - Order by numeric meta value (available with Version 2.8). Also notthat a 'meta_key=keyname' must also be present in the query. This value allows for numericasorting as noted above in 'meta_value'.
                                              //'post__in' - Preserve post ID order given in the post__in array (available with Version 3.5).

//////Sticky Post Parameters - Show Sticky Posts or ignore them.
    'ignore_sticky_posts' => false,         //(bool) - ignore sticky posts or not. Default value is false, don't ignore. Ignore/excludsticky posts being included at the beginning of posts returned, but the sticky post will still be returned in the natural order othat list of posts returned.
    //NOTE: For more info on sticky post queries see: http://codex.wordpress.org/Class_Reference/WP_Query#Sticky_Post_Parameters

//////Time Parameters - Show posts associated with a certain time period.
    'year' => 2012,                         //(int) - 4 digit year (e.g. 2011).
    'monthnum' => 3,                        //(int) - Month number (from 1 to 12).
    'w' =>  25,                             //(int) - Week of the year (from 0 to 53). Uses the MySQL WEEK command. The mode is dependenon the "start_of_week" option.
    'day' => 17,                            //(int) - Day of the month (from 1 to 31).
    'hour' => 13,                           //(int) - Hour (from 0 to 23).
    'minute' => 19,                         //(int) - Minute (from 0 to 60).
    'second' => 30,                         //(int) - Second (0 to 60).

//////Custom Field Parameters - Show posts associated with a certain custom field.
    'meta_key' => 'key',                    //(string) - Custom field key.
    'meta_value' => 'value',                //(string) - Custom field value.
    'meta_value_num' => 10,                 //(number) - Custom field value.
    'meta_compare' => '=',                  //(string) - Operator to test the 'meta_value'. Possible values are '!=', '>', '>=', '<', or ='. Default value is '='.
    'meta_query' => array(                  //(array) - Custom field parameters (available with Version 3.1).
       array(
         'key' => 'color',                  //(string) - Custom field key.
         'value' => 'blue',                  //(string/array) - Custom field value (Note: Array support is limited to a compare value of 'IN', 'NOT IN', 'BETWEEN', or 'NOT BETWEEN')
         'type' => 'CHAR',                  //(string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Default value is 'CHAR'.
         'compare' => '='                   //(string) - Operator to test. Possible values are '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN'. Default value is '='.
       ),
       array(
         'key' => 'price',
         'value' => array( 1,200 ),
         'compare' => 'NOT LIKE'
       ),

//////Permission Parameters - Display published posts, as well as private posts, if the user has the appropriate capability:
    'perm' => 'readable',                    //(string) Possible values are 'readable', 'editable' (possible more ie all capabilitiealthough I have not tested)

//////Parameters relating to caching
    'no_found_rows' => false,               //(bool) Default is false. WordPress uses SQL_CALC_FOUND_ROWS in most queries in order timplement pagination. Even when you don’t need pagination at all. By Setting this parameter to true you are telling wordPress not tcount the total rows and reducing load on the DB. Pagination will NOT WORK when this parameter is set to true. For more informatiosee: http://flavio.tordini.org/speed-up-wordpress-get_posts-and-query_posts-functions
    'cache_results' => true,                //(bool) Default is true
    'update_post_term_cache' => true,       //(bool) Default is true
    'update_post_meta_cache' => true,       //(bool) Default is true
    //NOTE Caching is a good thing. Setting these to false is generally not advised. For more info on usage see: http://codex.wordpresorg/Class_Reference/WP_Query#Permission_Parameters

//////Search Parameter
    's' => $s,                              //(string) - Passes along the query string variable from a search. For example usage see: http://www.wprecipes.com/how-to-display-the-number-of-results-in-wordpress-search
    'exact' => true,                         //(bool) - flag to make it only match whole titles/posts - Default value is false. For more information see: https://gist.github.com/2023628#gistcomment-285118
    'sentance' => true,                      //(bool) - flag to make it do a phrase search - Default value is false. For more information see: https://gist.github.com/2023628#gistcomment-285118

//////Post Field Parameters
    //Not sure what these do. For more info see: http://codex.wordpress.org/Class_Reference/WP_Query#Post_Field_Parameters

//////Filters
    //For more information on available Filters see: http://codex.wordpress.org/Class_Reference/WP_Query#Filters

));

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
      // Do Stuff
    endwhile;
endif;

// Reset Post Data
wp_reset_postdata(); ?>


// Output google map
// Map with Custom Marker
<?php if( $location = get_field('location')):?>
    <div class="acf-map">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-marker-icon="<?php get_stylesheet_directory_uri(); ?>/images/map_marker.png"></div>
    </div>
<?php endif; ?>
//Default Map
<?php if( $location = get_field('location')):?>
    <div class="acf-map">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div>
<?php endif; ?>
