'use strict';

import gulp from 'gulp';
import del from 'del';
import plugins from 'gulp-load-plugins';
import webpack from 'webpack';
import webpackStream from 'webpack-stream';

const $ = plugins();

// Remove the existing build folder
gulp.task('clean', function(done){
  del.sync('./_build', done());
});

// Copy all images to build
gulp.task('copy:images', function(done){
  gulp.src([
      './src/assets/images/*'
    ])
    .pipe(gulp.dest('./_build/assets/img'));
  done();
});

gulp.task('copy', gulp.parallel('copy:images'));