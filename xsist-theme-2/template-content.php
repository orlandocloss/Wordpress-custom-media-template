<?php
/**
 * Template Name: Content Page
 */
get_header('inner'); ?>


<div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php
    // Array of your Pod names
    $pods = array('poem', 'video');

    // Custom labels for display
    $labels = array(
        'poem' => 'Poems',
        'video' => 'Videos',
    );

    foreach ($pods as $pod_name) {
        // Display the Pod container
        echo '<div class="pod-container">';

        // Display the Pod title and a horizontal line
        echo '<div class="pod-title-container">';
        echo '<h2 class="pod-title">' . $labels[$pod_name] . '</h2>';
        echo '</div>';
        echo '<hr class="hr-line">'; // Horizontal line

        // Create a new div to hold the post links
        echo '<div class="post-link-container">';

        // WP_Query arguments
        $args = array(
            'post_type'      => $pod_name,
            'posts_per_page' => -1,
        );

        // The Query
        $query = new WP_Query($args);

        // The Loop
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                // Get the post content
                $content = get_the_content();

                // Use a regular expression to find the first <img> tag
                preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);

                // Get the first image src
                $image_src = $matches[1][0] ?? '';

                // Display a link to each post with padding, along with the post thumbnail
                echo '<div class="post-link">';
                echo '<a href="' . get_permalink() . '">';

                echo '<div class="post-content">'; // Wrap the thumbnail and title overlay in a div with padding

                // Check if an image was found
                if (!empty($image_src)) {
                    // Display the image
                    echo '<img class="post-thumbnail" src="' . $image_src . '" alt="">';
                }

                echo '<div class="title-overlay">' . get_the_title() . '</div>'; // Display the title overlay
                echo '</div>'; // Close the post-content div

                echo '</a>';
                echo '</div>';
            }
        } else {
            // No posts found
            echo 'No posts found for ' . $labels[$pod_name];
        }

        // Close the new div
        echo '</div>';

        // Close the Pod container
        echo '</div>';

        // Restore original Post Data
        wp_reset_postdata();
    }
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
