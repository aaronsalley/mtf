'use strict';

import browserSync from 'browser-sync';
import compiler from 'webpack';
import decomment from 'gulp-decomment';
import dotenv from 'dotenv';
import gulp from 'gulp';
import named from 'vinyl-named';
import path from 'path';
import webpack from 'webpack-stream';

import config from './gulp/config';

const serve = (done) => {
  browserSync.create();
  browserSync.init(config.server);

  gulp.watch(config.paths.BUILD + '/**/*').on('change', browserSync.reload);
  gulp.watch(config.paths.SOURCE + '/**/*.php', gulp.series(copyPhp));
};

const bundleWeb = (done) => {
  gulp.src(config.paths.SOURCE + '/**/*.php')
      .pipe(named())
      .pipe(webpack(config.webpack.web, compiler))
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const bundleApi = (done) => {
  gulp.src(config.paths.SOURCE + '/api/index.js')
      .pipe(named())
      .pipe(webpack(config.webpack.api, compiler))
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const bundleAll = [bundleWeb, bundleApi];

const copyPhp = (done) => {
  gulp.src([
    config.paths.SOURCE + '/**/*.php',
  ], {base: config.paths.SOURCE})
      .pipe(decomment.html())
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const copyFiles = (done) => {
  gulp.src([
    config.paths.SOURCE + '/**/screenshot.jpg',
  ], {base: config.paths.SOURCE})
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};
const copyAll = [copyPhp, copyFiles];

gulp.task('default', gulp.series(bundleAll, copyAll, serve));
