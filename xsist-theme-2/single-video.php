<?php
get_header(); 

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        
        // Get the post content
        $content = get_the_content();

        // Use a regular expression to find the YouTube video URL
        preg_match('/https:\/\/www\.youtube\.com\/watch\?v=[a-zA-Z0-9_-]+/', $content, $matches);

        // Get the YouTube video URL
        $youtube_url = $matches[0] ?? '';

        // Get the title
        $title = get_the_title();

        // Remove any <img> tags from the content
        $content_without_images = preg_replace('/<img[^>]+\>/i', '', $content);

        // Get the content excluding the YouTube video URL
        $content_without_video = str_replace($youtube_url, '', $content_without_images);

        // Get the background color from the custom field 'banner_background_color'
        $banner_background_color = get_post_meta(get_the_ID(), 'banner_background_color', true);
    ?> 
    
    <!-- Your banner with the video -->
    <div class="production-banner" style="background-color: <?php echo $banner_background_color; ?>;">
        <div class="production-thumbnail-2">
            <iframe width="560" height="315" src="<?php echo str_replace('watch?v=', 'embed/', $youtube_url); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <div class="header-container">
        <div class="production-info">
            <div class="title-container">
                <div class="back-arrow">
                    <a href="http://localhost/wordpress/content/"> <!-- Change this -->
                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.png" alt="Back to Videos">
                    </a>
                </div>
                <h1><?php echo $title; ?></h1>
            </div>

            <!-- Display the main text without splitting -->
            <div class="main-text">
                <?php echo $content_without_video; ?>
            </div>
        </div>
    </div>
    <?php
    }
}
?>

<?php
get_footer();
