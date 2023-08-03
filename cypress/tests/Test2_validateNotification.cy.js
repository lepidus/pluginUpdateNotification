import '../support/commands';

describe('Validate PluginUpdateNotification plugin works', function () {
	it('shows a notification informing doiInSummary plugin can be updgraded', function () {
		cy.goToWebsiteSettings();
		cy.get('.pkp_notification').get('.notifyWarning').contains('The following plugins have updates available: DOI in Summary');
	});
});
