define([
	'backbone',
	FRAMEWORK_URL + "/core/src/js/events/EventDispatcher.js",
	FRAMEWORK_URL + "/core/src/js/events/EventTypes.js",
	FRAMEWORK_URL + "/core/src/js/events/FrameworkEvent.js",
	FRAMEWORK_URL + "/core/src/js/managers/NavigationManager.js",
	FRAMEWORK_URL + "/core/src/js/services/Service.js",
],
function(Backbone, EventDispatcher, EventTypes, FrameworkEvent, NavigationManager, Service)
{

	/* STATIC CLASS */
	var Framework = 
	{
		eventTypes: EventTypes,
		isTouchScreen: 'createTouch' in document
	};

	Framework.eventDispatcher = new EventDispatcher();

	Framework.navigationManager = new NavigationManager( Framework );

	Framework.service = new Service();
	
	return Framework;
});