'use strict';

define(['angular'], function(angular) {

	angular.module('App.services', [])

	.value('version', '0.1')

	.factory('Login', ['$http', function ($http) {

		return {
			authenticate: function (email, password, success, error) {

				$http.post('http://localhost:8000/api/signin', {email:email, password:password})
					.success(success)
					.error(error);
			}
		};
	}]);
});