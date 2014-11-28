module.exports = function(config) {

	config.set({

		basePath: '../',
		frameworks: ['jasmine', 'requirejs'],

		files: [{
				pattern: 'app/js/*.js',
				included: false
			}, {
				pattern: 'app/js/**/*.js',
				included: false
			}, {
				pattern: 'test/unit.js',
				included: false
			}, {
				pattern: 'test/unit/*.js',
				included: false
			}, {
				pattern: 'test/unit/**/*.js',
				included: false
			}, {
				pattern: 'app/bower_components/**/*.js',
				included: false
			},
			'test/main-test.js'
		],

		autoWatch: true,

		LogLevel: config.LOG_DEBUG,

		browsers: ['PhantomJS'],

		junitReporter: {
			outputFile: 'test_out/unit.xml',
			suite: 'unit'
		}
	});
};