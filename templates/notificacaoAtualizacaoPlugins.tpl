<div id="notificacaoAtualizacaoPlugins" class="pkp_notification">
    {include file="controllers/notification/inPlaceNotificationContent.tpl" notificationId="pluginsUpgradeWarning-"|uniqid notificationStyleClass="notifyWarning" notificationTitle="common.warning"|translate notificationContents=$textoNotificacao}
</div>

<script>
    var div = document.getElementById('notificacaoAtualizacaoPlugins');
    var titulo = document.getElementsByClassName('pkp_page_title')[0];
    titulo.parentNode.insertBefore(div, titulo.nextSibling);
</script>