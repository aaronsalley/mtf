'use strict';

import gulp from 'gulp';
import autoprefixer from 'autoprefixer';
import plugins from 'gulp-load-plugins';

const $ = plugins();

gulp.task('styles:frontend', function(){
  return gulp.src(['./src/assets/styles/*.scss'])
    .pipe($.sourcemaps.init())
    .pipe($.concat('style.css'))
    .pipe($.sass({
      outputStyle: 'nested', // nested, expanded, compact, compressed
      precison: 3,
      errLogToConsole: true,
      includePaths: [
          'node_modules/foundation-sites/scss',
          'src/assets/fonts'
      ]
    }))
      .on('error', $.sass.logError)
    .pipe($.postcss([
      autoprefixer({
        browsers: [
          'last 2 versions',
          'ie >= 9',
          'ios >= 7'
        ]
      })
    ]))
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./_build'));
});

gulp.task('styles', gulp.parallel('styles:frontend'));