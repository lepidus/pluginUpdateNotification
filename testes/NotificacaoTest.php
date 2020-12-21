<?php

use PHPUnit\Framework\TestCase;

class NotificacaoTest extends TestCase {

    private $pluginsUmaAtualizacao = ["ORCID Profile"];
    private $pluginsVariasAtualizacoes = ["ORCID Profile", "Backup", "Default Translation"];

    public function testeNotificacaoUmaAtualizacao(): void {
        $tradutorTestes = new TradutorNotificacaoTestes();
        $notificacao = new Notificacao($this->pluginsUmaAtualizacao, $tradutorTestes);
        $textoEsperado = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('pt_BR'));
    }

    public function testeNotificacaoVariasAtualizacoes(): void {
        $tradutorTestes = new TradutorNotificacaoTestes();
        $notificacao = new Notificacao($this->pluginsVariasAtualizacoes, $tradutorTestes);
        $textoEsperado = "Os seguintes plugins possuem atualizações disponíveis: ORCID Profile, Backup, Default Translation";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('pt_BR'));
    }

    public function testeNotificacaoUmaAtualizacaoTraduzida(): void {
        $tradutorTestes = new TradutorNotificacaoTestes();
        $notificacao = new Notificacao($this->pluginsUmaAtualizacao, $tradutorTestes);
        $textoEsperado = "The following plugins have updates available: ORCID Profile";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('en_US'));
    }

    public function testeNotificacaoVariasAtualizacoesTraduzida(): void {
        $tradutorTestes = new TradutorNotificacaoTestes();
        $notificacao = new Notificacao($this->pluginsVariasAtualizacoes, $tradutorTestes);
        $textoEsperado = "The following plugins have updates available: ORCID Profile, Backup, Default Translation";
        $this->assertEquals($textoEsperado, $notificacao->obterTextoNotificacao('en_US'));
    }
}