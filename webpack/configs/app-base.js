/**
 * External Dependencies
 */
const path = require( 'path' );
const webpack = require( 'webpack' );

/**
 * Internal Dependencies
 */
const localConfig = require( './local' );

const devServerConfig = {
	port: 9000,
	hot: true,
	host: localConfig.proxy,
	headers: {
		'Access-Control-Allow-Origin': '*',
	},
};

if ( localConfig.protocol === 'https' ) {
	devServerConfig.server = {
		type: 'https',
		options: {
			key: `${ localConfig.certs_path }/${ localConfig.proxy }.key`,
			cert: `${ localConfig.certs_path }/${ localConfig.proxy }.crt`,
		},
	};
}

module.exports = {
	resolve: {
		extensions: [ '.js', '.jsx', '.json', '.pcss' ],
	},
	resolveLoader: {
		modules: [ path.resolve( `${ __dirname }/../../`, 'node_modules' ) ],
	},
	devtool: 'eval-source-map',
	devServer: devServerConfig,
	plugins: [
		new webpack.IgnorePlugin( {
			resourceRegExp: /^\.\/locale$/,
			contextRegExp: /moment$/,
		} ),
		new webpack.LoaderOptionsPlugin( {
			debug: true,
		} ),
	],
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: [ /node_modules\/(?!(swiper|dom7)\/).*/ ],
				use: [
					{
						loader: 'babel-loader',
					},
				],
			},
			{
				test: /\.p?css$/,
				use: [
					'style-loader',
					{
						loader: 'css-loader',
						options: {
							modules: {
								localIdentName: '[name]__[local]___[hash:base64:5]',
							},
							importLoaders: 1,
						},
					},
					'postcss-loader',
				],
			},
			{
				test: /\.css$/,
				include: /node_modules/,
				use: [ 'style-loader', 'css-loader' ],
			},
		],
	},
	optimization: {
		concatenateModules: true, //ModuleConcatenationPlugin
		moduleIds: 'deterministic',
	},
};
