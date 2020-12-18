<?php

class TradutorPKP implements TradutorPluginNotificacao {
    public function traduzir($chave, $locale, $params = null) {
        return __($chave, $params, $locale);
    }
}