'use strict';

import gulp from 'gulp';
import plugins from 'gulp-load-plugins';
import named from 'vinyl-named';
import webpack from 'webpack';
import webpackStream from 'webpack-stream';

const $ = plugins();

let webpackConfig = {
  module: {
    rules: [
      {
        test: /\.ts?$/,
        use: ['ts-loader'],
        exclude: /node_modules/
      }
    ]
  },
  resolve: {
    extensions: [ '.ts', '.js' ]
  }
}

gulp.task('scripts:vendor', function(){
  return gulp.src(['./src/assets/scripts/*.js'])
    .pipe(named())
    .pipe($.sourcemaps.init())
    .pipe($.concat('vendors.js'))
    .pipe(webpackStream(webpackConfig, webpack))
    .pipe($.uglify()
      .on('error', e => { console.log(e); })
    )
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('./_build/assets/js/'));
});

gulp.task('scripts', gulp.parallel('scripts:vendor'));