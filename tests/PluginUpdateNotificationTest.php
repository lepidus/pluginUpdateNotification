<?php

namespace APP\plugins\generic\pluginUpdateNotification\tests;

use APP\plugins\generic\pluginUpdateNotification\classes\PluginUpdateNotification;
use PKP\tests\PKPTestCase;
use PKP\facades\Locale;

class NotificationTest extends PKPTestCase
{
    private $onePluginUpdate = ["ORCID Profile"];
    private $manyPluginUpdates = ["ORCID Profile", "Backup", "Default Translation"];

    public function testOneNotificationUpdate(): void
    {
        $notification = new PluginUpdateNotification($this->onePluginUpdate);
        $expectedText = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile";
        Locale::setLocale('pt_BR');
        self::assertEquals($expectedText, $notification->getNotificationText());
    }

    public function testManyNotificationUpdates(): void
    {
        $notification = new PluginUpdateNotification($this->manyPluginUpdates);
        $expectedText = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile, Backup, Default Translation";
        Locale::setLocale('pt_BR');
        self::assertEquals($expectedText, $notification->getNotificationText());
    }

    public function testOneNotificationUpdateTranslated(): void
    {
        $notification = new PluginUpdateNotification($this->onePluginUpdate);
        $expectedText = "The following plugins have updates available: ORCID Profile";
        Locale::setLocale('en');
        self::assertEquals($expectedText, $notification->getNotificationText());
    }

    public function testManyUpdateNotificationTranslated(): void
    {
        $notification = new PluginUpdateNotification($this->manyPluginUpdates);
        $expectedText = "The following plugins have updates available: ORCID Profile, Backup, Default Translation";
        Locale::setLocale('en');
        self::assertEquals($expectedText, $notification->getNotificationText());
    }
}
