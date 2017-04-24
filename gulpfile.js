var gulp = require('gulp');

gulp.task('default', function() {
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css    to compile the scss to css');
	console.log('gulp compile-js     to compile the js to min.js');
	console.log('gulp watch          to continue watching the files for changes');
	console.log('gulp wordpress-lang to compile the lsx.pot, en_EN.po and en_EN.mo');
});

var sass = require('gulp-sass');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sort = require('gulp-sort');
var wppot = require('gulp-wp-pot');
var gettext = require('gulp-gettext');

gulp.task('sass', function() {
	gulp.src(['sass/app.scss', 'sass/alegreya_open_sans.scss', 'sass/noto_sans_noto_sans.scss', 'sass/noto_serif_noto_sans.scss', 'sass/raleway_open_sans.scss', 'sass/medium-nav-break.scss'])
		.pipe(sass().on('error', function(err) { console.log('Error!', err); }))
		.pipe(gulp.dest('css/'));
});

gulp.task('sass-woocommerce', function() {
	gulp.src(['sass/woocommerce/woocommerce-layout.scss', 'sass/woocommerce/woocommerce-smallscreen.scss', 'sass/woocommerce/woocommerce.scss'])
		.pipe(sass().on('error', function(err) { console.log('Error!', err); }))
		.pipe(gulp.dest('css/'));
});

gulp.task('sass-sensei', function() {
	gulp.src('sass/sensei/frontend/sensei.scss')
		.pipe(sass().on('error', function(err) { console.log('Error!', err); }))
		.pipe(gulp.dest('css/'));
});

gulp.task('sass-events-calendar', function() {
	gulp.src('sass/the-events-calendar.scss')
		.pipe(sass().on('error', function(err) { console.log('Error!', err); }))
		.pipe(gulp.dest('css/'));
});

gulp.task('sass-job-manager', function() {
	gulp.src('sass/wp-job-manager.scss')
		.pipe(sass().on('error', function(err) { console.log('Error!', err); }))
		.pipe(gulp.dest('css/'));
});

gulp.task('sass-admin-welcome', function() {
	gulp.src('sass/admin/welcome-screen/welcome.scss')
		.pipe(sass().on('error', function(err) { console.log('Error!', err); }))
		.pipe(gulp.dest('css/admin/welcome-screen/'));
});

gulp.task('compile-css', ['sass','sass-woocommerce','sass-sensei','sass-events-calendar','sass-job-manager','sass-admin-welcome']);

gulp.task('js', function() {
	gulp.src('assets/js/lsx-script.js')
		.pipe(jshint())
		.pipe(jshint.reporter('fail'))
		.pipe(concat('lsx-script.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'));
});
 
gulp.task('compile-js', ['js']);

/*
gulp.task('watch', function() {
	// @TODO
});
*/

gulp.task('wordpress-pot', function() {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'lsx',
			package: 'lsx',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages/lsx.pot'));
});

gulp.task('wordpress-po', function() {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'lsx',
			package: 'lsx',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages/en_EN.po'));
});

gulp.task('wordpress-po-mo', ['wordpress-po'], function() {
	return gulp.src('languages/en_EN.po')
		.pipe(gettext())
		.pipe(gulp.dest('languages'));
});

gulp.task('wordpress-lang', (['wordpress-pot', 'wordpress-po-mo']));
