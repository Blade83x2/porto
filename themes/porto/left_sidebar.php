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
if ($portoSetup['breadcrump_banner_active']==1) { ?>
    <section class="page-top">
        <div class="container">
            <?php if(is_object($c) && $c->cID != HOME_CID) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $bt = BlockType::getByHandle('autonav');
                        $bt->controller->displayPages = 'top_level';
                        $bt->controller->orderBy = 'display_asc';
                        $bt->controller->displaySubPages = 'relevant_breadcrumb';
                        $bt->controller->displaySubPageLevels = 'enough';
                        $bt->render('templates/porto_breadcrump');
                        ?>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
					<h2><?php if(is_object($c)) { echo t($c->getCollectionName()); }  ?></h2>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
            $a = new \Concrete\Core\Area\Area('Sidebar');
            $a->display($c);
            if (is_object($c) && $c->isEditMode()) {
                echo '<div style="min-height:40px;"></div>';
            }
            $a = new \Concrete\Core\Area\Area('Sidebar Footer');
            $a->display($c);
            ?>
        </div>
        <div class="col-md-9">
            <?php
            $a = new \Concrete\Core\Area\Area('Main');
            $a->display($c);
            ?>
        </div>
    </div>
</div>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>