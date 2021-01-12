"use strict";

const { src } = require('gulp');
var gulp = require('gulp');
var plugins = require('gulp-load-plugins')({ camelize: true });
var browserSync	= require("browser-sync").create();

// Define project specific variables
var themePath = './wp-content/themes/americas_farmers/';
var dev_url = 'farmers.local';
var autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%']
};
var reportError = function (error) {
	notify({
		title: 'Compile Error in ' + error.plugin,
		message: error.toString()
	}).write(error);
}

function scripts() {
	return src(themePath + 'js/src/**/*.js')
	.pipe(plugins.sourcemaps.init())
	.pipe(plugins.babel({presets: ['env']}))
	.pipe(plugins.uglify())
	.pipe(plugins.concat('app.js'))
	.pipe(plugins.sourcemaps.write('.'))
	.pipe(gulp.dest(themePath + 'dist'))
	.on('error', reportError)
	.pipe(browserSync.stream());
}

function styles() {
	return src(themePath + 'scss/style.scss')
	.pipe(plugins.plumber({ errorHandler: reportError }))
	.pipe(plugins.sourcemaps.init())
	.pipe(plugins.sass())
	.pipe(plugins.autoprefixer(autoprefixerOptions))
	.pipe(plugins.sass())
	.pipe(plugins.sourcemaps.write())
	.pipe(gulp.dest(themePath))
	.on('error', reportError)
  	.pipe(browserSync.stream());
}

// create a task that ensures the `js` task is complete before
// reloading browsers
function jsWatch() {
	browserSync.reload()
	done();
}

function watch() {
	browserSync.init({
		proxy: dev_url,
		port: 4200
	});
	gulp.watch(themePath + 'scss/**/*.scss', styles);
	gulp.watch(themePath + '*.php').on('change', browserSync.reload);
	gulp.watch(themePath + 'js/**/*.js', scripts);
}

exports.default = gulp.series(styles, scripts, watch, jsWatch);