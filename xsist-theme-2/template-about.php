<?php
/**
 * Template Name: About
 */
get_header(); 

// Query for the 'About' post
$about_query = new WP_Query(array(
    'name' => 'about', // post slug
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 1,
));

// Check if the post exists
if ($about_query->have_posts()) {
    while ($about_query->have_posts()) {
        $about_query->the_post();
        
        // Get the post content
        $content = get_the_content();

        // Use a regular expression to find the first <img> tag
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);

        // Get the first image src
        $image_src = $matches[1][0] ?? '';

        // Get the title
        $title = get_the_title();

        // Get the content excluding the first image
        $content_without_image = preg_replace('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', '', $content, 1);
    ?> 
    
    <!-- Your banner image -->
    <div class="about-banner">
        <div class="production-thumbnail-2">
            <img src="<?php echo $image_src; ?>" alt="Banner">
        </div>
    </div>

    <div class="about-container">
        <div class="about-title">
            <h1><?php echo $title; ?></h1>
        </div>

        <!-- Display the main text without splitting -->
        <div class="about-text">
            <?php echo $content_without_image; ?>
        </div>
    </div>

    <?php
    }
    
    // Restore original Post Data
    wp_reset_postdata();
} else {
    // If the 'About' post is not found, display a default message
    echo 'The About post could not be found.';
}
?>

<?php
get_footer();
