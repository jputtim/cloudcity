'use strict';

define(['angular', 'services'], function(angular, services) {

	angular.module('App.directives', ['App.services'])

	.directive('appVersion', [
		'version',
		function(version) {

			return function(scope, elm, attrs) {
				elm.text(version);
			};
		}
	]);
});