<?php

get_header(); // Include the header.php file
?>

<?php

/**
 * Template Name: Front Page
 */

$image_id = get_field('background_image');
$overlay_logo_array = get_field('overlay_logo');
$img = wp_get_attachment_image_url($image_id,'full');
$overlay_logo = $overlay_logo_array['sizes']['large'];
$about_rae_text = get_field('about_rae');

?>


<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="hero_container">
            <img class="hero_image" id="hero_img" src="<?php echo $img; ?>">
            <img class="overlay_logo" src="<?php echo $overlay_logo; ?>">

            <div class="container overlay_logo">
        	<div class="field">
                <a href="#scrollTo">
		           <div class="scroll"></div>
                </a>
	        </div>
        </div>
            
        </div>


        <div class="about_box">
            <p class="about_text" id="scrollTo">
            <?php echo $about_rae_text; ?>
            </p>
        </div>    

        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                // Display the page content
                the_content();
            endwhile;
        else :
            // If no content, include the "No posts found" template
            get_template_part('template-parts/content', 'none');
        endif;



        ?>

<script defer>
window.addEventListener('load', function() {
    const hero_image = document.getElementById("hero_img");
    let img_height = hero_image.height;

    let unit = img_height;
    console.log(unit);

    const masthead = document.getElementById("masthead");

    // Single scroll event listener to handle both cases
    window.addEventListener('scroll', function() {
        if (window.scrollY > unit) {
            masthead.classList.add("show");  // Add 'show' to slide the navbar down
        } else {
            masthead.classList.remove("show");  // Remove 'show' to slide the navbar back up
        }
    });
});
</script>


    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar(); // Include the sidebar.php file (if you have one)
get_footer(); // Include the footer.php file
?>