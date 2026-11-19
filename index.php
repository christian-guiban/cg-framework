<?php get_header(); ?>
<main id="primary" class="site-main"><div class="gcf-container">
	<?php if ( have_posts() ) : ?>
		<header class="page-header"><h1><?php esc_html_e( 'Latest articles', 'cg-framework' ); ?></h1></header>
		<div class="gcf-post-grid">
		<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content', get_post_type() ); endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : get_template_part( 'template-parts/content', 'none' ); endif; ?>
</div></main>
<?php get_footer(); ?>
