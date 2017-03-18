"use strict";

var gulp = require('gulp'),
	watch = require('gulp-watch'),
	babel = require('gulp-babel'),
	include = require("gulp-include"),
	prefixer = require('gulp-autoprefixer'),
	uglify = require('gulp-uglify'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	imagemin = require('gulp-imagemin'),
	pngquant = require('imagemin-pngquant'),
	rimraf = require('rimraf'),
	browserSync = require("browser-sync"),
	notify = require('gulp-notify'),
	argv = require('yargs').argv,
	$if = require('gulp-if'),
	ftp = require( 'vinyl-ftp' ),
	sftp = require('gulp-sftp'),
	reload = browserSync.reload;

// Check for --production flag
var isProduction = !!(argv.production);

var path = {
	build: {
		js: 'assets/js/',
		css: 'assets/css/',
		img: 'assets/img/',
		fonts: 'assets/fonts/'
	},
	src: {
		js: '_src/js/app.js',
		jsfolder: '_src/js/',
		style: '_src/style/app.scss',
		img: '_src/img/**/*.*',
		fonts: '_src/fonts/**/*.*'
	},
	watch: {
		js: '_src/js/**/*.js',
		style: '_src/style/**/*.*',
		img: '_src/img/**/*.*',
		fonts: '_src/fonts/**/*.*'
	},
	clean: './assets',
	foundation: './node_modules/foundation-sites/',
	motionui: './node_modules/motion-ui/src',
	whatinput: './node_modules/what-input/dist/',
	slick: './node_modules/slick-carousel/slick',
	jquery: './node_modules/jquery/dist/',
	sourcemaps: '../sourcemaps'
};

// Enter URL of your local server here
// Example: 'http://localwebsite.dev'
var URL = 'http://projects.beetroot.se/academy/2017/poltava/alexcss/funrock/';

var ftpConfig =  {
	type: 		'sftp',
    host:     	'projects.beetroot.se',
    user: 		'beetroot_academy',
    port:		2222,
    password: 	'academy_beetroot',
    parallel: 	10,
    remote_path: '/2017/poltava/alexcss/funrock/test'
};

const globs = [
        '**/*.*',
        '!node_modules',
        '!node_modules/**',
        '!_src',
        '!_src/**'
    ];

var config = {
	files: ['**/*.php', 'assets/images/**/*.{png,jpg,gif}'],
	tunnel: false,
	host: 'localhost',
	port: 9000,
	logPrefix: "Beetroot_Academy",
	proxy: URL
};

gulp.task('webserver', function () {
	browserSync(config);
});

gulp.task('clean', function (cb) {
	rimraf(path.clean, cb);
});

gulp.task( 'deploy', function () {

	if (config.type == 'ftp') {
	        //  FTP version
	        const conn = ftp.create( {
	            host:     ftpConfig.host,
	            user:     ftpConfig.user,
	            password: ftpConfig.password,
	            port:     ftpConfig.port,
	            parallel: 10,
	            reload:   true,
	            debug:    function(d){console.log(d);},
	            log:      gutil.log
	        });
	        return gulp.src( globs, { base: '.', buffer: false } )
	            .pipe( conn.newer( ftpConfig.remote_path ) ) // only upload newer files
	            .pipe( conn.dest( ftpConfig.remote_path ) );
	    } else {
	        // SFTP version
	        const conn = sftp({
	                host: ftpConfig.host,
	                user: ftpConfig.user,
	                pass: ftpConfig.password,
	                port: ftpConfig.port,
	                remotePath: ftpConfig.remote_path,
	                timeout: 50000
	            });
	        return gulp.src(globs, { base: '.', buffer: false } )
	            .pipe(conn);
	    }

} );

gulp.task('js:build', function () {
	gulp.src(path.src.js)
		.pipe(sourcemaps.init())
		.pipe(include({
				extensions: "js",
				hardFail: true,
				includePaths: [path.slick, path.foundation + '/js', path.whatinput, path.jquery, path.src.jsfolder]
			}).on('error', notify.onError(
					{
						message: "<%= error.message %>",
						title  : "JS Error!"
					}
				)
			)
		)
		.pipe(
			$if(isProduction, babel({"presets": ["es2015"]}))
		)
		.pipe(
			$if(isProduction,
				uglify().on('error', notify.onError(
						{
							message: "<%= error.message %>",
							title  : "JS Error!"
						}
					)
				)
			)
		)
		.pipe(
			$if(!isProduction, sourcemaps.write(path.sourcemaps))
		)
		.pipe(gulp.dest(path.build.js))
		.pipe(notify({ message: 'JS task complete', sound: false, onLast: true }))
		.pipe(reload({stream: true}));
});

gulp.task('style:build', function () {
	gulp.src(path.src.style)
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed',
			precision: 8,
			//sourceMap: true,
			//errLogToConsole: true
			includePaths: [path.foundation + '/scss', path.motionui, path.slick],
		}).on( 'error', notify.onError(
				{
					message: "<%= error.message %>",
					title  : "Sass Error!"
				}
			)
		))
		.pipe(prefixer())
		.pipe(
			$if(!isProduction, sourcemaps.write(path.sourcemaps))
		)
		// .pipe(cssmin())
		.pipe(gulp.dest(path.build.css))
		.pipe(notify({ message: 'Styles task complete', sound: false, onLast: true }))
		.pipe(reload({stream: true}));
});

gulp.task('image:build', function () {
	gulp.src(path.src.img)
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()],
			interlaced: true
		}))
		.pipe(gulp.dest(path.build.img))
		.pipe(reload({stream: true}));
});

gulp.task('fonts:build', function() {
	gulp.src(path.src.fonts)
		.pipe(gulp.dest(path.build.fonts))
});

gulp.task('build', [
	'style:build',
	'js:build',
	'image:build',
	'fonts:build'
]);


gulp.task('watch', function(){
	watch(path.watch.style, function(event, cb) {
		gulp.start('style:build');
	});
	watch(path.watch.js, function(event, cb) {
		gulp.start('js:build');
	});
	watch(path.watch.img, function(event, cb) {
		gulp.start('image:build');
	});
	watch(path.watch.fonts, function(event, cb) {
		gulp.start('fonts:build');
	});
});


gulp.task('default', ['build', 'webserver', 'watch']);
