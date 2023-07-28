<?php

namespace APP\plugins\generic\pluginUpdateNotification\classes;

use PKP\facades\Locale;

class PluginUpdateNotification
{
    private $upgradeablePlugins;

    public function __construct($pluginsList)
    {
        $this->upgradeablePlugins = $pluginsList;
    }

    public function getNotificationText($locale = null)
    {
        $stringPlugins = implode(", ", $this->upgradeablePlugins);

        if (is_null($locale)) {
            $locale = Locale::getLocale();
        }

        return __('plugins.generic.pluginUpdateNotification.messageNotification', ['stringPlugins' => $stringPlugins], $locale);
    }
}
