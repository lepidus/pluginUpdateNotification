<?php

class PluginUpdateNotification
{
    private $upgradeablePlugins;
    private $translator;

    public function __construct($listPlugins, $translator)
    {
        $this->upgradeablePlugins = $listPlugins;
        $this->translator = $translator;
    }

    public function getNotificationText($locale)
    {
        $stringPlugins = implode(", ", $this->upgradeablePlugins);
        $notificationText = $this->translator->translate('plugins.generic.pluginUpdateNotification.messageNotification', $locale, ['stringPlugins' => $stringPlugins]);

        return $notificationText;
    }
}
