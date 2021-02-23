<?php

class UpdateNotificationPlugin {
    private $updatePlugins;
    private $translator;

    public function __construct($listPlugins, $translator) {
        $this->updatePlugins = $listPlugins;
        $this->translator = $translator;
    }

    public function getNotificationText($locale) {
        $stringPlugins = implode(", ", $this->updatePlugins);
        $notificationText = $this->translator->translate('plugins.generic.pluginUpdateNotification.messageNotification', $locale, ['stringPlugins' => $stringPlugins]);

        return $notificationText;
    }
}
