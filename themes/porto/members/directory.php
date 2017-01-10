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

=>  Coder:    $ Blade83
*/
$db = Database::getActiveConnection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
$this->inc('inc/headerTypes/'.$portoSetup['header_type'].'.php', array('portoSetup' => $portoSetup));
?>
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
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-12 text-right">

            <!-- sicherheitstooken -->

            <form method="get" action="<?php echo $view->action('search_members')?>" class="navbar-form">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-user-md"> <?php echo t('Username')?></i>
                        </button>
                    </span>
                    <input type="text" name="keywords" id="keywords" class="form-control" value="<?php echo $keywords?>" placeholder="<?php echo t('User')?>" autocomplete="off">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit" value="<?php echo t('Search')?>">
                            <i class="fa fa-search"> <?php echo t('Search')?> </i>
                        </button>
                    </span>
                </div>
            </form>
            <?php if ($total == 0)
            {
                ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-bullhorn"></i> <strong> <?php echo t('No users found.')?></strong>
                </div>
                <?php
            }?>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php if ($total != 0) { ?>
            <div class="table-responsive">
                <table class="table table-responsive table-striped table-hover table-condensed table-bordered" id="ccm-members-directory">
                    <?php
                    $av = \Core::make('helper/concrete/avatar');
                    $u = new User();
                    foreach($users as $user)
                    {
                        ?>
                        <tr>
                            <td class="ccm-members-directory-avatar">
                                <a href="<?php echo $view->url('/members/profile','view', $user->getUserID())?>">
                                    <?php echo $av->outputUserAvatar($user)?>
                                </a>
                            </td>
                            <td class="ccm-members-directory-name">
                                <a href="<?php echo $view->url('/members/profile','view', $user->getUserID())?>">
                                    <?php echo ucfirst($user->getUserName())?>
                                </a>
                            </td>
                            <?php foreach($attribs as $ak) { ?>
                            <td>
                                <?php echo $user->getAttribute($ak, 'displaySanitized', 'display'); ?>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
                <?php if ($pagination->haveToPaginate()) { ?>
                    <?php echo $pagination->renderDefaultView();?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $a = new \Concrete\Core\Area\Area('Main 2');
            $a->display($c);
            ?>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#keywords").focus();
    });
</script>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>