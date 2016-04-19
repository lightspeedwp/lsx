var gulp = require('gulp');
var sass = require('gulp-sass');
var del = require('del');

gulp.task('default', function() {	 
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css			to compile the style.scss to style.css');
	console.log('gulp compile-js			to compile the custom.js to custom.min.js');
	console.log('gulp watch					to continue watching the files for changes.');
	console.log('gulp upgrade-components	recopy over the node_module files.');
});

/*   UPGRADE THE COMPONENTS WE USE	*/
gulp.task('clean-upgrade', function(cb) {
    del(['sass/bootstrap/*','js/vendor/bootstrap.min.js','js/vendor/jquery.sticky.js'], cb);
});

gulp.task('bootstrap-upgrade', function() {
	gulp.src('node_modules/bootstrap-sass/assets/stylesheets/**/*').pipe(gulp.dest('sass/bootstrap/').on('error', function (err) {console.log('Error!', err);}));
	gulp.src('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js').pipe(gulp.dest('js/vendor/').on('error', function (err) {console.log('Error!', err);}));
	console.log('Bootstrap Files copied over');
});

gulp.task('jquery-sticky-upgrade', function() {
	gulp.src('node_modules/jquery-sticky/jquery.sticky.js').pipe(gulp.dest('js/vendor/').on('error', function (err) {console.log('Error!', err);}));
	console.log('jQuery Sticky copied over');
});

gulp.task('upgrade-components', ['clean-upgrade'], function() {
    gulp.start('bootstrap-upgrade');
	gulp.start('jquery-sticky-upgrade');
});

gulp.task('compile-css', function() {	
	gulp.src('sass/app.scss')
  		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
 	 	.pipe(gulp.dest('css/'));
});

gulp.task('watch', function() {	 
	gulp.watch('sass/app.scss', ['compile-css']);	 
});