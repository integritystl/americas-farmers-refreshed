const { src } = require('gulp');
var gulp = require('gulp');
var plugins = require('gulp-load-plugins')({ camelize: true });

var themePath = './wp-content/themes/americas_farmers/';

function scripts() {
	return src(themePath + 'js/src/**/*.js')
	.pipe(plugins.sourcemaps.init())
	.pipe(plugins.babel({presets: ['env']}))
	.pipe(plugins.uglify())
	.pipe(plugins.concat('app.js'))
	.pipe(plugins.sourcemaps.write('.'))
	.pipe(gulp.dest(themePath + 'dist'));
}

function styles() {
	return src(themePath + 'scss/style.scss')
	.pipe(plugins.sourcemaps.init())
	.pipe(plugins.sass())
	.pipe(plugins.autoprefixer('last 2 versions', '> 5%'))
	.pipe(plugins.sass())
	.pipe(plugins.sourcemaps.write())
	.pipe(gulp.dest(themePath));
}

function watch() {
	gulp.watch(themePath + 'scss/**/*.scss', styles);
	gulp.watch(themePath + 'js/**/*.js', scripts);
}

exports.default = gulp.series(styles, scripts, watch);