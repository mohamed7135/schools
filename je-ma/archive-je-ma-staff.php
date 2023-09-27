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

	<header class="page-header">
			<?php
			post_type_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	
		<?php 
		$args = array(
			'post_type'      => 'je-ma-staff',
			'posts_per_page' => -1,
			'tax_query' 	 => array(
				array(
					'taxonomy' => 'je-ma-staff-category',
					'field'    => 'slug',
					'terms'    => 'administrative'
				)
			),
		);
		
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) {
			echo '<h2>'. esc_html__('Administrative') .'</h2>';
			echo '<section>';
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<article>
					<h3><?php the_title(); ?></h3>	
					<?php the_content(); ?>
					<?php
					$biography_content = get_field('biography');
					if ($biography_content) {
						echo $biography_content;
					}
					?>
				</article>
				<?php
			}
			wp_reset_postdata();
			echo '</section>';
		} 
		?>

		<?php 
		$args = array(
			'post_type'      => 'je-ma-staff',
			'posts_per_page' => -1,
			'tax_query' 	 => array(
				array(
					'taxonomy' => 'je-ma-staff-category',
					'field'    => 'slug',
					'terms'    => 'faculty'
				)
			),
		);
		
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) {
			echo '<h2>'. esc_html__('Faculty') .'</h2>';
			echo '<section>';
			while ( $query->have_posts() ) {
				$query->the_post();
		?>

		<article>
			<h3><?php the_title(); ?></h3>
			<?php

			$fields_to_display = array(
				'biography' => 'Biography',
				'courses' => 'Courses',
			);

			foreach ($fields_to_display as $field_name => $field_label) {
				$field_content = get_field($field_name);
				if ($field_content) {
					if ($field_name === 'biography') {
						echo $field_content;
					} elseif ($field_name === 'courses') {
						echo '<p>' . $field_label . ': ' . $field_content .'</p>';
					}
				}
			}

			$link = get_field('instructor-website');
			?>
			<div>
				<a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_attr($link['title']); ?></a>
			</div>
		</article>
		<?php
			}
			wp_reset_postdata();
			echo '</section>';
		} 
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
