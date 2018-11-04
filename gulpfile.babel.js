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
  gulp.watch(config.paths.SOURCE + '/**/*.(php|html)', gulp.series(copyHtml));
  gulp.watch(config.paths.SOURCE + '/**/assets/*', gulp.series(copyFiles));
};

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

gulp.task('build', gulp.series(bundleAll, copyAll));
gulp.task('default', gulp.series(bundleAll, copyAll, serve));
