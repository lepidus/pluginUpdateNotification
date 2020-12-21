<?php

class TradutorNotificacaoTestes implements TradutorNotificacao {
    private $mapeamentoTraducao;

    public function __construct() {
        $this->mapeamentoTraducao['pt_BR'] = [
            'plugins.generic.pluginUpdateNotification.messageNotification' => 'Os seguintes plugins possuem atualizações disponíveis: ?',
        ];
        
        $this->mapeamentoTraducao['en_US'] = [
            'plugins.generic.pluginUpdateNotification.messageNotification' => 'The following plugins have updates available: ?',
        ];
    }

    public function traduzir($chave, $locale, $params = null) {
        $mapeamento = $this->mapeamentoTraducao[$locale];
        if($params)
            return str_replace("?", $params['stringPlugins'], $mapeamento[$chave]);
        
        return $mapeamento[$chave];
    }
}