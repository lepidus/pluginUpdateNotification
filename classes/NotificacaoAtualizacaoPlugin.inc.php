<?php

class NotificacaoAtualizacaoPlugin {
    private $pluginsAtualizaveis;
    private $tradutor;

    public function __construct($listaPlugins, $tradutor) {
        $this->pluginsAtualizaveis = $listaPlugins;
        $this->tradutor = $tradutor;
    }

    public function obterTextoNotificacao($locale) {
        $stringPlugins = implode(", ", $this->pluginsAtualizaveis);
        $textoNotificacao = $this->tradutor->traduzir('plugins.generic.pluginUpdateNotification.messageNotification', $locale, ['stringPlugins' => $stringPlugins]);

        return $textoNotificacao;
    }
}