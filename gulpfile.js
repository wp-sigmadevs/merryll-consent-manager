/**
 * Gulp file.
 *
 * @author S.M. Rafiz <https://github.com/smrafiz>
 * @package Merryll_Consent_Manager
 * @version 1.0.0
 */

/**
 * Load custom merryll Configuration.
 *
 */
const config = require('./merryll.config.js');

/**
  * Load Plugins.
  *
  * Load gulp plugins and passing them in semantic names.
  */
const gulp = require('gulp');

// CSS related plugins.
const sass = require('gulp-sass')(require('sass'));
const minifycss = require('gulp-uglifycss');
const autoprefixer = require('gulp-autoprefixer');
const mmq = require('gulp-merge-media-queries');
const beautify = require('gulp-cssbeautify');

// JS related plugins.
const concat = require('gulp-concat');
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const webpackConfig = require('./webpack.config.js');

// Image related plugins.
const imagemin = require('gulp-imagemin');

// Utility related plugins.
const rename = require('gulp-rename');
const lineec = require('gulp-line-ending-corrector');
const filter = require('gulp-filter');
const sourcemaps = require('gulp-sourcemaps');
const notify = require('gulp-notify');
const browserSync = require('browser-sync').create();
const wpPot = require('gulp-wp-pot');
const sort = require('gulp-sort');
const cache = require('gulp-cache');
const remember = require('gulp-remember');
const plumber = require('gulp-plumber');
const newer = require('gulp-newer');
const del = require('del');
const beep = require('beepbeep');

// Build related plugins
const zip = require('gulp-zip');

/**
  * Custom Error Handler.
  *
  * @param Mixed err
  */
const errorHandler = (r) => {
	notify.onError('❌  ===> ERROR: <%= error.message %>')(r);
	beep();
};

/**
  * Task: `browser-sync`.
  *
  * Live Reloads, CSS injections, Localhost tunneling.
  * @link http://www.browsersync.io/docs/options/
  *
  * @param {Mixed} done Done.
  */
const browsersync = (done) => {
	browserSync.init({
		proxy: config.projectURL,
		open: config.browserAutoOpen,
		injectChanges: config.injectChanges,
		watchEvents: [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ]
	});
	done();
};

// Helper function to allow browser reload with Gulp 4.
const reload = (done) => {
	browserSync.reload();
	done();
};

/**
  * Task: `styles`.
  *
  * Compiles Sass, Autoprefixes it and Minifies CSS.
  *
  */
