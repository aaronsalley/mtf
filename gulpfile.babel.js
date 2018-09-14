'use strict';

import browserSync from 'browser-sync';
import compiler from 'webpack';
import dotenv from 'dotenv';
import gulp from 'gulp';
import named from 'vinyl-named';
import path from 'path';
import webpack from 'webpack-stream';
import $ from 'gulp-load-plugins';

dotenv.config({
  path: path.resolve(__dirname, 'env/.env'),
});

import config from './gulp/config';

const serve = (done) => {
  browserSync.create();
  browserSync.init(config.server);

  gulp.watch(config.paths.BUILD + '/**/*').on('change', browserSync.reload);
  gulp.watch(config.paths.SOURCE + '/**/*.php', gulp.series(copy));
};

const bundle = (done) => {
  gulp.src(config.paths.SOURCE + '/**/*.php')
      .pipe(named())
      .pipe(webpack(config.webpack, compiler))
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};

const copy = (done) => {
  gulp.src([config.paths.SOURCE + '/**/*.php'], {base: config.paths.SOURCE})
      .pipe(gulp.dest(config.paths.BUILD));
  done();
};

gulp.task('default', gulp.series(bundle, copy, serve));
