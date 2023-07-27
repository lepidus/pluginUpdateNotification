<?php

namespace APP\plugins\generic\pluginUpdateNotification\classes;

interface NotificationTranslator
{
    public function translate($key, $locale, $params = null);
}
