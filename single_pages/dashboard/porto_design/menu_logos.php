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
echo Core::make('helper/concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Porto Package'));
Core::make('help')->display(t('Upload a Site Logo and / or create an animated Menu loading Effect'));
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
                ?>
                <?php if (isset($info)) echo $info ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><strong><?php echo t('Page Images')?></strong></h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h4><strong><?php echo t('Logo (Header)')?></strong></h4>
                <p>
                    <?php echo t('Prior be sure to transform the Image to the right size!')?>
                </p>

            </div>
            <div class="col-md-2">
                <?php echo $al->image('page_logo', 'page_logo', t('Select Logo'), $page_logo); ?>
                <br /><br />
            </div>
            <div class="col-md-2">
                <?php if (is_object($page_logo)) { ?>
                    <div style="float:left">
                        <?php echo $form->label('page_logo_x', t('Width:'))?>
                    </div>
                    <div style="float:right">
                        <?php echo $form->number('page_logo_x', $page_logo_x, array('placeholder'=>'0', 'style'=>'width:65px;','class'=>'input-sm'))?>
                    </div>
                    <div style="clear:both;height:5px;"></div>
                    <div style="float:left">
                        <?php echo $form->label('page_logo_y', t('Height:'))?>
                    </div>
                    <div style="float:right">
                        <?php echo $form->number('page_logo_y', $page_logo_y, array('placeholder'=>'0', 'style'=>'width:65px;','class'=>'input-sm'))?>
                    </div>
                    <div style="clear:both;height:5px;"></div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h4><strong><?php echo t('Logo (Footer)')?></strong></h4>
                <p>
                    <?php echo t('Prior be sure to transform the Image to the right size!')?>
                </p>
            </div>
            <div class="col-md-2">
                <?php echo $al->image('page_logo_mini', 'page_logo_mini', t('Select Logo'), $page_logo_mini); ?>
                <br /><br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h4><strong><?php echo t('Sticky Menu Logo')?></strong></h4>
                <p>
                    <?php echo t('Activate the Sticky-Header menu here! The animation works only with a selected Logo (Header) and Sticky Menu Logo.')?>
                    <?php echo t('The function "always on" overrides the Logo (Header) and will not displayed if the User can see the Concrete5 edit taskbar!')?>
                </p>
                <br /><br />
            </div>
            <div class="col-md-2">
                <?php echo '<label>'.$form->radio('stickymenu_active', 0, $stickymenu_active).' '.t('off').'</label>';?><br>
                <?php echo '<label>'.$form->radio('stickymenu_active', 1, $stickymenu_active).' '.t('always on').'</label>';?><br>
                <?php echo '<label>'.$form->radio('stickymenu_active', 2, $stickymenu_active).' '.t('animate').'</label>';?><br>
                <br>
                <br>
            </div>
            <div class="col-md-2">
                <div class="stickySetupData" style="<?php if(!is_object($second_stickymenu_gfx)){ echo 'display:none;';}?>">
                    <div style="float:left">
                        <?php echo $form->label('second_stickymenu_gfx_top', t('Top:'))?>
                    </div>
                    <div style="float:right">
                        <?php echo $form->number('second_stickymenu_gfx_top', $second_stickymenu_gfx_top, array('placeholder'=>'-0', 'style'=>'width:65px;','class'=>'input-sm'))?>
                    </div>
                    <div style="clear:both;height:5px;"></div>

                    <div style="float:left;">
                        <?php echo $form->label('second_stickymenu_gfx_x', t('Width:'))?>
                    </div>
                    <div style="float:right">
                        <?php echo $form->number('second_stickymenu_gfx_x', $second_stickymenu_gfx_x, array('placeholder'=>'250','style'=>'width:65px;','class'=>'input-sm'))?>
                    </div>
                    <div style="clear:both;height:5px;"></div>

                    <div style="float:left">
                        <?php echo $form->label('second_stickymenu_gfx_y', t('Height:'))?>
                    </div>
                    <div style="float:right">
                        <?php echo $form->number('second_stickymenu_gfx_y', $second_stickymenu_gfx_y, array('placeholder'=>'50', 'style'=>'width:65px;','class'=>'input-sm'))?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stickySetupUpload" style="<?php if($stickymenu_active==0){ echo 'display:none;';}?>">
                    <?php echo $al->image('second_stickymenu_gfx', 'second_stickymenu_gfx', t('Sticky Logo'), $second_stickymenu_gfx); ?>
                </div>
            </div>
        </div>
        <div class="row" id="backgroundDiv">
            <div class="col-md-5">
                <h4><strong><?php echo t('Background Image')?></strong></h4>
            </div>
            <div class="col-md-7">
                <?php
                if($boxed_design==0)
                {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Attention!').'</strong><p>'.t('For activate this Image please disable first the Boxed Mode!').'</p></div>';
                }
                else
                {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $al->image('background_image', 'background_image', t('Select Background'), $background_image); ?>
                        </div>
                        <div class="col-md-6">
                            <label for="background_fix"> <?php echo $form->checkbox('background_fix', 1, $background_fix). ' ' .t('Fix Background Image')?></label>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-12"><hr></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo $form->submit('submit', t('Save'), array('class'=>'btn btn-primary'))?>
            </div>
        </div>
    </form>
</div>
<style type="text/css"> label { cursor: pointer; } </style>
<?php echo Core::make('helper/concrete/dashboard')->getDashboardPaneFooterWrapper();?>
<script>
    $(document).ready(function(){
        $("input[name='stickymenu_active']").click(function(){
            preventObj = <?php if(is_object($second_stickymenu_gfx)){ echo 'true';} else { echo 'false'; }?>;
            switch ($(this).val()){
                case '0':
                    $(".stickySetupUpload").fadeOut('fast');
                    $(".stickySetupData").fadeOut('fast');
                    break;
                case '1':
                    $(".stickySetupUpload").fadeIn('fast');
                    (preventObj) ? $(".stickySetupData").fadeIn('fast') : '';
                    break;
                case '2':
                    $(".stickySetupUpload").fadeIn('fast');
                    (preventObj) ? $(".stickySetupData").fadeIn('fast') : '';
                    break;
            }
        });
    });
</script>