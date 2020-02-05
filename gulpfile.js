var gulp        = require('gulp');
var browserSync = require('browser-sync');
var reload      = browserSync.reload;
var sass        = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var concat      = require('gulp-concat');
var sourcemaps  = require('gulp-sourcemaps');
var postcss = require('gulp-postcss');
var pxtoviewport = require('postcss-px-to-viewport');
var notify = require('gulp-notify');

// browser-sync task for starting the server.
gulp.task('browser-sync', function() {
  //watch files
  var files = [
  './sass/*.scss',
  './*.php',
  './*/*.php'
  ];

  //initialize browsersync
  browserSync.init(files, {
  //browsersync with a php server
  proxy: "localhost/contactform_brandwise",
  notify: true
  });
});
 
// Sass task, will run when any SCSS files change & BrowserSync
// will auto-update browsers
gulp.task('sass', function () {

  var processors = [
    pxtoviewport({
        viewportWidth: 1920,
        viewportUnit: 'vw',
    })
  ];
  
  return gulp.src([
      'sass/main.scss',
      'sass/wp-core.scss',
      'sass/*.scss'
    ])
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(autoprefixer({
      grid: "autoplace",
      flexbox: true
    }))
    .pipe(concat('styles.css'))
    .pipe(postcss(processors))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('./css'))
    .pipe(reload({stream:true}))
    .pipe(notify({ message: '\n\n✅  ===> Compilation completed!\n', onLast: true }));
});
 
// Default task to be run with `gulp`
gulp.task('default', ['sass', 'browser-sync'], function () {
  gulp.watch("sass/**/*.scss", ['sass']);
});