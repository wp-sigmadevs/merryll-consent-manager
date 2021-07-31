/**
 * Gulp Configuration File
 *
 * @author S.M. Rafiz <https://github.com/smrafiz>
 * @package Merryll_Consent_Manager
 * @version 1.0.0
 */

module.exports = {
	projectName: 'merryll-consent-manager',
	projectURL: 'http://wpcookies.test/',
	productURL: './',
	browserAutoOpen: false,
	injectChanges: true,

	// Style options.
	styleSRC: './src/scss/frontend.scss',
	styleAdminSRC: './src/scss/admin.scss',
	styleDestination: './assets/css/',
	styleAdminDestination: './assets/css/',
	outputStyle: 'expanded',
	errLogToConsole: true,
	precision: 10,

	// JS Custom options.
	jsCustomSRC: './src/js/*.js',
	jsCustomDestination: './assets/js/',
	jsCustomFile: 'frontend',

	// Images options.
	imgSRC: './src/images/**/*.{png,jpg,gif}',
	imgDST: './assets/images/',

	// Build options
	build: './dist/',
	buildVendorSRC: 'vendor/**',
	buildVendorDest: './dist/vendor',
	buildInclude: [
		// include common file types
		'**/*.php',
		'**/*.html',
		'**/*.css',
		'**/*.js',
		'**/*.svg',
		'**/*.png',
		'**/*.jpg',
		'**/*.gif',
		'**/*.ttf',
		'**/*.otf',
		'**/*.eot',
		'**/*.woff',
		'**/*.woff2',
		'**/*.pot',
		'LICENSE.txt',
		'README.txt',
		'**/*/installed.json',
		'**/*/LICENSE',
		'**/*/composer.json',
		'**/*/*.mo',
		'**/*/*.po',
		'**/*/*.scss',

		// exclude files and folders
		'!**/.*',
		'!node_modules/**/*',
		'!dist/**/*',
		'!merryll.config.js',
		'!gulpfile.js',
		'!src/images/**/*',
		'!src/scripts/**/*',
		'!src/styles/**/*',
		'!vendor/htmlburger/carbon-fields/bin/**/*',
		'!vendor/htmlburger/carbon-fields/composer.json',
		'!vendor/htmlburger/carbon-fields/webpack.config.js',
		'!vendor/htmlburger/carbon-fields/assets/**/*'
	],
	buildFinalZip: './dist/',

	// Watch files paths.
	watchStyles: './src/scss/**/*.scss',
	watchJsCustom: './src/js/**/*.js',
	watchPhp: './**/*.php',

	// Translation options.
	textDomain: 'merryll-consent-manager',
	translationFile: 'merryll-consent-manager.pot',
	translationDestination: './languages',
	packageName: 'merryll Consent Manager',
	bugReport: 'https://github.com/wp-sigmadevs/merryll-consent-manager/issues',
	lastTranslator: 'S.M. Rafiz <srafiz@sigmadevs.com>',
	team: 'Sigma Devs <srafiz@sigmadevs.net>',

	// Browsers for autoprefixing.
	BROWSERS_LIST: [
		'last 10 version',
		'> 1%',
		'ie >= 11',
		'last 6 Android versions',
		'last 10 ChromeAndroid versions',
		'last 10 Chrome versions',
		'last 10 Firefox versions',
		'last 10 Safari versions',
		'last 10 iOS versions',
		'last 10 Edge versions',
		'last 10 Opera versions'
	]
};
