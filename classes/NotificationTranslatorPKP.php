<?php

namespace APP\plugins\generic\pluginUpdateNotification\classes;

class NotificationTranslatorPKP implements NotificationTranslator
{
    public function translate($key, $locale, $params = null)
    {
        return __($key, $params, $locale);
    }
}
