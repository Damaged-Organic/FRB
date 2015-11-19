var gulp = require("gulp"),
	cfg = require("./frb.config"),

	glob = require("glob"),
	exec = require("child_process").exec,

	rename = require("gulp-rename"),
	notify = require("gulp-notify"),

	less = require("gulp-less"),
	CleanCSSPlugin = require("less-plugin-clean-css"),
	AutoprefixPlugin = require("less-plugin-autoprefix"),
	minifyCSS = require("gulp-minify-css"),
	concatCSS = require("gulp-concat-css"),

	imagemin = require("gulp-imagemin"),
	pngquant = require("imagemin-pngquant"),

	cleanCSS, autoprefix;

cleanCSS = new CleanCSSPlugin({ advanced: true });
autoprefix = new AutoprefixPlugin({ browsers: ["last 4 versions"] });


gulp.task("js", function(){

	var fileList = glob.sync(cfg.js + "app/*.js"),
		fileName = "",
		bundle;

	fileList.map(function(entryFile){
		fileName = entryFile.match(/\w+(?=\.js)/gi)[0];
		bundle = exec("jspm bundle-sfx "+ entryFile +" "+ cfg.build +"js/"+ fileName +".bundle.min.js --minify --skip-source-maps");
	});

});

gulp.task("templates", function(){

	gulp.src(cfg.js + "templates/**.hbs").pipe(gulp.dest(cfg.build + "js/templates/"));
});

gulp.task("css", function(){
	
	var fileList = glob.sync(cfg.css + "*.less"),
		fileName = "",
		bundle;

	fileList.map(function(entryFile){

		fileName = entryFile.match(/\w+(?=\.less)/gi)[0];

		return gulp.src(entryFile)
			.pipe(less({
				plugins: [cleanCSS, autoprefix]
			}))
			.pipe(concatCSS(fileName + ".less"))
			.pipe(minifyCSS({
				processImport: false
			}))
			.pipe(rename({
				basename: fileName,
				extname: ".bundle.min.css"
			}))
			.pipe(gulp.dest(cfg.build + "css/"))
			.pipe(notify({
				message: "css done",
				onLast: true
			}));
	});

});

gulp.task("fonts", function(){

	gulp.src(cfg.fonts + "**/*.*")
		.pipe(gulp.dest(cfg.build + "fonts/"))
		.pipe(notify({
			message: "fonts done",
			onLast: true
		}));

});

gulp.task("images", function(){
	
	gulp.src(cfg.images + "**/*.*")
		.pipe(imagemin({
			optimizationLevel: 4,
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest(cfg.build + "images/"));

});

gulp.task("watchers", function(){

	//gulp.watch(cfg.js + "**/*.js", ["js"]);
	//gulp.watch(cfg.js + "templates/**/*.hbs", ["templates"]);
	gulp.watch(cfg.css + "**/*.less", ["css"]);
	gulp.watch(cfg.fonts + "**/*.*", ["fonts"]);
	gulp.watch(cfg.images + "**/*.*", ["images"]);

});

gulp.task("default", ["css", "fonts", "images", "js"]);