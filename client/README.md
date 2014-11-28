# About

This is a fork of [Angular Seed](https://github.com/tnajdek/angular-requirejs-seed) but with changes needed for Grunt support.

* AngularJS 1.2.18
* RequireJS 2.1.14
* Full support for unit and e2e tests
* Support for Karma Test Runner 0.10+ (formerly Testacular)
* Gruntfile.js

## Changes 

* To run e2e tests, you need to have a server running, you could run `npm run server` from the root folder of this repository to get one.
* There are 2 very similar files bootstraping the app named `main.js` and `main-test.js`. Latter is used only for unit testing where we still use RequireJS (so all your `define` and `require` works) but we don't attach our app to the DOM. 
* App has been divided into separate files to hold controllers, filters, directives and services separately. These are all defined as separated Angular modules. In this example all these are required to run the main app but in real-world scenario it's likely that you will have modules that are not needed for certain parts of the applications - use requireJS to load them only as and when needed.

## Installation

    git clone git@github.com:EscovadorDeBIT/angular-requirejs-seed-grunt.git
    cd angular-requirejs-seed-grunt
    npm install
    bower install

## Running

    # Serve static files using your own web server or run
    `npm run server`

## Testing

    # Run unit tests automatically whenever app changes
    `npm run test`

    # Run end to end tests (requires web server to be running)
    `npm run teste2e`

To run e2e tests you can also point your browser to:

    http://localhost:8000/test/e2e/runner.html