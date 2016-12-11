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
        <div class="col-md-10 col-md-offset-1">
            <div class="row" style="margin-top: 30px;">
                <?php foreach($pages as $p) { ?>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><a href="<?php echo $p->getCollectionLink()?>"><?php echo h(t($p->getCollectionName()))?></a></h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                $description = $p->getCollectionDescription();
                                if ($description) { ?>
                                    <a href="<?php echo $p->getCollectionLink()?>"><?php echo h(t($description))?></a>
                                <?php } ?>
                            </div>
                        </div>
                     </div>
                <?php } ?>

                <?php if (Config::get('concrete.user.profiles_enabled')) { ?>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><a href="<?php echo URL::to('/members/profile')?>"><?php echo t("View Public Profile")?></a></h3>
                            </div>
                            <div class="panel-body">
                                <a href="<?php echo URL::to('/members/profile')?>"><?php echo t('View your public user profile and the information you are sharing.')?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
            ?>
        </div>
    </div>
</div>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>