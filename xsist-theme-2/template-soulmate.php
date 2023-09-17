<?php
/**
 * Template Name: Soulmate
 */

// Define the URL path to the images folder
$folderUrl = get_template_directory_uri() . '/dating-images/';

// Get the physical path to the images folder
$folderPath = get_template_directory() . '/dating-images/';

// Get all the .png files from the folder
$images = glob($folderPath . '*.png');

if (!empty($images)) {
  // Pick a random image from the array
  $image = array_rand($images);

  // Set the URL to the chosen image
  $selectedImage = $folderUrl . '/' . basename($images[$image]);
} else {
  $selectedImage = ""; // Default image or error message if no images are found
}

?>

<div style="display: flex; justify-content: center; align-items: center; height: 100vh; max-height: 100%; background-color: #fafaf7; overflow: hidden;">
    <?php if ($selectedImage): ?>
        <img src="<?php echo $selectedImage; ?>" alt="Your Match" style="max-width: 100%; max-height: 100%; object-fit: contain;">
    <?php else: ?>
        <p>Sorry, no matches found!</p>
    <?php endif; ?>
</div>
