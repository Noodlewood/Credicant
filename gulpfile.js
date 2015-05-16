var gulp = require('gulp');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var addsrc = require('gulp-add-src');
gulp.task('default', function() {
    return gulp.src('libs/vendor/jquery.js')
        .pipe(addsrc('libs/inheritance-2.7.js'))
        .pipe(addsrc('libs/Namespace.js'))
        .pipe(addsrc('libs/Observable.js'))
        .pipe(addsrc('libs/foundation.min.js'))
        .pipe(addsrc('js/**/*.js'))
        .pipe(uglify())
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest('dist'));
});