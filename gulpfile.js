var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('styles', function() {
    gulp.src('./app/resources/sass/**/*.sass')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/css/back/'));
});

gulp.task('default',function() {
    gulp.watch('./app/resources/sass/**/*.sass',['styles']);
});