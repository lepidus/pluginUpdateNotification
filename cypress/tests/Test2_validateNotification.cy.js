import '../support/commands';

describe('Validate PluginUpdateNotification plugin works', function () {
	it('Shows a notification informing shariff plugin can be updgraded', function () {
		cy.goToWebsiteSettings();
		cy.get('#pluginUpdateNotification').contains('The following plugins have updates available: Shariff');
	});
});
