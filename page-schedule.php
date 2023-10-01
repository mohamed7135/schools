<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JE-MA
 */

get_header();
?>

<main id="primary" class="site-main">
<?php
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
    
    <?php

    // check if the repeater field has rows of data
    if (have_rows('course_schedule')) :
    ?>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Course</th>
                    <th>Instructor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // loop through the rows of data
                while (have_rows('course_schedule')) : the_row();
                ?>
                    <tr>
                        <td><?php the_sub_field('date'); ?></td>
                        <td><?php the_sub_field('course'); ?></td>
                        <td><?php the_sub_field('instructor'); ?></td>
                    </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    <?php
    else :
        echo 'No course schedule available.'; // Display a message if there are no rows.
    endif;
    ?>

    

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
