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
echo Core::make('helper/concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Porto Package Header and Footer Design'));
Core::make('help')->display(t('Changes the Header and Footer Type of the Pages'));
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
                if (isset($info))
                    echo $info;
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><strong><?php echo t('Theme Header Type')?></strong></h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php echo t('Here you can select a header type. Not every header has a search function!')?>
                <br />
                <?php
                $current = PageTheme::getSiteTheme();
                if($current->getThemeHandle() == 'onepage')
                {
                    ?>
                    <p>
                        <span style="color: #ff0e2c"><?php echo t('This function does not work with the OnePage Theme!')?></span>
                    </p>
                    <?php
                }
                ?>
            </div>
            <!-- TODO files aus ordner auslesen und was da ist anzeigen -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <?php echo '<label>'.$form->radio('header_type', '1', $header_type).' '.t('Type').' 1</label>';?><br><br>
                    </div>
                    <div class="col-md-3 text-center">
                        <?php echo '<label>'.$form->radio('header_type', '2', $header_type).' '.t('Type').' 2</label>';?><br><br>
                    </div>
                    <div class="col-md-3 text-center">
                        <?php echo '<label>'.$form->radio('header_type', '3', $header_type).' '.t('Type').' 3</label>';?><br><br>
                    </div>
                    <div class="col-md-3 text-center">
                        <?php echo '<label>'.$form->radio('header_type', '4', $header_type).' '.t('Type').' 4</label>';?><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <img id="header_type_img" src="<?php echo $imgPath.'header_types/'.$header_type.'.png'?>" alt="" class="img-responsive img-rounded">
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><strong><?php echo t('Theme Footer Type')?></strong></h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php echo t('Here you can select a footer type.')?>
                <br><br>
            </div>
            <!-- TODO files aus ordner auslesen und was da ist anzeigen -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-2 col-md-offset-1 text-center">
                        <?php echo '<label>'.$form->radio('footer_type', '1', $footer_type).' '.t('Type').' 1</label>';?><br><br>
                    </div>
                    <div class="col-md-2 text-center">
                        <?php echo '<label>'.$form->radio('footer_type', '2', $footer_type).' '.t('Type').' 2</label>';?><br><br>
                    </div>
                    <div class="col-md-2 text-center">
                        <?php echo '<label>'.$form->radio('footer_type', '3', $footer_type).' '.t('Type').' 3</label>';?><br><br>
                    </div>
                    <div class="col-md-2 text-center">
                        <?php echo '<label>'.$form->radio('footer_type', '4', $footer_type).' '.t('Type').' 4</label>';?><br><br>
                    </div>
                    <div class="col-md-2 text-center">
                        <?php echo '<label>'.$form->radio('footer_type', '5', $footer_type).' '.t('Type').' 5</label>';?><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <img id="footer_type_img" src="<?php echo $imgPath.'footer_types/'.$footer_type.'.png'?>" alt="" class="img-responsive img-rounded">
                        <br><br>
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
<script>
    $(document).ready(function(){
        $("input[name='header_type']").click(function(){$("#header_type_img").attr("src", "<?php echo $imgPath.'header_types/';?>" + $(this).val() + ".png");});
        $("input[name='footer_type']").click(function(){$("#footer_type_img").attr("src", "<?php echo $imgPath.'footer_types/';?>" + $(this).val() + ".png");});
    });
</script>
<?php echo Core::make('helper/concrete/dashboard')->getDashboardPaneFooterWrapper();?>