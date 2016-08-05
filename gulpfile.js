var gulp = require('gulp');
var sass = require('gulp-sass');
var del = require('del');
var cleanCSS = require('gulp-clean-css');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sort = require('gulp-sort');
var wppot = require('gulp-wp-pot');
var gettext = require('gulp-gettext');

gulp.task('default', function() {	 
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css			to compile the style.scss to style.css');
	console.log('gulp compile-js			to compile the custom.js to custom.min.js');
	console.log('gulp watch					to continue watching the files for changes.');
	console.log('gulp upgrade-components	recopy over the node_module files.');
	console.log('gulp wordpress-pot			to compile the lsx-mega-menus.pot');
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


gulp.task('compile-css', ['compile-css-theme','compile-css-amp','compile-css-woocommerce','compile-css-sensei','compile-css-events-calendar','compile-css-job-manager']);

gulp.task('compile-css-theme', function() {	
	gulp.src(['sass/app.scss', 'sass/alegreya_open_sans.scss', 'sass/noto_sans_noto_sans.scss', 'sass/noto_serif_noto_sans.scss', 'sass/raleway_open_sans.scss', 'sass/medium-nav-break.scss'])
		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
		.pipe(cleanCSS())
		.pipe(gulp.dest('css/'));
});

gulp.task('compile-css-amp', function() {	
	gulp.src('sass/amp.scss')
		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
		.pipe(cleanCSS())
		.pipe(gulp.dest('css/'));
});

gulp.task('compile-css-woocommerce', function() {	
	gulp.src('sass/woocommerce/woocommerce.scss')
		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
		.pipe(cleanCSS())
		.pipe(gulp.dest('css/'));
});

gulp.task('compile-css-sensei', function() {	
	gulp.src('sass/sensei/frontend/sensei.scss')
		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
		.pipe(cleanCSS())
		.pipe(gulp.dest('css/'));
});

gulp.task('compile-css-events-calendar', function() {	
	gulp.src('sass/the-events-calendar.scss')
		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
		.pipe(cleanCSS())
		.pipe(gulp.dest('css/'));
});

gulp.task('compile-css-job-manager', function() {	
	gulp.src('sass/wp-job-manager.scss')
		.pipe( sass().on('error', function (err) {console.log('Error!', err);}) )
		.pipe(cleanCSS())
		.pipe(gulp.dest('css/'));
});

gulp.task('compile-js-theme', function () {
	gulp.src('js/lsx-script.js')	 
	//.pipe(jshint())	 
	//.pipe(jshint.reporter('fail'))	 
	.pipe(concat('lsx-script.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('js')); 
});

gulp.task('watch', function() {	 
	gulp.watch('sass/app.scss', ['compile-css-theme']);
	gulp.watch('sass/amp.scss', ['compile-css-amp']);
	gulp.watch('sass/woocommerce/woocommerce.scss', ['compile-css-woocommerce']);
	gulp.watch('sass/sensei/frontend/sensei.scss', ['compile-css-sensei']);
	gulp.watch('sass/the-events-calendar.scss', ['compile-css-events-calendar']);
	gulp.watch('sass/wp-job-manager.scss', ['compile-css-job-manager']);
});

gulp.task('wordpress-pot', function () {
	gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'lsx',
			destFile: 'lsx.pot',
			package: 'lsx',
			bugReport: 'https://github.com/lightspeeddevelopment/lsx/issues',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages'));

	gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'lsx',
			destFile: 'en_EN.po',
			package: 'lsx',
			bugReport: 'https://github.com/lightspeeddevelopment/lsx/issues',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages'));

	gulp.src('languages/en_EN.po')
		.pipe(gettext())
		.pipe(gulp.dest('languages'));
});