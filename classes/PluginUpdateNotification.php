<?php

namespace APP\plugins\generic\pluginUpdateNotification\classes;

class PluginUpdateNotification
{
    public static function getNotificationText(array $pluginsList): string
    {
        if (empty($pluginsList)) {
            throw new \Exception('The list of plugin names is empty');
        } else {
            $pluginsString = implode(", ", $pluginsList);
            return __('plugins.generic.pluginUpdateNotification.messageNotification', ['stringPlugins' => $pluginsString]);
        }
    }
}
