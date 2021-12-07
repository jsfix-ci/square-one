// webpack.mix.js
const pkg  = require( './package.json' );
const glob = require( 'glob' );
const path = require( 'path' );
const mix  = require( 'laravel-mix' );
mix.webpackConfig( {
	externals: {
		jquery: 'jQuery',
	},
} );

mix.options( {
	processCssUrls: false,
} );

mix.browserSync( 'squareone.tribe' );

mix.setPublicPath( 'wp-content/themes/core/assets' )
	.postCss( 'wp-content/themes/core/assets/css/src/theme/master.pcss', 'css/dist/theme/master.css' )
	.postCss( 'wp-content/themes/core/assets/css/src/theme/legacy.pcss', 'css/dist/theme/legacy.css' )
	.postCss( 'wp-content/themes/core/assets/css/src/theme/print.pcss', 'css/dist/theme/print.css' )
	.postCss( 'wp-content/themes/core/assets/css/src/admin/master.pcss', 'css/dist/admin/master.css' )
	.postCss( 'wp-content/themes/core/assets/css/src/admin/login.pcss', 'css/dist/admin/login.css' )
	.postCss( 'wp-content/themes/core/assets/css/src/admin/block-editor.pcss', 'css/dist/admin/block-editor.css' )
	.postCss( 'wp-content/themes/core/assets/css/src/admin/mce-editor.pcss', 'css/dist/admin/mce-editor.css' )

	.minify([
		'wp-content/themes/core/assets/css/dist/theme/master.css',
		'wp-content/themes/core/assets/css/dist/theme/legacy.css' ,
		'wp-content/themes/core/assets/css/dist/theme/print.css' ,
		'wp-content/themes/core/assets/css/dist/admin/master.css',
		'wp-content/themes/core/assets/css/dist/admin/login.css',
		'wp-content/themes/core/assets/css/dist/admin/block-editor.css',
		'wp-content/themes/core/assets/css/dist/admin/mce-editor.css'
	]);

// //mix.js( [ 'js/theme/theme.js' ], 'assets/dist/js/theme.js' );
