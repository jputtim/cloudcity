'use strict';

define(['angular', 'services'], function(angular) {

	return angular.module('App.controllers', ['App.services'])

	.controller('MyCtrl1', ['$scope', 'version',
		function($scope, version) {
			$scope.scopedAppVersion = version;
		}
	])

	.controller('MyCtrl2', [
		'$scope', 
		'$injector',
		function($scope, $injector) {
			
			require(['controllers/myctrl2'], function(myctrl2) {

				$injector.invoke(myctrl2, this, {
					'$scope': $scope
				});
			});
		}
	])

	// Login
	.controller('LoginCtrl', ['$scope', 'Login',
		function($scope, Login) {

			$scope.email = 'admin@cc.com';
			$scope.password = 123456;

			$scope.authenticate = function () {
				
				Login.authenticate($scope.email, $scope.password, function (success) {
					if (success) {
						alert('success');
					};
				});
			};
				
		}
	]);
});