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
                    <a href="http://localhost/wordpress/events/"> <!-- Change this -->
                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png" alt="Back to Productions">
                    </a>
                </div>
                <h1><?php echo $title; ?></h1>
            </div>
            <?php
            // Split the content by '*'
            $content_parts = explode('*', $content_without_image);

            // Get the status and remove leading/trailing whitespace
            $status = trim($content_parts[1]);

            // Get the main body of text and remove leading/trailing whitespace
            $main_text = isset($content_parts[2]) ? trim($content_parts[2]) : '';
            
            // Determine the status class
            $status_class = strtolower($status) === 'concluded' ? 'status-concluded' : 'status-upcoming';
            ?>

            <p class="<?php echo $status_class; ?>"><?php echo $status; ?></p>

            <div class="main-text">
                <?php echo $main_text; ?>
            </div>
        </div>
    </div>
    <?php
    }
}
?>

<?php
get_footer();

    