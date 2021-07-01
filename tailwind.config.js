module.exports = {
	purge: [
		'./wp-content/themes/core/src/**/*.pcss',
		'./wp-content/themes/core/**/*.php',
		`./wp-content/themes/core/assets/js/src/**/*.js`,
	],
	darkMode: false, // or 'media' or 'class'
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
