<?php

interface TradutorPluginNotificacao {
    public function traduzir($chave, $locale, $params = null);
}