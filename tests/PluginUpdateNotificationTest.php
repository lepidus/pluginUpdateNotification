<?php

namespace APP\plugins\generic\pluginUpdateNotification\tests;

use APP\plugins\generic\pluginUpdateNotification\classes\PluginUpdateNotification;
use PKP\tests\PKPTestCase;
use PKP\facades\Locale;

class PluginUpdateNotificationTest extends PKPTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Locale::setLocale("en");
    }

    public function testOneUpdateNotification(): void
    {
        $pluginToUpdate = ["ORCID Profile"];
        $notificationText = PluginUpdateNotification::getNotificationText($pluginToUpdate);
        $expected = __('plugins.generic.pluginUpdateNotification.messageNotification', ['stringPlugins' => $pluginToUpdate]);
        self::assertEquals($expected, $notificationText);
    }

    public function testManyUpdatesNotification(): void
    {
        $pluginsToUpdate = ["ORCID Profile", "Backup", "Default Translation"];
        $notificationText = PluginUpdateNotification::getNotificationText($pluginsToUpdate);
        $expected = __('plugins.generic.pluginUpdateNotification.messageNotification', ['stringPlugins' => $pluginsToUpdate]);
        self::assertEquals($expected, $notificationText);
    }

    public function testThrowExceptionIfPluginsListIsEmpty(): void
    {
        self::expectException(\Exception::class);
        self::expectExceptionMessage('The list of plugin names is empty');
        PluginUpdateNotification::getNotificationText(array());
    }
}
