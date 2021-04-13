<?php

/**
 * @file plugins/reports/scieloSubmissions/PluginUpdateNotificationPlugin.inc.php
 *
 * Copyright (c) 2021 Lepidus Tecnologia
 * Copyright (c) 2021 SciELO
 * Distributed under the GNU GPL v3. For full terms see LICENSE or https://www.gnu.org/licenses/gpl-3.0.txt.
 *
 * @class PluginUpdateNotificationPlugin
 * @ingroup plugins_generic_pluginUpdateNotification
 *
 * @brief Plugin Update Notification Plugin
 */

import('lib.pkp.classes.plugins.GenericPlugin');
import('plugins.generic.pluginUpdateNotification.classes.NotificationTranslator');
import('plugins.generic.pluginUpdateNotification.classes.NotificationTranslatorPKP');
import('plugins.generic.pluginUpdateNotification.classes.UpdateNotificationPlugin');

class PluginUpdateNotificationPlugin extends GenericPlugin {
    public function register($category, $path, $mainContextId = NULL) {
		$success = parent::register($category, $path, $mainContextId);
        
        if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE'))
            return true;
        
        if ($success && $this->getEnabled($mainContextId)) {
			HookRegistry::register('Template::Settings::website', array($this, 'checkUpdatesPlugins'));
        }
        
        return $success;
    }

    public function getDisplayName() {
		return __('plugins.generic.pluginUpdateNotification.displayName');
	}

	public function getDescription() {
		return __('plugins.generic.pluginUpdateNotification.description');
	}
	
	public function checkUpdatesPlugins($hookName, $params) {
		$smarty =& $params[1];
		$output =& $params[2];
		$locale = AppLocale::getLocale();
		
		$updatePluginsNames = $this->getUpdatePlugins();
		
		if(!empty($updatePluginsNames)) {
			$tradutor = new NotificationTranslatorPKP();
			$notification = new UpdateNotificationPlugin($updatePluginsNames, $tradutor);
			$smarty->assign([
				'notificationText' => $notification->getNotificationText($locale)
			]);
			$output .= sprintf('%s', $smarty->fetch($this->getTemplateResource('updateNotificationPlugins.tpl')));
		}
	}

	private function getUpdatePlugins() {
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