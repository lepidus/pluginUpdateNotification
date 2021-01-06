<?php

/**
 * @file plugins/reports/scieloSubmissions/PluginUpdateNotificationPlugin.inc.php
 *
 * Copyright (c) 2020 Lepidus Tecnologia
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PluginUpdateNotificationPlugin
 * @ingroup plugins_generic_pluginUpdateNotification
 *
 * @brief Plugin Update Notification Plugin
 */

import('lib.pkp.classes.plugins.GenericPlugin');
import('plugins.generic.pluginUpdateNotification.classes.TradutorNotificacao');
import('plugins.generic.pluginUpdateNotification.classes.TradutorNotificacaoPKP');
import('plugins.generic.pluginUpdateNotification.classes.Notificacao');

class PluginUpdateNotificationPlugin extends GenericPlugin {
    public function register($category, $path, $mainContextId = NULL) {
		$success = parent::register($category, $path, $mainContextId);
        
        if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE'))
            return true;
        
        if ($success && $this->getEnabled($mainContextId)) {
			HookRegistry::register('Template::Settings::website', array($this, 'verificaAtualizacoesPlugins'));
        }
        
        return $success;
    }

    public function getDisplayName() {
		return __('plugins.generic.pluginUpdateNotification.displayName');
	}

	public function getDescription() {
		return __('plugins.generic.pluginUpdateNotification.description');
	}
	
	public function verificaAtualizacoesPlugins($hookName, $params) {
		$smarty =& $params[1];
		$output =& $params[2];
		$locale = AppLocale::getLocale();
		
		$nomesPluginsAtualizaveis = $this->obtemPluginsAtualizaveis();
		
		if(!empty($nomesPluginsAtualizaveis)) {
			$tradutor = new TradutorNotificacaoPKP();
			$notificacao = new Notificacao($nomesPluginsAtualizaveis, $tradutor);
			$smarty->assign([
				'textoNotificacao' => $notificacao->obterTextoNotificacao($locale)
			]);
			$output .= sprintf('%s', $smarty->fetch($this->getTemplateResource('notificacaoAtualizacaoPlugins.tpl')));
		}
	}

	private function obtemPluginsAtualizaveis() {
		$pluginGalleryDao = DAORegistry::getDAO('PluginGalleryDAO');
		$pluginsGaleria = $pluginGalleryDao->getNewestCompatible(Application::get());
		$nomesPluginsAtualizaveis = array();
		
		foreach($pluginsGaleria as $plugin) {
			if($plugin->getCurrentStatus() == PLUGIN_GALLERY_STATE_UPGRADABLE) {
				$nomesPluginsAtualizaveis[] = $plugin->getLocalizedName();
			}
		}

		return $nomesPluginsAtualizaveis;
	}
}