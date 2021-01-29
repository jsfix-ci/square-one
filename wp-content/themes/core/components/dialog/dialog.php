<?php
declare( strict_types=1 );

use Tribe\Project\Templates\Components\dialog\Dialog_Controller;

/*
* Component: Dialog
*
* Description: A component that adds a Dialog to the page and allows for custom content to be placed inside
*
* Requirements: 
* - An external button that has a data-js attribute of dialog-trigger
* - The external button also needs a data-content attribute of 'dialog-content-" + a unique id
* - The unique ID will also be passed to this dialog component
* EX: Button_Controller::ATTRS => [ 'data-js'  => 'dialog-trigger', 'data-content' => 'dialog-content-' . $this->get_block_id() ]
* EX: Dialog_Controller::ID  => $this->get_block_id(),
*/

/**
 * @var array $args Arguments passed to the template
 */
// phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
$c         = Dialog_Controller::factory( $args );
$content   = $c->get_content();

if ( empty( $content ) ) {
	return;
}
?>

<script data-js="dialog-content-<?php echo $c->get_dialog_id(); ?>" type="text/template">
    <div class="c-dialog">
        <div class="c-dialog__overlay">
            <div class="c-dialog__header">
                <div class="c-dialog__title"><?php echo $c->get_dialog_title(); ?></div>
            </div>
            <div class="c-dialog__overlay-inner">
                <div class="c-dialog__content-wrapper">
                    <div class="c-dialog__content-inner">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
