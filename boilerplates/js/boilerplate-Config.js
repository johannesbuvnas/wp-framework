/*
*	CONFIGURATION FILE
*/

require.config({
	// Main
	deps: ["Main"],

	// Libs paths
	paths: {
		"jquery": FRAMEWORK_URL + "/libs/js/jquery-1.8.3.min",
		"underscore": FRAMEWORK_URL + "/libs/js/underscore-min",
		"backbone": FRAMEWORK_URL + "/libs/js/backbone-min",
		"framework": FRAMEWORK_URL + "/core/src/js/Framework"
	},

	// Libs configuration
	shim: {
		"backbone": {
			deps: [
				'underscore',
				'jquery'
			],
			exports: "Backbone"
		},
		"framework": {
			deps: [
				'backbone',
			],
			exports: "Framework"
		}
	},

	// Application base path
	baseUrl: FRAMEWORK_URL + "/application/src/js"
});