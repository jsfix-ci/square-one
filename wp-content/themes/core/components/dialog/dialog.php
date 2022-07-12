<?php declare(strict_types=1);

use Tribe\Project\Templates\Components\dialog\Dialog_Controller;

/*
* Component: Dialog
*
* Description: A component that adds a Dialog to the page and allows for custom content to be placed inside
*
* Requirements:
* - An external button that has a data-js attribute of dialog-trigger
* - The external button also needs a data-dialog attribute of 'dialog-" + a unique id
* - The unique ID will also be passed to this dialog component
* EX: Button_Controller::ATTRS => [ 'data-js'  => 'dialog-trigger', 'data-dialog' => 'dialog-' . $this->get_block_id() ]
* EX: Dialog_Controller::ID  => $this->get_block_id(),
*
*/

/**
 * @var array $args Arguments passed to the template
 */
$c       = Dialog_Controller::factory( $args );
$content = $c->get_content();

if ( empty( $content ) ) {
	return;
}
?>

<dialog
	id="dialog-<?php echo $c->get_dialog_id(); ?>"
	<?php echo $c->get_dialog_classes(); ?>
	<?php echo $c->get_dialog_attributes(); ?>
>
	<button data-js="dialog-close-button" class="icon icon-close c-dialog__close-button" type="button">
		<?php _e( 'Close this dialog window', 'tribe' ); ?>
	</button>
	<div <?php echo $c->get_overlay_classes(); ?> <?php echo $c->get_overlay_attributes(); ?>>
		<?php echo $c->get_header(); ?>
		<div <?php echo $c->get_content_wrapper_classes(); ?> <?php echo $c->get_content_wrapper_attributes(); ?>>
			<div <?php echo $c->get_content_classes(); ?> <?php echo $c->get_content_attributes(); ?>>
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</dialog>
