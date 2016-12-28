<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
?>
<div class="panel panel-default">
    <div class="panel-heading">
	<div class="row">
	    <div class="col-md-12">
		<h3>
		    <?php echo t('Porto Package uninstaller')?><br>
		    <small><?php echo t('Enable or disable the features for the uninstall routine of this Package')?></small>
		</h3>
	    </div>
	</div>
    </div>
    <div class="panel-body">
	<table class="table table-hover table-striped">
	    <thead>
		<tr>
		    <th colspan="2"><?php echo t('Manufacturer')?></th>
		</tr>
	    </thead>
	    <tbody>

        <tr>
            <td class="col-md-2"><?php echo t('Developer')?></td>
            <td class="col-md-8"><span class="badge">Johannes Kr&auml;mer</span></td>
        </tr>
        <tr>
            <td><?php echo t('Web')?></td>
            <td><a href="http://cplusplus-development.de" target="_blank">http://cplusplus-development.de</a></td>
        </tr>
        <tr>
            <td><?php echo t('Facebook')?></td>
            <td><a href="https://www.facebook.com/c.plus.plus.programming.language?ref=hl" target="_blank">https://facebook.com</a></td>
        </tr>
        <tr>
            <td><?php echo t('Ideas or criticism?')?></td>
            <td><a href="http://cplusplus-development.de/kontakt" target="_blank"><?php echo t('Send a message')?></a></td>
        </tr>
        </tbody>

        <thead>
        <tr>
            <th colspan="2"><?php echo t('Package install options')?></th>
        </tr>
        </thead>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallDatabases"><small>'.t('Remove Datebase').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallDatabases" id="portoUninstallDatabases" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallPageType"><small>'.t('Remove Page Types').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallPageType" id="portoUninstallPageType" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallAttributes"><small>'.t('Remove Page Attributes').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallAttributes" id="portoUninstallAttributes" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallFilesInFileSets"><small>'.t('Remove Filesets and Files inFileset').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallFilesInFileSets" id="portoUninstallFilesInFileSets" value="1" />
            </td>
        </tr>


        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallFileExtension"><small>'.t('Remove File extension').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallFileExtension" id="portoUninstallFileExtension" value="1" />
            </td>
        </tr>
        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallUserGroupSetAndUserGroup"><small>'.t('Remove UserGroupSet and UserGroup').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallUserGroupSetAndUserGroup" id="portoUninstallUserGroupSetAndUserGroup" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallTheme"><small>'.t('Remove 2 Themes').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallTheme" id="portoUninstallTheme" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallTemplates"><small>'.t('Remove Page Templates').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallTemplates" id="portoUninstallTemplates" value="1" />
            </td>
        </tr>
        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallBlocks"><small>'.t('Remove Blocks').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallBlocks" id="portoUninstallBlocks" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallThumbnailType"><small>'.t('Remove Thumbnail Type').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallThumbnailType" id="portoUninstallThumbnailType" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallCronJobs"><small>'.t('Remove Cron Jobs').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallCronJobs" id="portoUninstallCronJobs" value="1" />
            </td>
        </tr>

        <tr>
            <td class="col-md-2"><?php echo '<label for="portoUninstallFlushCache"><small>'.t('Clear Cache').'</small></label>'?></td>
            <td class="col-md-8">
                <input type="checkbox" name="portoUninstallFlushCache" id="portoUninstallFlushCache" value="1" />
            </td>
        </tr>
	</table>     
    </div>
</div>

<script type="text/javascript">
    $(function()
    {
        $("#portoUninstallEnableLogForInstallation").prop('checked', true);
        $("#portoUninstallDatabases").prop('checked', true);
        $("#portoUninstallPageType").prop('checked', true);
        $("#portoUninstallTemplates").prop('checked', true);
        $("#portoUninstallTheme").prop('checked', true);
        $("#portoUninstallAttributes").prop('checked', true);
        $("#portoUninstallFilesInFileSets").prop('checked', true);
        $("#portoUninstallFileExtension").prop('checked', true);
        $("#portoUninstallUserGroupSetAndUserGroup").prop('checked', true);
        $("#portoUninstallBlocks").prop('checked', true);
        $("#portoUninstallThumbnailType").prop('checked', true);
        $("#portoUninstallCronJobs").prop('checked', true);
        $("#portoUninstallFlushCache").prop('checked', true);
    });
</script>
