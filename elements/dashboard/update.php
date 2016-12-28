<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    <?php echo t('Porto Package updater')?><br>
                    <small><?php echo t('Enable or disable the features for the update routine of this Package')?></small>
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
        </table>
        <table class="table table-hover table-striped ">
            <thead>
            <tr>
                <th colspan="2"><?php echo t('Package install options')?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallEnableLogForInstallation"><small>'.t('Enable Logging for installation').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallEnableLogForInstallation" id="portoInstallEnableLogForInstallation" value="0" />
                </td>
            </tr>

            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallDatabases"><small>'.t('Update Database').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallDatabases" id="portoInstallDatabases" value="1" />
                </td>
            </tr>


            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallPageType"><small>'.t('Update Page Types').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallPageType" id="portoInstallPageType" value="0" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallTemplates"><small>'.t('Update Page Templates').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallTemplates" id="portoInstallTemplates" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallTheme"><small>'.t('Update 2 Themes').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallTheme" id="portoInstallTheme" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallAttributes"><small>'.t('Update Page Attributes').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallAttributes" id="portoInstallAttributes" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallFilesInFileSets"><small>'.t('Update Filesets and Files inFileset').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallFilesInFileSets" id="portoInstallFilesInFileSets" value="0" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallFileExtension"><small>'.t('Update File extension').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallFileExtension" id="portoInstallFileExtension" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallUserGroupSetAndUserGroup"><small>'.t('Update UserGroupSet and UserGroup').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallUserGroupSetAndUserGroup" id="portoInstallUserGroupSetAndUserGroup" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallBlocks"><small>'.t('Update Blocks').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallBlocks" id="portoInstallBlocks" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallThumbnailType"><small>'.t('Update Thumbnail Type').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallThumbnailType" id="portoInstallThumbnailType" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallCronJobs"><small>'.t('Update Cron Jobs').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallCronJobs" id="portoInstallCronJobs" value="1" />
                </td>
            </tr>
            <tr>
                <td class="col-md-2"><?php echo '<label for="portoInstallFlushCache"><small>'.t('Clear Cache').'</small></label>'?></td>
                <td class="col-md-8">
                    <input type="checkbox" name="portoInstallFlushCache" id="portoInstallFlushCache" value="1" />
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function()
    {
        $("#portoInstallEnableLogForInstallation").prop('checked', true);
        $("#portoInstallDatabases").prop('checked', true);
        $("#portoInstallPageType").prop('checked', true);
        $("#portoInstallTemplates").prop('checked', true);
        $("#portoInstallTheme").prop('checked', true);
        $("#portoInstallAttributes").prop('checked', true);
        $("#portoInstallFilesInFileSets").prop('checked', true);
        $("#portoInstallFileExtension").prop('checked', true);
        $("#portoInstallUserGroupSetAndUserGroup").prop('checked', true);
        $("#portoInstallBlocks").prop('checked', true);
        $("#portoInstallThumbnailType").prop('checked', true);
        $("#portoInstallCronJobs").prop('checked', true);
        $("#portoInstallFlushCache").prop('checked', true);
    });
</script>