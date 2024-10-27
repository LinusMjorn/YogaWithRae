<?php

/**
 * Template Name: Bookings
 */
?>



<?php

get_header(); // Include the header.php file

?>

<script>
   const masthead = document.getElementById("masthead");
   masthead.classList.add("show"); 
</script>

<?php
// get the custom fields

$right_friend_array = get_field('right_friend');
$right_friend = $right_friend_array['sizes']['large'];

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <div class= "booking_content">
            <div class="booking_content_child friend"> 
            <img class="right_friend" src="<?php echo $right_friend; ?>">
            </div>

            <div class="booking_content_child classes"> 

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
       </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar(); // Include the sidebar.php file (if you have one)
get_footer(); // Include the footer.php file
?>