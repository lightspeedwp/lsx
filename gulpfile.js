const gulp         = require('gulp');
const rtlcss       = require('gulp-rtlcss');
const sass         = require('gulp-sass');
const sourcemaps   = require('gulp-sourcemaps');
const jshint       = require('gulp-jshint');
//const concat       = require('gulp-concat');
const uglify       = require('gulp-uglify');
const sort         = require('gulp-sort');
const gettext      = require('gulp-gettext');
const plumber      = require('gulp-plumber');
const autoprefixer = require('gulp-autoprefixer');
const gutil        = require('gulp-util');
const rename       = require('gulp-rename');
//const minify       = require('gulp-minify-css');
const map          = require('map-stream');
const browserlist  = ['last 2 version', '> 1%'];

const errorreporter = map(function(file, cb) {
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

gulp.task('default', function() {
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp compile-css    to compile the scss to css');
	console.log('gulp compile-js     to compile the js to min.js');
	console.log('gulp watch          to continue watching the files for changes');
	console.log('gulp wordpress-lang to compile the lsx.pot, en_EN.po and en_EN.mo');
});

gulp.task('styles', gulp.series(function () {
	return gulp.src('assets/css/scss/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: ['assets/css/scss']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest('assets/css'))
}));

gulp.task('events-styles', gulp.series( function () {
    return gulp.src('assets/css/the-events-calendar/the-events-calendar.scss')
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['assets/css/the-events-calendar']
        }).on('error', gutil.log))
        .pipe(autoprefixer({
            browsers: browserlist,
            casacade: true
        }))
        .pipe(sourcemaps.write('maps'))
        .pipe(gulp.dest('assets/css/the-events-calendar'))
}));

gulp.task('events-styles-5', gulp.series(function () {
    return gulp.src('assets/css/the-events-calendar/the-events-calendar-5.scss')
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['assets/css/the-events-calendar']
        }).on('error', gutil.log))
        .pipe(autoprefixer({
            browsers: browserlist,
            casacade: true
        }))
        .pipe(sourcemaps.write('maps'))
        .pipe(gulp.dest('assets/css/the-events-calendar'))
}));

gulp.task('sensei-styles', gulp.series(function () {
    return gulp.src('assets/css/sensei/sensei.scss')
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['assets/css/sensei']
        }).on('error', gutil.log))
        .pipe(autoprefixer({
            browsers: browserlist,
            casacade: true
        }))
        .pipe(sourcemaps.write('maps'))
        .pipe(gulp.dest('assets/css/sensei'))
}));

gulp.task('popup-maker-styles', gulp.series(function () {
    return gulp.src('assets/css/popup-maker/popup-maker.scss')
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['assets/css/popup-maker']
        }).on('error', gutil.log))
        .pipe(autoprefixer({
            browsers: browserlist,
            casacade: true
        }))
        .pipe(sourcemaps.write('maps'))
        .pipe(gulp.dest('assets/css/popup-maker'))
}));

gulp.task('bbpress-styles', gulp.series(function () {
    return gulp.src('assets/css/bb-press/bb-press.scss')
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['assets/css/bb-press']
        }).on('error', gutil.log))
        .pipe(autoprefixer({
            browsers: browserlist,
            casacade: true
        }))
        .pipe(sourcemaps.write('maps'))
        .pipe(gulp.dest('assets/css/bb-press'))
}));

gulp.task('woocommerce-styles', gulp.series(function () {
    return gulp.src('assets/css/woocommerce/*.scss')
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: ['assets/css/woocommerce']
        }).on('error', gutil.log))
        .pipe(autoprefixer({
            browsers: browserlist,
            casacade: true
        }))
        .pipe(sourcemaps.write('maps'))
        .pipe(gulp.dest('assets/css/woocommerce'))
}));

gulp.task('styles-rtl', gulp.series(function () {
	return gulp.src('assets/css/scss/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: ['assets/css/scss']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(rtlcss())
		.pipe(rename({
			suffix: '-rtl'
		}))
		.pipe(gulp.dest('assets/css'))
}));

gulp.task('vendor-styles', gulp.series(function () {
	return gulp.src('assets/css/vendor/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: ['assets/css/vendor']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(gulp.dest('assets/css/vendor'))
}));

gulp.task('vendor-styles-rtl', gulp.series(function () {
	return gulp.src('assets/css/vendor/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: ['assets/css/vendor']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(rtlcss())
		.pipe(rename({
			suffix: '-rtl'
		}))
		.pipe(gulp.dest('assets/css/vendor'))
}));

gulp.task('admin-styles', gulp.series(function () {
	return gulp.src('assets/css/admin/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compact',
			includePaths: ['assets/css/admin']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest('assets/css/admin'))
}));

gulp.task('admin-styles-rtl', gulp.series(function () {
	return gulp.src('assets/css/admin/*.scss')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: ['assets/css/admin']
		}).on('error', gutil.log))
		.pipe(autoprefixer({
			browsers: browserlist,
			casacade: true
		}))
		.pipe(rtlcss())
		.pipe(rename({
			suffix: '-rtl'
		}))
		.pipe(gulp.dest('assets/css/admin'))
}));

//gulp.task('compile-css', ['styles', 'styles-rtl', 'vendor-styles', 'vendor-styles-rtl', 'admin-styles', 'admin-styles-rtl']);

gulp.task('compile-css', gulp.series( ['styles', 'styles-rtl', 'vendor-styles', 'vendor-styles-rtl', 'admin-styles', 'events-styles', 'events-styles-5', 'sensei-styles', 'popup-maker-styles', 'bbpress-styles', 'woocommerce-styles']));

gulp.task('js', gulp.series(function() {
	return gulp.src('assets/js/src/**/*.js')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(jshint())
		//.pipe(errorreporter)
		//.pipe(concat('lsx.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'))
}));

gulp.task('vendor-bootstrap-js', gulp.series(function() {
	return gulp.src('assets/js/vendor/bootstrap.js')
		.pipe(plumber({
			errorHandler: function(err) {
				console.log(err);
				this.emit('end');
			}
		}))
		.pipe(jshint())
		//.pipe(errorreporter)
		//.pipe(concat('bootstrap.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js/vendor'))
}));

gulp.task('compile-js', gulp.series(['js', 'vendor-bootstrap-js']));


//gulp.task('watch-css', function () {
//	return gulp.watch('assets/css/**/*.scss', ['compile-css']);
//});

//gulp.task('watch-js', function () {
//	return gulp.watch('assets/js/src/**/*.js', ['compile-js']);
//});

//gulp.task('watch', ['watch-css', 'watch-js']);
