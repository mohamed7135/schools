<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JE-MA
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		$terms = get_terms( 
			array(
				'taxonomy' => 'je-ma-student-category',
			) 
		);
		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
		$args = array(
			'post_type'      => 'je-ma-student',
			'posts_per_page' => -1,
			'orderby'        => 'title', 
        	'order'          => 'ASC',   
			'tax_query' 	 => array(
				array(
					'taxonomy' => 'je-ma-student-category',
					'field'    => 'slug',
					'terms'    => $term->slug,
				)
			),
		);
		
		$query = new WP_Query( $args );

		 if ( $query->have_posts() ) : 
		 ?>

			<header class="page-header">
				<h1>The Class</h1>			
			</header>

			<?php
			
			while ( $query->have_posts() ) :
				$query->the_post();
				?>

				<article>
					<a href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
					<?php the_post_thumbnail('medium', array('class' => 'student-thumbnail-class')); ?>

					</a>
					<?php the_excerpt(); ?>
					<?php $category_link = get_term_link($term); 
					echo '<section><p>Specialty: <a href="' . esc_url($category_link) . '">' . esc_html($term->name) . '</a></p>'; ?>
				</article>

				<?php
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

			wp_reset_postdata();
		endif;
		}
		}
		?>

	</main>

<?php
get_sidebar();
get_footer();
