{*
 * Copyright (c) 2023 Lepidus Tecnologia
 * Copyright (c) 2023 SciELO
 * Distributed under the GNU GPL v3. For full terms see LICENSE or https://www.gnu.org/licenses/gpl-3.0.txt
 *
 *}

<div id="pluginUpdateNotification" class="pkp_notification">
    {include file="controllers/notification/inPlaceNotificationContent.tpl" notificationId="pluginsUpgradeWarning-"|uniqid notificationStyleClass="notifyWarning" notificationTitle="common.warning"|translate notificationContents=$notificationText}
</div>

<script>
    var div = document.getElementById('pluginUpdateNotification');
    var title = document.getElementsByClassName('pkp_page_title')[0];
    
    if(!title){ldelim}
        title = document.getElementsByClassName('app__pageHeading')[0];
    {rdelim}
    
    title.parentNode.insertBefore(div, title.nextSibling);
</script>


