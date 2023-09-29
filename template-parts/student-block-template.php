<?php
/**
 * Template Name: Student Block Template
 *
 * @package JE-MA
 */

get_header();
?>

<main id="primary" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
            <!-- Paragraph Block for Short Biography -->
            <p>Your short biography content goes here.</p>

            <!-- Button Block for Portfolio Link -->
            <a href="your-portfolio-link" class="button">Portfolio</a>
        </div>
    </article>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
