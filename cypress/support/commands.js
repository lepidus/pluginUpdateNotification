import '../../../../../lib/pkp/cypress/support/commands';

const context = Cypress.env('context') || 'publicknowledge';
const adminUser = Cypress.env('ojsAdminUsername') || 'admin';
const adminPassword = Cypress.env('ojsAdminPassword') || 'admin';

Cypress.on('uncaught:exception', (err, runnable) => {
	// returning false here prevents Cypress from failing the test
	return false;
});

Cypress.Commands.add('loginAdmin', () => {
	cy.login(adminUser, adminPassword, context);
});


Cypress.Commands.add('goToWebsiteSettings', () => {
	cy.loginAdmin();
	cy.get('.app__nav a')
		.contains('Website')
		.click();
});

Cypress.Commands.add('goToPluginSettings', () => {
	cy.goToWebsiteSettings();
	cy.get('button[id="plugins-button"]').click();
});