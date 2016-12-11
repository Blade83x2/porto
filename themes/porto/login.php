<?php
use Concrete\Core\Attribute\Key\Key;
use Concrete\Core\Http\ResponseAssetGroup;

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
$r = ResponseAssetGroup::get();
$r->requireAsset('javascript', 'underscore');
$r->requireAsset('javascript', 'core/events');
$r->requireAsset('core/legacy');


$activeAuths = AuthenticationType::getList(true, true);
$form = Core::make('helper/form');
$active = null;
if ($authType)
{
    $active = $authType;
    $activeAuths = array($authType);
}
$attribute_mode = (isset($required_attributes) && count($required_attributes));
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
	    <?php
	    $a = new \Concrete\Core\Area\Area('Main');
	    $a->display($c);
	    if($c->isEditMode()){ echo '<div style="min-height:50px;"></div>'; }
	    ?>
	</div>
    </div>
</div>
<?php
if($error) { ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">×</button>
                <?php
                View::element('system_errors', array('error' => $error), 'porto');
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div class="container">
    <div class="login-page">
        <div class="col-sm-8 col-sm-offset-2 login-form">
            <div class="row">
                <div class="visible-xs ccm-authentication-type-select form-group text-center">
                    <?php
                    if ($attribute_mode)
                    {
                        ?>
                        <i class="fa fa-question"></i>
                        <span><?php echo t('Attributes') ?></span>
                        <?php
                    }
                    else if (count($activeAuths) > 1)
                    {
                        ?>
                        <select class="form-control col-xs-12">
                            <?php
                            foreach ($activeAuths as $auth) {
                                ?>
                                <option value="<?php echo $auth->getAuthenticationTypeHandle() ?>">
                                    <?php echo $auth->getAuthenticationTypeName() ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php
                    }
                    ?>
                    <label>&nbsp;</label>
                </div>
            </div>
            <div class="row login-row">
                <div class="types col-sm-4 hidden-xs">
                    <ul class="auth-types" style="list-style: none">
                        <?php
                        if ($attribute_mode)
                        {
                            ?>
                            <li data-handle="required_attributes">
                                <i class="fa fa-question"></i>&nbsp;<span><?php echo t('Attributes') ?></span>
                            </li>
                            <?php
                        }
                        else
                        {
                            foreach ($activeAuths as $auth)
                            {
                                ?>
                                <li data-handle="<?php echo $auth->getAuthenticationTypeHandle() ?>">
                                    <?php echo $auth->getAuthenticationTypeIconHTML() ?><span>&nbsp;<?php echo $auth->getAuthenticationTypeName() ?></span>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="controls col-sm-8 col-xs-12">
                    <?php
                    if ($attribute_mode)
                    {
                        $attribute_helper = new Concrete\Core\Form\Service\Widget\Attribute();
                        ?>
                        <form action="<?php echo View::action('fill_attributes') ?>" method="POST">
                            <div data-handle="required_attributes" class="authentication-type authentication-type-required-attributes">
                                <div class="ccm-required-attribute-form" style="height:340px;overflow:auto;margin-bottom:20px;">
                                    <?php
                                    foreach ($required_attributes as $key) {
                                        echo $attribute_helper->display($key, true);
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary pull-right"><?php echo t('Submit') ?></button>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    else
                    {
                        foreach ($activeAuths as $auth)
                        {
                            ?>
                            <div data-handle="<?php echo $auth->getAuthenticationTypeHandle() ?>" class="authentication-type authentication-type-<?php echo $auth->getAuthenticationTypeHandle() ?>">
                                <?php $auth->renderForm($authTypeElement ?: 'form', $authTypeParams ?: array()) ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
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
<script type="text/javascript">
    (function ($) {
	"use strict";
	var forms = $('div.controls').find('div.authentication-type').hide(),
	    select = $('div.ccm-authentication-type-select > select');
	$('ul.auth-types').css({ cursor: 'pointer' });
	var types = $('ul.auth-types > li').each(function () {
	    var me = $(this),
		form = forms.filter('[data-handle="' + me.data('handle') + '"]');
	    me.click(function () {
		select.val(me.data('handle'));
		if (typeof Concrete !== 'undefined') {
		    Concrete.event.fire('AuthenticationTypeSelected', me.data('handle'));
		}
		if (form.hasClass('active')) return;
		types.removeClass('active');
		me.addClass('active');
		if (forms.filter('.active').length) {
		    forms.stop().filter('.active').removeClass('active').fadeOut(250, function () {
			form.addClass('active').fadeIn(250);
		    });
		} else {
		    form.addClass('active').show();
		}
	    });
	});
	select.change(function() {
	    types.filter('[data-handle="' + $(this).val() + '"]').click();
	});
	types.first().click();
	$('ul.nav.nav-tabs > li > a').on('click', function () {
	    var me = $(this);
	    if (me.parent().hasClass('active')) return false;
	    $('ul.nav.nav-tabs > li.active').removeClass('active');
	    var at = me.attr('data-authType');
	    me.parent().addClass('active');
	    $('div.authTypes > div').hide().filter('[data-authType="' + at + '"]').show();
	    return false;
	});
    })(jQuery);
</script>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>