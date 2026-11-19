<?php get_header(); ?>
<main id="primary" class="site-main"><div class="gcf-container">
<header class="page-header"><h1><?php the_archive_title(); ?></h1><?php the_archive_description( '<div class="archive-description">', '</div>' ); ?></header>
<?php if ( have_posts() ) : ?><div class="gcf-post-grid"><?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content', get_post_type() ); endwhile; ?></div><?php the_posts_pagination(); ?><?php else : get_template_part( 'template-parts/content', 'none' ); endif; ?>
</div></main>
<?php get_footer(); ?>
