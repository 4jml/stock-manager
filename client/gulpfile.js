var gulp = require('gulp'),
	concat = require('gulp-concat'),
	rename = require('gulp-rename'),
	plumber = require('gulp-plumber'),
	less = require('gulp-less');

/**
 * AdminLTE
 */

gulp.task('adminLTE-css', function() {
	return gulp.src('css/src/main.less')
		.pipe(plumber())
		.pipe(less().on('error', function(e) { console.log(e); }))
		.pipe(rename('main.css'))
		.pipe(gulp.dest('css/dist'));
});

/**
 * Stock Manager
 */

gulp.task('javascripts', function() {
	gulp.src('js/src/**/*.js')
		.pipe(concat('app.js'))
		.pipe(gulp.dest('js/dist/'))
});


/**
 * Misc
 */

gulp.task('default', ['adminLTE-css' , 'javascripts']);

gulp.task('watch', function() {
	var watcher = gulp.watch([
		'css/src/*',
		'css/src/**/*',
		'js/src/*',
		'js/src/**/*'
	], ['default']);

	watcher.on('change', function(event) {
		console.log('File '+ event.path +' was '+ event.type +', running tasks...');
	});
});