'use strict';

define(['angular', 'app'], function(angular, app) {

	return app.config([
		'$routeProvider',
		function($routeProvider) {

			$routeProvider

			.when('/view1', {
				templateUrl: 'views/partial1.html',
				controller: 'MyCtrl1'
			})

			.when('/view2', {
				templateUrl: 'views/partial2.html',
				controller: 'MyCtrl2'
			})

			.otherwise({
				redirectTo: '/view1'
			});
		}
	]);
});