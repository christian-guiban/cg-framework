<?php get_header(); ?>
<main id="primary" class="site-main"><div class="gcf-container gcf-container--narrow">
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'entry' ); ?>><header class="entry-header"><h1><?php the_title(); ?></h1></header><div class="entry-content"><?php the_content(); wp_link_pages(); ?></div></article>
<?php endwhile; ?>
</div></main>
<?php get_footer(); ?>
