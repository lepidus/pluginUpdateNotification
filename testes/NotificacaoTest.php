<?php

use PHPUnit\Framework\TestCase;

class NotificacaoTest extends TestCase {

    private $pluginsUmaAtualizacao = ["ORCID Profile"];
    private $pluginsVariasAtualizacoes = ["ORCID Profile", "Backup", "Default Translation"];

    public function testeNotificacaoUmaAtualizacao(): void {
        $notificacao = new Notificacao($this->pluginsUmaAtualizacao);
        $textoEsperado = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('pt_BR'));
    }

    public function testeNotificacaoVariasAtualizacoes(): void {
        $notificacao = new Notificacao($this->pluginsVariasAtualizacoes);
        $textoEsperado = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile, Backup, Default Translation";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('pt_BR'));
    }

    public function testeNotificacaoUmaAtualizacaoTraduzida(): void {
        $notificacao = new Notificacao($this->pluginsUmaAtualizacao);
        $textoEsperado = "The following plugins have updates available: ORCID Profile";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('en_US'));
    }

    public function testeNotificacaoVariasAtualizacoesTraduzida(): void {
        $notificacao = new Notificacao($this->pluginsVariasAtualizacoes);
        $textoEsperado = "The following plugins have updates available: ORCID Profile, Backup, Default Translation";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('en_US'));
    }
}