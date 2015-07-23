var gulp = require('gulp');
var sass = require('gulp-sass');
var del = require('del');


/*   UPGRADE THE COMPONENTS WE USE	*/
gulp.task('clean-upgrade', function(cb) {
    del(['css/bootstrap/*.*','js/bootstrap.min.js'], cb);
});

gulp.task('bootstrap-upgrade', function() {
	gulp.src('components/bower/sass-bootstrap/lib/*.*').pipe(gulp.dest('sass/bootstrap/').on('error', function (err) {console.log('Error!', err);}));
	gulp.src('components/bower/sass-bootstrap/dist/js/bootstrap.min.js').pipe(gulp.dest('js/vendor/').on('error', function (err) {console.log('Error!', err);}));
	console.log('Bootstrap Files copied over');
});

gulp.task('upgrade-components', ['clean-upgrade'], function() {
    gulp.start('bootstrap-upgrade');
});




gulp.task('compile-sass', function() {	
	gulp.src('sass/app.scss')
  		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
 	 	.pipe(gulp.dest('css/'));
});