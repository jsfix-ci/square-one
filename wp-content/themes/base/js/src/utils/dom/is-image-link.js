/**
 * @function
 * @description Check is a url string passed in is an image link
 */

let is_image_url = ( url = '' ) => {

	let ext = url.split( '.' ).pop();
	let test = ext.toLowerCase().match(/(jpg|jpeg|png|gif)/g);
    return test && test.length > 0;
};

export default is_image_url;