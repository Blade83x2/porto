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
=>  (c) ............... 2005-2016 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
echo Core::make('helper/concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Porto Package Information'));
Core::make('help')->display(t('Insert Site Informations'));
?>
<div class="ccm-dashboard-inner">
    <form method="post" action="<?php echo $this->action('save')?>">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(!$this->controller->hasPermissionToWrite())
                {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Error!').'</strong><p>'.t('You do not have permission to edit this page!').'</p></div>';
                }
                if (is_object($config = \Core::make('config/database')))
                {
                    $obj = unserialize($config->get('porto.datamodel'));
                    if(is_object($obj))
                    {
                        $vt = Core::make('helper/validation/token');
                        echo $form->hidden('ccm_token', $vt->generate($obj->security->formToken));
                    }
                }
                if (isset($info)) echo $info ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><strong><?php echo t('General Information')?></strong></h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php echo t('Here you can put in several Information about your Site. The header and footer types will display this. Email- Bots can not read the Email address!')?>
                <br><br>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                        <label for="email"><?php echo t('Email')?><br /><small><?php echo t('Empty = Disabled')?></small></label>
                    </div>
                    <div class="col-md-7">
                        <?php echo $form->email('email', $email);?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                        <label for="breadcrump_banner_text"><?php echo t('Breadcrump Text')?></label>
                    </div>
                    <div class="col-md-7">
                        <?php
                        if ($breadcrump_banner_active == 0)
                        {
                            echo $form->text('breadcrump_banner_text', $breadcrump_banner_text, array('disabled'=>'disabled'));
                        }
                        else{
                            echo $form->text('breadcrump_banner_text', $breadcrump_banner_text);
                        }
                        $current = PageTheme::getSiteTheme();
                        if($current->getThemeHandle() == 'onepage')
                        {
                            echo '<span style="color: #ff0e2c"><small>' . t('Breadcrump is not available in OnePage Theme!').'</small></span><br />';
                        }
                        if ($breadcrump_banner_active == 0)
                        {
                            echo '<span style="color: #ff0e2c"><small>' . t('Breadcrump Navigation are disabled in settings!').'</small></span>';
                        }
                        ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                        <label for="footer_ribbon"><?php echo t('Ribbon Text')?><br /><small><?php echo t('Empty = Disabled')?></small></label>
                    </div>
                    <div class="col-md-7">
                        <?php echo $form->text('footer_ribbon', $footer_ribbon);?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                        <label for="footer_copyright"><?php echo t('Copyright')?><br /><small><?php echo t('%s placeholder for %d', '%Y', date("Y"))?></small></label>
                    </div>
                    <div class="col-md-7">
                        <?php echo $form->text('footer_copyright', $footer_copyright);?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo $form->submit('submit', t('Save'), array('class'=>'btn btn-primary'))?>
            </div>
        </div>
    </form>
</div>
<style type="text/css"> label { cursor:pointer; } </style>
<?php echo Core::make('helper/concrete/dashboard')->getDashboardPaneFooterWrapper();?>