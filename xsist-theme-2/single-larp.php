<?php
get_header(); 

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        
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

        // Get the background color from the custom field 'banner_background_color'
        $banner_background_color = get_post_meta(get_the_ID(), 'banner_background_color', true);
    ?> 
    
    <!-- Your banner image -->
    <div class="production-banner" style="background-color: <?php echo $banner_background_color; ?>;">
        <div class="production-thumbnail-2">
            <img src="<?php echo $image_src; ?>" alt="Banner">
        </div>
    </div>

    <div class="header-container">
        <div class="production-info">
            <div class="title-container">
                <div class="back-arrow">
                    <a href="http://localhost/wordpress/content/"> <!-- Change this -->
                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png" alt="Back to Productions">
                    </a>
                </div>
                <h1><?php echo $title; ?></h1>
            </div>

            <!-- Display the main text without splitting -->
            <div class="main-text">
                <?php echo $content_without_image; ?>
            </div>
        </div>
    </div>
    <?php
    }
}
?>

<?php
get_footer();
