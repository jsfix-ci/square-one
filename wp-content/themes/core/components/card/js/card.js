/** -----------------------------------------------------------------------------
 *
 * Component: Card
 *
 * Scripts specific to the card component.
 *
 * ----------------------------------------------------------------------------- */

import * as tools from 'utils/tools';

const el = {
	cards: tools.getNodes( '.c-card', true, document, true ),
};

/**
 * handleCardClick
 *
 * Finds the relevant target link and triggers location change to that URL.
 *
 * @param e
 */
const handleCardClick = ( e ) => {
	const card = e.currentTarget;
	const targetLinkEl = card.querySelector( '[data-js="target-link"]' );
	const selectedText = window.getSelection().toString();

	if ( selectedText ) {
		return;
	}

	if ( targetLinkEl && targetLinkEl.hasAttribute( 'href' ) ) {
		targetLinkEl.click();
	}
};

/**
 * @param linkEl
 * @description Prevents bubbling from handleCardClick on nested elements with the class "clickable".
 */
const stopPropagation = ( linkEl ) => {
	linkEl.addEventListener( 'click', ( e ) => e.stopPropagation() );
};

/**
 * bindEvents
 */
const bindEvents = () => {
	el.cards.forEach( card => {
		card.addEventListener( 'click', handleCardClick );

		const nestedLinks = tools.getNodes( '.clickable', true, card, true );
		nestedLinks.forEach( link => stopPropagation( link ) );
	} );
};

/**
 * init
 */
const init = () => {
	if ( el.cards.length === 0 ) {
		return;
	}

	bindEvents();

	console.info( 'SquareOne Theme: Initialized card component scripts.' );
};

export default init;
