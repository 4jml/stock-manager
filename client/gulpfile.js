var gulp = require('gulp'),
	concat = require('gulp-concat'),
	rename = require('gulp-rename'),
	plumber = require('gulp-plumber'),
	symlink = require('gulp-symlink'),
	less = require('gulp-less');

/**
 * Assets
 */

gulp.task('assets-css', function() {
	return gulp.src('src/css/main.less')
		.pipe(plumber())
		.pipe(less().on('error', function(e) { console.log(e); }))
		.pipe(rename('main.css'))
		.pipe(gulp.dest('dist/assets/css'));
});

gulp.task('assets-js', function() {
	return gulp.src('src/js/**/*.js')
		.pipe(concat('app.js'))
		.pipe(gulp.dest('dist/assets/js'));
});

gulp.task('assets-link', function() {
	return gulp.src('dist/assets')
		.pipe(symlink('../server/public'));
});

gulp.task('assets', ['assets-css', 'assets-js', 'assets-link']);

/**
 * Vendors
 */

gulp.task('vendors', function() {
	return gulp.src('vendor')
		.pipe(symlink('../server/public'));
});

/**
 * Misc
 */

gulp.task('default', ['assets', 'vendors']);

gulp.task('watch', function() {
	var watcher = gulp.watch(['src/**/*'], ['default']);

	watcher.on('change', function(event) {
		console.log('File '+ event.path +' was '+ event.type +', running tasks...');
	});
});