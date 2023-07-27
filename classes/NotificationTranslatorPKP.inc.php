<?php

class NotificationTranslatorPKP implements NotificationTranslator
{
    public function translate($key, $locale, $params = null)
    {
        return __($key, $params, $locale);
    }
}
