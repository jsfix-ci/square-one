<?php declare(strict_types=1);

use Tribe\Project\Templates\Components\pagination\single\Single_Pagination_Controller;
use Tribe\Project\Templates\Components\sidebar\Sidebar_Controller;
use Tribe\Project\Templates\Routes\single\Single_Controller;

$c = Single_Controller::factory();

get_header();
?>

	<main id="main-content">

		<article class="item-single">
			<?php get_template_part( 'components/header/subheader/subheader', 'single', $c->get_subheader_args() ); ?>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="item-single__featured-image">
					<?php get_template_part( 'components/image/image', null, $c->get_featured_image_args() ); ?>
				</div>
			<?php endif; ?>

			<div class="item-single__content s-sink t-sink l-sink l-sink--double">
				<?php
				if ( have_posts() ) {
					the_post();

					the_content(); // Block Content Only
				}
				?>
			</div>

			<div class="l-container">
				<?php get_template_part( 'components/footer/single_footer/single_footer', null, $c->get_single_footer_args() ); ?>
			</div>

			<?php // comments_template(); ?>

		</article>

		<div class="l-container">
			<?php get_template_part( 'components/pagination/single/single', null, [
					Single_Pagination_Controller::NEXT_LINK_LABEL     => esc_html__( 'Next article', 'tribe' ),
					Single_Pagination_Controller::PREVIOUS_LINK_LABEL => esc_html__( 'Previous article', 'tribe' ),
			]); ?>
		</div>

	</main>

<?php
do_action( 'get_sidebar', null );
get_template_part(
	'components/sidebar/sidebar',
	'single',
	[ Sidebar_Controller::SIDEBAR_ID => $c->sidebar_id ]
);
get_footer();
