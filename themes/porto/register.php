<?php
defined('C5_EXECUTE') or die("Access Denied.");
$token = \Core::make('Concrete\Core\Validation\CSRF\Token');

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
$db = \Database::connection();
$portoSetup = $db->GetRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
$this->inc('inc/headerTypes/'.$portoSetup['header_type'].'.php', array('portoSetup' => $portoSetup));
$attribs = UserAttributeKey::getRegistrationList();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $a = new \Concrete\Core\Area\Area('Main');
            $a->display($c);
            if($c->isEditMode())
            {
                echo '<div style="min-height:50px;"></div>';
            }
            ?>
	    </div>
    </div>
</div>
<div class="container">
    <?php
    if($error) { ?>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?php
                    View::element('system_errors', array('error' => $error), 'porto');
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if($registerSuccess) { ?>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <?php	switch($registerSuccess) {
                    case "registered":
                        ?>
                        <p><strong><?php echo $successMsg ?></strong><br/><br/>
                            <a href="<?php echo $view->url('/')?>"><?php echo t('Return to Home')?></a></p>
                        <?php
                        break;
                    case "validate":
                        ?>
                        <p><?php echo $successMsg[0] ?></p>
                        <p><?php echo $successMsg[1] ?></p>
                        <p><a href="<?php echo $view->url('/')?>"><?php echo t('Return to Home')?></a></p>
                        <?php
                        break;
                    case "pending":
                        ?>
                        <p><?php echo $successMsg ?></p>
                        <p><a href="<?php echo $view->url('/')?>"><?php echo t('Return to Home')?></a></p>
                        <?php
                        break;
                } ?>
            </div>
        </div>
    <?php } else { ?>
        <form method="post" action="<?php echo $view->url('/register', 'do_register')?>" class="form-stacked">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <fieldset>
                        <legend><?php echo t('Your Details')?></legend>
                        <?php if ($displayUserName)
                        {
                            ?>
                            <div class="form-group">
                                <?php echo $form->label('uName',t('Username'))?>
                                <?php echo $form->text('uName')?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo $form->label('uEmail',t('Email Address'))?>
                            <?php echo $form->text('uEmail')?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->label('uPassword',t('Password'))?>
                            <?php echo $form->password('uPassword')?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->label('uPasswordConfirm',t('Confirm Password'))?>
                            <?php echo $form->password('uPasswordConfirm')?>
                        </div>
                    </fieldset>
                </div>
            </div>
            <?php
            if (count($attribs) > 0)
            {
                ?>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <fieldset>
                            <legend><?php echo t('Options')?></legend>
                            <?php
                            $af = Core::make('helper/form/attribute');
                            foreach($attribs as $ak)
                            {
                                echo $af->display($ak, $ak->isAttributeKeyRequiredOnRegister());
                            }
                            ?>
                        </fieldset>
                    </div>
                </div>
            <?php
            }
            if (Config::get('concrete.user.registration.captcha')) {
                ?>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group">
                            <?php
                            $captcha = Core::make('helper/validation/captcha');
                            echo $captcha->label();
                            $captcha->showInput();
                            $captcha->display();
                            ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-actions">
                        <?php $token->output('register.do_register') ?>
                        <?php echo $form->hidden('rcID', $rcID); ?>
                        <?php echo $form->submit('register', t('Register') . ' &gt;', array('class' => 'btn-lg btn-primary'))?>
                    </div>
                </div>
            </div>
        </form>
    <?php } ?>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
	    <?php
	    $a = new \Concrete\Core\Area\Area('Main 2');
	    $a->display($c);
	    if($c->isEditMode()){ echo '<div style="min-height:50px;"></div>'; }
	    ?>
	</div>
    </div>
</div>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>