'use strict';

define([
	'angular',
	'filters',
	'services',
	'directives',
	'controllers',
	'angularRoute',
], function(angular, filters, services, directives, controllers) {

	return angular.module('App', [
		'ngRoute',
		'App.filters',
		'App.services',
		'App.directives',
		'App.controllers'
	]);
});