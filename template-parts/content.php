<article <?php post_class( 'post-card' ); ?>>
	<a class="post-card__image" href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); } else { ?><span class="post-card__placeholder"></span><?php } ?></a>
	<div class="post-card__body"><p class="entry-meta"><?php gcf_posted_on(); ?></p><h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><div><?php the_excerpt(); ?></div></div>
</article>
