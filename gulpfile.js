var gulp   = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var cssmin = require('gulp-cssmin');
var sass   = require('gulp-sass');
var image  = require('gulp-image');
var resize = require('gulp-image-resize');

gulp.task('js-site', function() {

  return gulp.src([
      'assets/js/src/jquery.js',
      'assets/js/src/site.js',
    ]) 
    .pipe(concat('site.js')) 
    .pipe(gulp.dest('assets/js'))
    .pipe(rename('site.min.js'))
    .pipe(uglify()) 
    .pipe(gulp.dest('assets/js'));

});

gulp.task('js-templates', function() {

  return gulp.src('assets/js/src/templates/*.js') 
    .pipe(uglify()) 
    .pipe(gulp.dest('assets/js/templates'));

});

gulp.task('css-site', function() {

  return gulp.src([
      'assets/scss/site.scss',
    ])
    .pipe(sass().on('error', sass.logError)) 
    .pipe(gulp.dest('assets/css'))
    .pipe(rename('site.min.css'))
    .pipe(cssmin()) 
    .pipe(gulp.dest('assets/css'));    

});

gulp.task('css-forum', function() {

  return gulp.src([
      'assets/scss/forum.scss',
    ])
    .pipe(sass().on('error', sass.logError)) 
    .pipe(gulp.dest('assets/css'))
    .pipe(rename('forum.min.css'))
    .pipe(cssmin()) 
    .pipe(gulp.dest('assets/css'));    

});


gulp.task('images', function() {
  gulp.src('assets/images/*')
    .pipe(image())
    .pipe(gulp.dest('assets/images'));
});

gulp.task('content', function() {
  gulp.src('content/**/*')
    .pipe(image())
    .pipe(gulp.dest('content'));
});

gulp.task('watch', function() {
  gulp.watch('assets/scss/**/*.scss', ['css-site', 'css-forum']);
  gulp.watch('assets/js/src/**/*.js', ['js-site', 'js-templates']);
});

gulp.task('default', [
  'css-site', 
  'css-forum', 
  'js-site',
  'js-templates', 
  'images'
]);