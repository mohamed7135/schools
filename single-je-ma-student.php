<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package JE-MA
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) :
			?>
			
		<?php endif; ?>
	</header>

	<?php
	je_ma_post_thumbnail();
	?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'je-ma' ),
				'after'  => '</div>',
			)
		);
		$taxonomy_terms = get_the_terms( get_the_ID(), 'je-ma-student-category' );

		if ( $taxonomy_terms && ! is_wp_error( $taxonomy_terms ) ) {
			echo '<div class="taxonomy-terms">';
			echo '<h2>Other Students in this Category</h2>';

		
			$student_query = new WP_Query(
				array(
					'post_type'      => 'je-ma-student', 
					'tax_query'      => array(
						array(
							'taxonomy' => 'je-ma-student-category', 
							'field'    => 'id',
							'terms'    => wp_list_pluck( $taxonomy_terms, 'term_id' ),
						),
					),
					'posts_per_page' => -1,
				)
			);

			if ( $student_query->have_posts() ) :
				while ( $student_query->have_posts() ) :
					$student_query->the_post();
					?>
					<div class="other-student">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;

			echo '</div>';
		}
		?>
	</div>

<?php
get_sidebar();
get_footer();
