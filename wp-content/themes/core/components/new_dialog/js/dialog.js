/**
 * @module
 * @description JavaScript that drives Dialog
 */

import A11yDialog from 'mt-a11y-dialog';
import * as tools from 'utils/tools';
import { trigger } from 'utils/events';

const el = {
	triggers: tools.getNodes( 'new-dialog-trigger', true, document, false ),
};

const instances = {
	dialogs: {},
};

const initDialogs = () => {
	// Need to check for multiple trigger buttons
	el.triggers.forEach( ( btn ) => {
		const dialogId = btn.getAttribute( 'data-content' );
		// If this has multiple triggers, skip creating a new instance after the first one.
		if ( instances.dialogs[ dialogId ] ) {
			return;
		}

		const Dialog = instances.dialogs[ dialogId ] = document.getElementById( dialogId );

		// Setup event listeners
		btn.addEventListener( 'click', ( e ) => {
			console.log( e.target );
			Dialog.showModal();
		} );

		// // This function will initialize the swiper slider when the dialog loads if it's not already initialized.
		// instances.dialogs[ dialogId ].on( 'show', function() {
		// 	trigger( { event: 'modern_tribe/component_dialog_rendered', native: false } );
		// } );
	} );
};

/**
 * @function init
 * @description Kick off this modules functions.
 */

const init = () => {
	if ( ! el.triggers.length ) {
		return;
	}

	initDialogs();

	console.info( 'SquareOne Theme : Initialized new dialog scripts.' );
};

export default init;
