<?php get_header(); ?>
<main id="primary" class="site-main"><div class="gcf-container gcf-container--narrow">
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'entry' ); ?>><header class="entry-header"><h1><?php the_title(); ?></h1><div class="entry-meta"><?php gcf_posted_on(); ?></div></header><?php gcf_post_thumbnail(); ?><div class="entry-content"><?php the_content(); wp_link_pages(); ?></div><?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?></article>
<?php endwhile; ?>
</div></main>
<?php get_footer(); ?>
