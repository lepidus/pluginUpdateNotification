import '../support/commands';

describe('Tear down scenario', function () {
	it ('Uninstalls the Shariff plugin', function () {
		cy.goToPluginSettings();
        cy.get('#component-grid-settings-plugins-settingsplugingrid-category-generic-row-shariffplugin > .first_column > .show_extras').click();
        cy.get(
			'#component-grid-settings-plugins-settingsplugingrid-category-generic-row-shariffplugin-control-row'
		).contains('Delete').click();
        cy.get('.pkpButton').contains('OK').click();
        cy.get('div').should('include.text', ' successfuly deleted');
		cy.reload();
		cy.contains('The following plugins have updates available: Shariff')
			.should('not.exist');
	});
});
