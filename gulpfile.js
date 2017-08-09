var gulp = require('gulp');
var $    = require('gulp-load-plugins')();
var babel = require("gulp-babel");
var concat = require('gulp-concat');  
var rename = require('gulp-rename');  
var uglify = require('gulp-uglify');  

var sassPaths = [
  'bower_components/normalize.scss/sass',
  'bower_components/foundation-sites/scss',
  'bower_components/motion-ui/src',
  'bower_components/owl.carousel/src/scss'
];

gulp.task('sass', function() {
  return gulp.src('src/scss/style.scss')
    .pipe($.sass({
      includePaths: sassPaths,
      outputStyle: 'compressed' // if css compressed **file size**
    })
      .on('error', $.sass.logError))
    .pipe($.autoprefixer({
      browsers: ['last 2 versions', 'ie >= 9']
    }))
    .pipe(gulp.dest(''));
});

gulp.task('scripts', function() {
    return gulp.src([
    	'bower_components/foundation-sites/dist/js/plugins/foundation.core.js',
		'bower_components/foundation-sites/dist/js/plugins/foundation.util.mediaQuery.js',
		'bower_components/foundation-sites/dist/js/plugins/foundation.util.keyboard.js',
		'bower_components/foundation-sites/dist/js/plugins/foundation.util.box.js',
		'bower_components/foundation-sites/dist/js/plugins/foundation.util.nest.js',
		'bower_components/foundation-sites/dist/js/plugins/foundation.util.motion.js',
		'bower_components/foundation-sites/dist/js/plugins/foundation.dropdownMenu.js',
		'bower_components/foundation-sites/js/foundation.offcanvas.js',
		'bower_components/owl.carousel/dist/owl.carousel.js',
		'bower_components/colourBrightness.js/jquery.colourbrightness.js',
		'bower_components/isotope/dist/isotope.pkgd.js',
// 		'bower_components/background-check/background-check.js',
/*
		'bower_components/PerspectivePageViewNavigation/js/menu.js',
		'bower_components/PerspectivePageViewNavigation/js/classie.js',
*/
		'src/js/*.js'
		])
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('dist/js'))
        .pipe(rename('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist/js'));
});

gulp.task('default', ['sass'], function() {
  gulp.watch(['src/scss/**/*.scss', 'src/js/**/*.js'], ['sass', 'scripts']);
});