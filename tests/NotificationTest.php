<?php

use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase {

    private $oneUpdatePlugins = ["ORCID Profile"];
    private $manyUpdatePlugins = ["ORCID Profile", "Backup", "Default Translation"];

    public function testOneNotificationUpdate(): void {
        $translatorTests = new NotificationTranslatorTests();
        $notification = new PluginUpdateNotification($this->oneUpdatePlugins, $translatorTests);
        $expectedText = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile";
        $this->assertEquals($expectedText, $notification->getNotificationText('pt_BR'));
    }
    
    public function testManyNotificationUpdates(): void {
        $translatorTests = new NotificationTranslatorTests();
        $notification = new PluginUpdateNotification($this->manyUpdatePlugins, $translatorTests);
        $expectedText = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile, Backup, Default Translation";
        $this->assertEquals($expectedText, $notification->getNotificationText('pt_BR'));
    }
    
    public function testOneNotificationUpdateTranslated(): void {
        $translatorTests = new NotificationTranslatorTests();
        $notification = new PluginUpdateNotification($this->oneUpdatePlugins, $translatorTests);
        $expectedText = "The following plugins have updates available: ORCID Profile";
        $this->assertEquals($expectedText, $notification->getNotificationText('en_US'));
    }

    public function testManyUpdateNotificationTranslated(): void {
        $translatorTests = new NotificationTranslatorTests();
        $notification = new PluginUpdateNotification($this->manyUpdatePlugins, $translatorTests);
        $expectedText = "The following plugins have updates available: ORCID Profile, Backup, Default Translation";
        $this->assertEquals($expectedText, $notification->getNotificationText('en_US'));
    }
}