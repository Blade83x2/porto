<?php
defined('C5_EXECUTE') or die("Access Denied.");
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
$db = Database::getActiveConnection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
$this->inc('inc/headerTypes/'.$portoSetup['header_type'].'.php', array('portoSetup' => $portoSetup));
?>
<script type="text/javascript">
$(function() {
    $('i.icon-question-sign').parent().tooltip();
});
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $a = new \Concrete\Core\Area\Area('Main');
            $a->display($c);
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="post" action="<?php echo $view->action('save')?>" enctype="multipart/form-data">
                <?php  $attribs = UserAttributeKey::getEditableInProfileList();
                if(is_object($valt) && method_exists($valt, 'output'))
                {
                    $valt->output('profile_edit');
                }
                ?>
                <fieldset>
		    <legend><?php echo t('Settings')?></legend>
                    <?php
                    if(is_object($profile) && method_exists($profile, 'getUserEmail'))
                    { ?>
			<div class="form-group">
			    <label for="uEmail" class="col-sm-2 control-label"><?php echo t('Email')?></label>
			    <div class="col-sm-10">
			      <?php echo $form->text('uEmail',$profile->getUserEmail(), array('class'=>'btn control-label')) ?>
			    </div>
			</div>
                    <?php } ?>

                    <?php  if (Config::get('concrete.misc.user_timezones')) { ?>
			<div class="form-group">
			    <label for="uTimezone" class="col-sm-2 control-label"><?php echo t('Time Zone')?></label>
			    <div class="col-sm-10">
				<?php echo  $form->select('uTimezone', Core::make('helper/date')->getTimezones(), ($profile->getUserTimezone()?$profile->getUserTimezone():date_default_timezone_get())); ?>
			    </div>
			</div>
                    <?php  } ?>

                    <?php  if (is_array($locales) && count($locales)) { ?>
			<div class="form-group">
			    <label for="uDefaultLanguage" class="col-sm-2 control-label"><?php echo t('Language')?></label>
			    <div class="col-sm-10">
				<?php echo $form->select('uDefaultLanguage', $locales, Localization::activeLocale(), array('class'=>'btn control-label'))?>
			    </div>
			</div>
                    <?php  } ?>
		</fieldset>
		
                <br/>
                <fieldset>
                    <legend><?php echo t('Change Password')?></legend>
			<div class="form-group">
			    <label for="uPasswordNew" class="col-sm-2 control-label"><?php echo t('New Password')?></label>
			    <div class="col-sm-10">
				<?php echo $form->password('uPasswordNew', array('class'=>'btn control-label'))?>
				<a href="javascript:void(0)" title="<?php echo t("Leave blank to keep current password.")?>"><i class="icon-question-sign"></i></a>
			    </div>
			</div>
			<div class="form-group">
			    <label for="uPasswordNewConfirm" class="col-sm-2 control-label"><?php echo t('Confirm New Password')?></label>
			    <div class="col-sm-10">
				<?php echo $form->password('uPasswordNewConfirm', array('class'=>'btn control-label'))?>
			    </div>
			</div>
                </fieldset>
		<br />
		
		
                <fieldset>
		    <legend><?php echo t('Attributes')?></legend>
		    <?php
		    if(is_array($attribs) && count($attribs))
		    {
			    $af = Core::make('helper/form/attribute');
			    $af->setAttributeObject($profile);
			    foreach($attribs as $ak)
			    {
				    ?>
				    
				      
					    <div class="form-group">
						    <div class="col-sm-12">
							    <?php print $af->display($ak, $ak->isAttributeKeyRequiredOnProfile());?>
						    </div>
					    </div>
					
				    
				    <?php
			    }
		    }      
		    ?>
                </fieldset>
                <br />
                
                
                
                
                
                <?php
                $ats = AuthenticationType::getList(true, true);
                $ats = array_filter($ats, function(AuthenticationType $type) {
                    return $type->hasHook();
                });
                $count = count($ats);
                if ($count) 
                {
                    ?>
                    <fieldset>
                        <legend><?php echo t('Authentication Types')?></legend>
                        <?php
                        foreach ($ats as $at) 
                        {
			    echo '<div class="col-md-12">';
                            $at->renderHook();
                            echo '</div>';
                        }
                        ?>
                    </fieldset>
		    <?php
                }
                ?>
                <br />
                <br />
                <br />


		<div class="form-group">
		    <div class="col-sm-12">
			<div class="form-actions">
			    <input type="submit" name="save" value="<?php echo t('Save')?>" class="btn btn-primary" />
			    <a href="<?php echo URL::to('/account')?>" class="btn btn-default" /><?php echo t('Back to Account')?></a>
			</div>
		    </div>
		</div>
            </form>
            <br />
            <br />
            <br />
            <br /><br /><br /><br />
        </div>
    </div>
</div>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>