'use strict';

require.config({
	paths: {
		angular: '../bower_components/angular/angular',
		angularRoute: '../bower_components/angular-route/angular-route',
		angularMocks: '../bower_components/angular-mocks/angular-mocks',
		text: '../bower_components/requirejs-text/text',
		'angular-mocks': '../bower_components/angular-mocks/angular-mocks',
		'angular-route': '../bower_components/angular-route/angular-route',
		'angular-scenario': '../bower_components/angular-scenario/angular-scenario',
		affix: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/affix',
		alert: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/alert',
		button: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/button',
		carousel: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/carousel',
		collapse: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/collapse',
		dropdown: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/dropdown',
		tab: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tab',
		transition: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/transition',
		scrollspy: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/scrollspy',
		modal: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/modal',
		tooltip: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tooltip',
		popover: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/popover',
		'requirejs-text': '../bower_components/requirejs-text/text'
	},
	shim: {
		angular: {
			exports: 'angular'
		},
		angularRoute: [
			'angular'
		],
		angularMocks: {
			deps: [
				'angular'
			],
			exports: 'angular.mock'
		}
	},
	priority: [
		'angular'
	],
	packages: [

	]
});

window.name = "NG_DEFER_BOOTSTRAP!";

require([
	'angular',
	'app',
	'routes'
], function(angular, app, routes) {

	var $html = angular.element(document.getElementsByTagName('html')[0]);

	angular.element().ready(function() {
		angular.resumeBootstrap([app.name]);
	});
});