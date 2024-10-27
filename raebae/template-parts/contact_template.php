<?php

/**
 * Template Name: Contact
 */

$left_guy_array = get_field('left_guy');
$right_guy_array = get_field('right_guy');
// $left_guy = $left_guy_array['sizes']['large'];
$right_guy = $right_guy_array['sizes']['large'];


?>



<?php

get_header(); // Include the header.php file

?>

<script>
   const masthead = document.getElementById("masthead");
   masthead.classList.add("show"); 
</script>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
      

    <div class="contact_container" >
            <!-- <img class="left_guy" src=""> -->
                    <div class="contact_content" style=" max-width: 100%; width:75%; font-size: 25px;margin-left: 30px;" >
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
            <img class="right_guy" style="margin-right: 15%;" src="<?php echo $right_guy; ?>">
                <style>
        /* Set all input fields to have a max-width of 100% */
        input {
            max-width: 100%;
            box-sizing: border-box; /* Ensures padding and borders are included in the width */
        }
    </style>
    </div>



    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar(); // Include the sidebar.php file (if you have one)
get_footer(); // Include the footer.php file
?>