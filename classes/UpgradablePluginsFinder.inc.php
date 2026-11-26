<?php

/**
 * @file plugins/generic/pluginUpdateNotification/classes/UpgradablePluginsFinder.inc.php
 *
 * Copyright (c) 2026 Lepidus Tecnologia
 * Distributed under the GNU GPL v3. For full terms see LICENSE or https://www.gnu.org/licenses/gpl-3.0.txt.
 *
 * @class UpgradablePluginsFinder
 * @ingroup plugins_generic_pluginUpdateNotification
 *
 * @brief Lists the installed plugins with an update available in the plugin gallery,
 *  without letting gallery failures (network, timeout or invalid response) break the page.
 */

import('lib.pkp.classes.plugins.GalleryPlugin');

class UpgradablePluginsFinder
{
    /** @var PluginGalleryDAO */
    private $pluginGalleryDao;

    /**
     * @param PluginGalleryDAO $pluginGalleryDao
     */
    public function __construct($pluginGalleryDao)
    {
        $this->pluginGalleryDao = $pluginGalleryDao;
    }

    /**
     * @param PKPApplication $application
     *
     * @return string[] Localized names of the upgradable plugins; empty when the gallery cannot be consulted
     */
    public function getUpgradablePluginNames($application)
    {
        try {
            $upgradablePluginNames = array();
            foreach ($this->pluginGalleryDao->getNewestCompatible($application) as $plugin) {
                if ($plugin->getCurrentStatus() == PLUGIN_GALLERY_STATE_UPGRADABLE) {
                    $upgradablePluginNames[] = $plugin->getLocalizedName();
                }
            }

            return $upgradablePluginNames;
        } catch (Throwable $exception) {
            error_log(sprintf(
                'pluginUpdateNotification: could not check the plugin gallery for updates (%s): %s',
                get_class($exception),
                $exception->getMessage()
            ));

            return array();
        }
    }
}
