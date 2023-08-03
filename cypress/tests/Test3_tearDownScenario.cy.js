import '../support/commands';

Cypress.Commands.add('uninstallDoiInSummary', () => {
	
});

describe('Tear down scenario', function () {
	it ('uninstalls the doiInSummary plugin', function () {
		cy.goToPluginSettings();
        cy.get('#component-grid-settings-plugins-settingsplugingrid-category-generic-row-doiinsummaryplugin > .first_column > .show_extras').click();
        cy.get(
			'#component-grid-settings-plugins-settingsplugingrid-category-generic-row-doiinsummaryplugin-control-row'
		).contains('Delete').click();
        cy.get('.ok').click();
        cy.get('div').should('include.text', ' successfuly deleted');
	});
});
