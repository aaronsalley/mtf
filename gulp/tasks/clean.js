'use strict';

import del from 'del';
import gulp from 'gulp';

import config from '../config';

const clean = {}
clean.build = (done) => {
  del(config.paths.BUILD);
  done();
}
clean.docs = (done) => {
  del(config.paths.DOCS);
  done();
}
gulp.task('clean:build', clean.build);
gulp.task('clean:docs', clean.docs);
gulp.task('clean:all', gulp.parallel('clean:build', 'clean:docs'));
