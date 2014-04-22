var gulp = require('gulp'),
	rename = require('gulp-rename'),
	plumber = require('gulp-plumber'),
	less = require('gulp-less');

/**
 * AdminLTE
 */

gulp.task('adminLTE-css', function() {
	return gulp.src('node_modules/AdminLTE/less/AdminLTE.less')
		.pipe(plumber())
		.pipe(less().on('error', function(e) { console.log(e); }))
		.pipe(rename('main.css'))
		.pipe(gulp.dest('css/dist'));
});

/**
 * Stock Manager
 */

gulp.task('html-sources', function() {
	
})

/**
 * Misc
 */

gulp.task('default', ['adminLTE-css']);

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