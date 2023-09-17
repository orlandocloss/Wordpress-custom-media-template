<?php
/**
 * Template Name: Events
 */
get_header('inner');?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // WP_Query arguments
        $args = array(
            'post_type'      => 'event',
            'posts_per_page' => -1,
        );

        // The Query
        $query = new WP_Query($args);

        // The Loop
        if ($query->have_posts()) {
            echo '<div class="production-container">'; // Moved this line outside the while loop
            while ($query->have_posts()) {
                $query->the_post();

                // Get the post content
                $content = get_the_content();

                // Use a regular expression to find the first <img> tag
                preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);

                // Get the first image src
                $image_src = $matches[1][0] ?? '';

                // Get the status (concluded or upcoming)
                preg_match('/\*(.+?)\*/', $content, $matches);
                $status = strtolower(trim($matches[1] ?? ''));
                $status_class = $status === 'concluded' ? 'status-concluded' : ($status === 'upcoming' ? 'status-upcoming' : '');

                echo '<div class="production-link">';
                echo '<a href="' . get_permalink() . '">';

                echo '<div class="production-content">'; // Wrap the thumbnail and title overlay in a div

                // Check if an image was found
                if (!empty($image_src)) {
                    // Display the image
                    echo '<img class="production-thumbnail" src="' . $image_src . '" alt="">';
                }

                echo '<div class="title-overlay">';
                echo '<div>' . get_the_title() . '</div>'; // Display the title
                if (!empty($status_class)) {
                    echo '<div class="' . $status_class . '">' . ucfirst($status) . '</div>'; // Display the status
                }
                echo '</div>'; // Close the title-overlay div

                echo '</div>'; // Close the production-content div
                echo '</a>';
                echo '</div>';
            }
            echo '</div>'; // Close the production-container div. Moved this line outside the while loop
        } else {
            // No posts found
            echo 'No productions found.';
        }

        // Restore original Post Data
        wp_reset_postdata();
    
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