gulp.task('styles', () => {
	return gulp
		.src(config.styleSRC, { allowEmpty: true })
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on('error', sass.logError)
		.pipe(autoprefixer(config.BROWSERS_LIST))
		.pipe(lineec())
		.pipe(beautify())
		.pipe(sourcemaps.write({ includeContent: true }))
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(config.styleDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss({ maxLineLen: 10 }))
		.pipe(lineec())
		.pipe(gulp.dest(config.styleDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(notify({ message: '✅  \n===> Frontend Styles — completed!', onLast: true }));
});

/**
  * Task: `buildStyles`.
  *
  * Compiles Sass, Autoprefixes it and Minifies CSS.
  *
  */
gulp.task('buildStyles', () => {
	return gulp
		.src(config.styleSRC, { allowEmpty: true })
		.pipe(plumber(errorHandler))
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on('error', sass.logError)
		.pipe(autoprefixer(config.BROWSERS_LIST))
		.pipe(lineec())
		.pipe(mmq({ log: true })) // Merge Media Queries
		.pipe(beautify())
		.pipe(gulp.dest(config.styleDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss({ maxLineLen: 10 }))
		.pipe(lineec())
		.pipe(gulp.dest(config.styleDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(notify({ message: '✅  \n===> Frontend Build Styles — completed!', onLast: true }));
});

/**
  * Task: `admin`.
  *
  * Compiles Sass, Autoprefixes it and Minifies CSS.
  *
  */
gulp.task('admin', () => {
	return gulp
		.src(config.styleAdminSRC, { allowEmpty: true })
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on('error', sass.logError)
		.pipe(autoprefixer(config.BROWSERS_LIST))
		.pipe(lineec())
		.pipe(beautify())
		.pipe(sourcemaps.write({ includeContent: true }))
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(config.styleAdminDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss({ maxLineLen: 10 }))
		.pipe(lineec())
		.pipe(gulp.dest(config.styleAdminDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(notify({ message: '✅  \n===> Admin Styles — completed!', onLast: true }));
});

/**
  * Task: `buildAdmin`.
  *
  * Compiles Sass, Autoprefixes it and Minifies CSS.
  *
  */
gulp.task('buildAdmin', () => {
	return gulp
		.src(config.styleAdminSRC, { allowEmpty: true })
		.pipe(plumber(errorHandler))
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on('error', sass.logError)
		.pipe(autoprefixer(config.BROWSERS_LIST))
		.pipe(lineec())
		.pipe(mmq({ log: true })) // Merge Media Queries
		.pipe(beautify())
		.pipe(gulp.dest(config.styleAdminDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss({ maxLineLen: 10 }))
		.pipe(lineec())
		.pipe(gulp.dest(config.styleAdminDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		.pipe(notify({ message: '✅  \n===> Admin Build Styles — completed!', onLast: true }));
});

/**
 * Task: `customJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 */
gulp.task('customJS', () => {
	return gulp
		.src(config.jsCustomSRC, { since: gulp.lastRun('customJS') })
		.pipe(plumber(errorHandler))
		.pipe(remember(config.jsCustomSRC))
		.pipe(concat(config.jsCustomFile + '.js'))
		.pipe(webpackStream(webpackConfig), webpack)
		.pipe(lineec())
		.pipe(gulp.dest(config.jsCustomDestination))
		.pipe(notify({ message: '✅  \n===> CUSTOM JS — completed!', onLast: true }));
});

/**
  * Task: `images`.
  *
  * Minifies PNG, JPEG, GIF and SVG images.
  *
  */
gulp.task('images', () => {
	return (
		del('./src/images/**/*.db'),
		gulp
			.src(config.imgSRC)
			.pipe(newer(config.imgSRC))
			.pipe(
				cache(
					imagemin(
						[
							imagemin.gifsicle({ interlaced: true }),
							imagemin.jpegtran({ progressive: true }),
							imagemin.optipng({ optimizationLevel: 3 }), // 0-7 low-high.
							imagemin.svgo({
								plugins: [ { removeViewBox: true }, { cleanupIDs: false } ]
							})
						],
						{
							verbose: true
						}
					)
				)
			)
			.pipe(gulp.dest(config.imgDST))
			.pipe(notify({ message: '✅  ===> Images Optimization — completed!', onLast: true }))
	);
});

/**
  * Task: `clear-images-cache`.
  *
  * Deletes the images cache. By running the next "images" task,
  * each image will be regenerated.
  */
gulp.task('clearCache', function(done) {
	return cache.clearAll(done);
});

/**
  * WP POT Translation File Generator.
  *
  */
gulp.task('translate', () => {
	return gulp
		.src(config.watchPhp)
		.pipe(sort())
		.pipe(
			wpPot({
				domain: config.textDomain,
				package: config.packageName,
				bugReport: config.bugReport,
				lastTranslator: config.lastTranslator,
				team: config.team
			})
		)
		.pipe(gulp.dest(config.translationDestination + '/' + config.translationFile))
		.pipe(notify({ message: '✅  \n===> WP Translation — completed!', onLast: true }));
});

/**
  * Watch Tasks.
  *
  * Watches for file changes and runs specific tasks.
  */
gulp.task(
	'run',
	gulp.parallel('styles', 'admin', 'customJS', 'images', browsersync, () => {
		gulp.watch(config.watchPhp, reload);
		gulp.watch(config.watchStyles, gulp.parallel('styles'));
		gulp.watch(config.watchStyles, gulp.parallel('admin'));
		gulp.watch(config.watchJsCustom, gulp.series('customJS', reload));
		gulp.watch(config.imgSRC, gulp.series('images', reload));
	})
);

/**
  * Clean Task.
  *
  * Delete files and folders
  */
gulp.task('clean', () => {
	return del(config.build + '**/*');
});

/**
  * Build files Task.
  *
  * Build files and folders in the dist directory
  */
gulp.task('buildFiles', () => {
	return gulp
		.src(config.buildInclude)
		.pipe(gulp.dest(config.build + config.projectName + '/'))
		.pipe(notify({ message: '✅  Copy from buildFiles complete', onLast: true }));
});

/**
  * Build Zip Task.
  *
  * Build Zip from the Build directory in dist
  */
gulp.task('buildZip', () => {
	return gulp
		.src(config.build + '/**/*')
		.pipe(zip(config.projectName + '.zip'))
		.pipe(gulp.dest(config.buildFinalZip))
		.pipe(notify({ message: '✅  Zip task complete', onLast: true }));
});

/**
  * Build files from scratch Task.
  *
  * Build production file from the dist directory in root
  */
gulp.task(
	'buildDist',
	gulp.series(
		'clean',
		'buildStyles',
		'buildAdmin',
		'customJS',
		'images',
		'translate',
		'buildFiles',
		'buildZip',
		function(done) {
			done();
		}
	)
);
