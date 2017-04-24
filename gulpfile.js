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
var sourceMaps = require('gulp-sourcemaps');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sort = require('gulp-sort');
var wppot = require('gulp-wp-pot');
var gettext = require('gulp-gettext');
var plumber = require('gulp-plumber');
var autoPrefixer = require('gulp-autoprefixer');
var gutil = require('gulp-util');
var rename = require('gulp-rename');
var minify = require('gulp-minify-css');
var map = require('map-stream');

var browserList = ['last 2 version', '> 1%'];

var errorReporter = map(function(file, cb) {
	if (file.jshint.success) {
		return cb(null, file);
	}

	console.log('JSHINT fail in', file.path);

	file.jshint.results.forEach(function (result) {
		if (!result.error) {
			return;
		}

		const err = result.error
		console.log(`  line ${err.line}, col ${err.character}, code ${err.code}, ${err.reason}`);
	});

	cb(null, file);
});

gulp.task('styles', function () {
    return gulp.src(['assets/css/scss/*.scss'])
        .pipe(plumber({ errorHandler: function(err) { console.log(err); this.emit('end'); } }))
        .pipe(sourceMaps.init())
        .pipe(sass({ errLogToConsole: true, includePaths: ['assets/css/scss'] }))
        .pipe(autoPrefixer({ browsers: browserList, casacade: true }))
        .on('error', gutil.log)
        .pipe(sourceMaps.write('maps'))
        .pipe(gulp.dest('assets/css'))
});

gulp.task('vendor-styles', function () {
    return gulp.src(['assets/css/vendor/*.scss'])
        .pipe(plumber({ errorHandler: function(err) { console.log(err); this.emit('end'); } }))
        .pipe(sass({ errLogToConsole: true, includePaths: ['assets/css/vendor'] }))
        .pipe(autoPrefixer({ browsers: browserList, casacade: true }))
        .pipe(minify())
        .pipe(rename({ suffix: '.min' }))
        .on('error', gutil.log)
        .pipe(gulp.dest('assets/css/vendor'))
});

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

gulp.task('compile-css', ['styles', 'vendor-styles']);

gulp.task('js', function() {
	gulp.src('assets/js/src/lsx.js')
        .pipe(jshint())
		.pipe(errorReporter)
		.pipe(concat('lsx.min.js'))
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
