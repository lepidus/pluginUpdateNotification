import '../support/commands';

describe('Setup scenario', function () {
	it('activates the PluginUpdateNotification plugin', function () {
		cy.goToPluginSettings();
		cy.get(
			'#component-grid-settings-plugins-settingsplugingrid-category-generic-row-pluginupdatenotificationplugin'
		).then($pluginRow => {
			if ( !$pluginRow.find('input[id^="select-cell-pluginupdatenotificationplugin-enable"]:checked').length ) {
				cy.get('input[id^="select-cell-pluginupdatenotificationplugin-enable"]').check();
				cy.get('div').contains('The plugin "Plugin update notification" has been enabled.');
			}
		});
	});

	it('install plugin doiInSummary version 1.3.1 ', function () {
		const fileName = 'plugins/generic/pluginUpdateNotification/cypress/testData/doiInSummary.tar.gz';
		cy.goToPluginSettings();
		cy.get('.pkp_linkaction_upload').contains('Upload A New Plugin').click();
		cy.get('#plupload-pkpUploaderDropZone').selectFile(fileName, { action: 'drag-drop' });
		cy.get('.pkp_uploader_details').contains('doiInSummary.tar.gz');
		cy.get('.submitFormButton').contains('Save').click();
		cy.get('div').contains('Successfully installed version 1.3.1.0');
	});
});
