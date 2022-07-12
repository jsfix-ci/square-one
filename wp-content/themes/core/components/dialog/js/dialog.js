/**
 * @module
 * @description JavaScript that drives Dialog
 */

import * as tools from 'utils/tools';
import { trigger } from 'utils/events';

const el = {
	triggers: tools.getNodes( 'dialog-trigger', true, document, false ),
};

const instances = {
	dialogs: {},
};

const initDialogs = () => {
	// Need to check for multiple trigger buttons
	el.triggers.forEach( ( openButton ) => {
		const dialogId = openButton.getAttribute( 'data-dialog' );
		// If this has multiple triggers, skip creating a new instance after the first one.
		if ( instances.dialogs[ dialogId ] ) {
			return;
		}

		const Dialog = instances.dialogs[ dialogId ] = document.getElementById( dialogId );
		const closeButton = Dialog.querySelector( '[data-js="dialog-close-button"]' );

		// Setup event listeners
		openButton.addEventListener( 'click', () => {
			Dialog.showModal();

			trigger( { event: 'modern_tribe/component_dialog_rendered', native: false } );
		} );

		closeButton.addEventListener( 'click', () => {
			Dialog.close();

			trigger( { event: 'modern_tribe/component_dialog_closed', native: false } );
		} );
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

	console.info( 'SquareOne Theme : Initialized dialog scripts.' );
};

export default init;
