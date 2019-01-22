'use strict';

import compiler from 'webpack';
import decomment from 'gulp-decomment';
import dotenv from 'dotenv';
import gulp from 'gulp';
import named from 'vinyl-named';
import path from 'path';
import webpack from 'webpack-stream';

import config from './webpack.config.js';

const bundleWeb = (done) => {
  gulp.src(config.paths.SOURCE + '/**/*.php')
      .pipe(named())
      .pipe(webpack(config.webpack.web, compiler))
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const bundleApi = (done) => {
  gulp.src(config.paths.SOURCE + '/react/config/server.ts')
      .pipe(named())
      .pipe(webpack(config.webpack.api, compiler))
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const bundleAll = [bundleWeb, bundleApi];

const copyHtml = (done) => {
  gulp.src([
    config.paths.SOURCE + '/**/*.php',
    config.paths.SOURCE + '/**/templates/*',
  ])
      .pipe(decomment.html())
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const copyFiles = (done) => {
  gulp.src([
    config.paths.SOURCE + '/**/screenshot.jpg',
    config.paths.SOURCE + '/**/fonts/**/*',
  ])
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const copyAll = [copyHtml, copyFiles];

gulp.task('dev:web', gulp.series(bundleWeb, copyAll));
gulp.task('default', gulp.series(bundleAll, copyAll));
