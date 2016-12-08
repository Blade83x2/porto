<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
/*>       ____  _           _       ___ _____
*>       | __ )| | __ _  __| | ___ ( _ )___ /
*>       |  _ \| |/ _` |/ _` |/ _ \/ _ \ |_ \
*>       | |_) | | (_| | (_| |  __/ (_) |__) |
*>       |____/|_|\__,_|\__,_|\___|\___/____/
*>
**  - - - - - - - - - - - - - - - - - - - - - - - +
=>  Web ......... http://cplusplus-development.de |
=>  Mail ........................ mail@blade83.de |
=>  (c) ............... 2005-2015 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
echo Core::make('helper/concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Porto Package'));
Core::make('help')->display(t('Setup for Porto Package'));
?>
<div class="ccm-dashboard-inner">
<?php
$ctr = \Concrete\Core\Package\Package::getByHandle('porto');
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2 hidden-xs hidden-sm">
                    <img class="img-responsive" src="<?php echo $ctr->getRelativePath()?>/icon.png" alt="">
                </div>
                <div class="col-md-10">
                    <h3>
                        <?php echo $ctr->getPackageName()?> <small><?php echo $ctr->getPackageVersion()?></small><br>
                        <small><?php echo $ctr->getPackageDescription()?></small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <?php
            if (isset($info)){?>
		<div class="row">
		    <div class="col-md-12">
			<?php echo $info;?>
		    </div>
		</div>
            <?php } ?>

            <table class="table table-hover table-striped table-responsive">
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
                        <td><a href="http://cplusplus-development.de/kontakt" target="_blank"><?php echo t('Tell me!')?></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style type="text/css"> label { cursor: pointer; } </style>
<?php echo Core::make('helper/concrete/dashboard')->getDashboardPaneFooterWrapper();?>