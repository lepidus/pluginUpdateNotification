<?php

interface NotificationTranslator
{
    public function translate($key, $locale, $params = null);
}
