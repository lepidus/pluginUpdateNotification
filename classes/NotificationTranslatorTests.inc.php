<?php

class NotificationTranslatorTests implements NotificationTranslator {
    private $mappingTranslation;

    public function __construct() {
        $this->mappingTranslation['pt_BR'] = [
            'plugins.generic.pluginUpdateNotification.messageNotification' => 'Os seguintes plugins possuem atualizações disponíveis: ?',
        ];
        
        $this->mappingTranslation['en_US'] = [
            'plugins.generic.pluginUpdateNotification.messageNotification' => 'The following plugins have updates available: ?',
        ];
    }

    public function translate($key, $locale, $params = null) {
        $mapping = $this->mappingTranslation[$locale];
        if($params)
            return str_replace("?", $params['stringPlugins'], $mapping[$key]);
        
        return $mapping[$key];
    }
}