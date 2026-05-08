{*
 * Copyright (c) 2023 Lepidus Tecnologia
 * Copyright (c) 2023 SciELO
 * Distributed under the GNU GPL v3. For full terms see LICENSE or https://www.gnu.org/licenses/gpl-3.0.txt
 *
 *}

<notification id="pluginUpdateNotification" type="warning" class="pkpNotification--backendPage__header">
    <strong>{translate key="common.warning"}</strong>
    {translate key="plugins.generic.pluginUpdateNotification.messageNotification" stringPlugins=$stringPlugins}
</notification>

<script>
    var notification = document.getElementById('pluginUpdateNotification');
    var title = document.getElementsByClassName('app__pageHeading')[0];

    if (notification && title && title.parentNode) {ldelim}
        title.parentNode.insertBefore(notification, title.nextSibling);
    {rdelim}
</script>
