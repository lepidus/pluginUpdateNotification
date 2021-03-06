<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'pluginupdatenotification' => '/PluginUpdateNotification.inc.php',
                'notificationtranslator' => '/NotificationTranslator.inc.php',
                'notificationtranslatortests' => '/NotificationTranslatorTests.inc.php',
                'notificationtranslatorpkp' => '/NotificationTranslatorPKP.inc.php',
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);
// @codeCoverageIgnoreEnd
