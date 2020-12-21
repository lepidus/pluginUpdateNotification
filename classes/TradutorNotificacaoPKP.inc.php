<?php

class TradutorNotificacaoPKP implements TradutorNotificacao {
    public function traduzir($chave, $locale, $params = null) {
        return __($chave, $params, $locale);
    }
}