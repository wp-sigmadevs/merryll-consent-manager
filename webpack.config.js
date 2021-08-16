/**
 * Webpack Configuration File
 *
 * @author S.M. Rafiz <https://github.com/smrafiz>
 * @package Merryll_Consent_Manager
 * @version 1.0.0
 */

const path = require('path');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const outputDir = path.resolve(__dirname, 'assets/js');

module.exports = {
	entry: {
		config: path.resolve(__dirname, './src/js/config.js'),
		'config.min': path.resolve(__dirname, './src/js/config.js')
		// admin: path.resolve(__dirname, './src/js/admin.js'),
		// 'admin.min': path.resolve(__dirname, './src/js/admin.js')
	},
	output: {
		path: outputDir,
		filename: '[name].js',
		sourceMapFilename: '[name].js.map'
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: [ '@babel/preset-env' ]
					}
				}
			}
		]
	},
	optimization: {
		minimize: true,
		minimizer: [
			new UglifyJsPlugin({
				include: /\.min\.js$/
			})
		]
	}
};
