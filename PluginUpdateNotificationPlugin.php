<?php

/**
 * @file plugins/reports/pluginUpdateNotification/PluginUpdateNotificationPlugin.php
 *
 * Copyright (c) 2023 Lepidus Tecnologia
 * Copyright (c) 2023 SciELO
 * Distributed under the GNU GPL v3. For full terms see LICENSE or https://www.gnu.org/licenses/gpl-3.0.txt.
 *
 * @class PluginUpdateNotificationPlugin
 * @ingroup plugins_generic_pluginUpdateNotification
 *
 * @brief 'Plugin Update Notification' plugin
 */

namespace APP\plugins\generic\pluginUpdateNotification;

use PKP\plugins\Hook;
use PKP\plugins\GenericPlugin;
use PKP\config\Config;
use PKP\db\DAORegistry;
use APP\core\Application;
use APP\plugins\generic\pluginUpdateNotification\classes\PluginUpdateNotification;

class PluginUpdateNotificationPlugin extends GenericPlugin
{
    public function register($category, $path, $mainContextId = null)
    {
        $success = parent::register($category, $path, $mainContextId);

        if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) {
            return true;
        }

        if ($success && $this->getEnabled($mainContextId)) {
            Hook::add('Template::Settings::website', array($this, 'websiteSettingsCallback'));
        }

        return $success;
    }

    public function getDisplayName()
    {
        return __('plugins.generic.pluginUpdateNotification.displayName');
    }

    public function getDescription()
    {
        return __('plugins.generic.pluginUpdateNotification.description');
    }

    public function websiteSettingsCallback($hookName, $params)
    {
        $smarty =& $params[1];
        $output =& $params[2];

        $pluginsToUpdate = $this->getUpgradablePlugins();
        if(!empty($pluginsToUpdate)) {
            $notification = new PluginUpdateNotification($pluginsToUpdate);
            $smarty->assign([
                'notificationText' => $notification->getNotificationText()
            ]);
            $output .= sprintf('%s', $smarty->fetch($this->getTemplateResource('updateNotificationPlugins.tpl')));
        }
    }

    private function getUpgradablePlugins()
    {
        $pluginGalleryDao = DAORegistry::getDAO('PluginGalleryDAO');
        $pluginsGallery = $pluginGalleryDao->getNewestCompatible(Application::get());
        $updatePluginsNames = array();

        foreach($pluginsGallery as $plugin) {
            if($plugin->getCurrentStatus() == PLUGIN_GALLERY_STATE_UPGRADABLE) {
                $updatePluginsNames[] = $plugin->getLocalizedName();
            }
        }

        return $updatePluginsNames;
    }
}
