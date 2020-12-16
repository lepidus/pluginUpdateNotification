<?php

/**
 * @file plugins/reports/scieloSubmissions/PluginUpdateNotificationPlugin.inc.php
 *
 * Copyright (c) 2020 Lepidus Tecnologia
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PluginUpdateNotificationPlugin
 * @ingroup plugins_generic_pluginUpdateNotification
 *
 * @brief Plugin Update Notification Plugin
 */

import('lib.pkp.classes.plugins.GenericPlugin');
import('classes.submission.Submission');

class PluginUpdateNotificationPlugin extends GenericPlugin {
    public function register($category, $path, $mainContextId = NULL) {
		$success = parent::register($category, $path, $mainContextId);
        
        if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE'))
            return true;
        
        /*if ($success && $this->getEnabled($mainContextId)) {
        }*/
        
        return $success;
    }

    public function getDisplayName() {
		return __('plugins.generic.pluginUpdateNotification.displayName');
	}

	public function getDescription() {
		return __('plugins.generic.pluginUpdateNotification.description');
    }
}