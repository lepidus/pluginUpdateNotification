<?php

class TradutorPKP implements Tradutor {
    public function traduzir($chave, $locale, $params = null) {
        return __($chave, $params, $locale);
    }
}