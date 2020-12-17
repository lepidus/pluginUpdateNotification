<?php

interface Tradutor {
    public function traduzir($chave, $locale, $params = null);
}