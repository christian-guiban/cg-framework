<?php get_header(); ?>
<main id="primary" class="site-main"><div class="gcf-container gcf-container--narrow"><h1><?php esc_html_e( 'Page not found', 'cg-framework' ); ?></h1><p><?php esc_html_e( 'The page may have moved or no longer exists.', 'cg-framework' ); ?></p><?php get_search_form(); ?><a class="gcf-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to homepage', 'cg-framework' ); ?></a></div></main>
<?php get_footer(); ?>
