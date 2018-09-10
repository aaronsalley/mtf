'use strict';

import compiler from 'webpack';
import gulp from 'gulp';
import named from 'vinyl-named';
import webpack from 'webpack-stream';
import $ from 'gulp-load-plugins';

import config from './gulp/config';

const bundle = (done) => {
  gulp.src(config.paths.SOURCE + '/index.js')
    // .pipe($.env({
    //   file: '../env/env',
    // }))
    .pipe(named())
    .pipe(webpack(config.webpack, compiler))
    .pipe(gulp.dest(config.paths.BUILD));
  done();
}

gulp.task('default', gulp.series(bundle));
