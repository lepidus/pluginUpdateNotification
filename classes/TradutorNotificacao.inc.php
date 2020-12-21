<?php

interface TradutorNotificacao {
    public function traduzir($chave, $locale, $params = null);
}