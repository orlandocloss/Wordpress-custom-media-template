<?php
get_header();
?>

<!-- Your banner image -->
<div class="banner">
    <img src="<?php echo get_template_directory_uri(); ?>/images/xsist-banner.jpg" alt="Banner">
</div>

<!-- Your welcome title and description -->
<div class="welcome">
    <?php
    // Query for the 'Welcome' post
    $welcome_query = new WP_Query(array(
        'name' => 'welcome', // post slug
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1,
    ));

    // Check if the post exists
    if ($welcome_query->have_posts()) {
        while ($welcome_query->have_posts()) {
            $welcome_query->the_post();

            // Display the post title and content
            echo '<h1>' . get_the_title() . '</h1>';
            echo '<p>' . get_the_content() . '</p>';
        }

        // Restore original Post Data
        wp_reset_postdata();
    } else {
        // If the 'Welcome' post is not found, fall back to default text
        echo '<h1>Welcome Title</h1>';
        echo '<p>Welcome description...</p>';
    }
    ?>
</div>

<?php
get_footer();
?>
