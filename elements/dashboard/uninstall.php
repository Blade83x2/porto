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
		    <td><a href="http://cplusplus-development.de/" target="_blank">http://cplusplus-development.de</a></td>
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
		    <th colspan="2"><?php echo t('Package uninstall options')?></th>
		</tr>
	    </thead>
	    <tbody>
		<tr>
		    <td class="col-md-2"><?php echo '<label for="portoUninstallFilesets"><small>'.t('Remove Filesets').'</small></label>'?></td>
		    <td class="col-md-8">
			<input type="checkbox" name="portoUninstallFilesets" id="portoUninstallFilesets" value="1" />
		    </td>
		</tr>              
	    </tbody>
	</table>     
    </div>
</div>
<script type="text/javascript">
    $(function() 
    {
	$("#portoUninstallFilesets").prop('checked', true);
    });
</script>