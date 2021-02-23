<div id="updateNotificationPlugins" class="pkp_notification">
    {include file="controllers/notification/inPlaceNotificationContent.tpl" notificationId="pluginsUpgradeWarning-"|uniqid notificationStyleClass="notifyWarning" notificationTitle="common.warning"|translate notificationContents=$notificationText}
</div>

<script>
    var div = document.getElementById('updateNotificationPlugins');
    var title = document.getElementsByClassName('pkp_page_title')[0];
    title.parentNode.insertBefore(div, title.nextSibling);
</script>


