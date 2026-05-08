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

	it('install plugin shariff version 3.5.1.0 ', function () {
		const fileName = 'plugins/generic/pluginUpdateNotification/cypress/testData/shariff-3_5_0.tar.gz';
		cy.goToPluginSettings();
		cy.get('.pkp_linkaction_upload').contains('Upload A New Plugin').click();
		cy.get('#plupload-pkpUploaderDropZone').selectFile(fileName, { action: 'drag-drop' });
		cy.get('.pkp_uploader_details').contains('shariff-3_5_0.tar.gz');
		cy.get('.submitFormButton').contains('Save').click();
		cy.get('div').contains('Successfully installed version 3.5.1.0');
	});
});
