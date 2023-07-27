<?php

/**
 * @defgroup plugins_generic_pluginUpdateNotification Plugin Update Notification Plugin
 */

/**
 * @file plugins/reports/pluginUpdateNotification/index.php
 *
 * Copyright (c) 2021 Lepidus Tecnologia
 * Copyright (c) 2021 SciELO
 * Distributed under the GNU GPL v3. For full terms see LICENSE or https://www.gnu.org/licenses/gpl-3.0.txt.
 *
 * @ingroup plugins_generic_pluginUpdateNotification
 * @brief Wrapper for plugin update notification plugin.
 *
 */

require_once('PluginUpdateNotificationPlugin.inc.php');

return new PluginUpdateNotificationPlugin();
