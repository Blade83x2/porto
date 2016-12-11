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
<?php
}
$c = \Concrete\Core\Page\Page::getCurrentPage();
$dh = Core::make('helper/date');
$date = $dh->formatDateTime($c->getCollectionDatePublic(), true);
$tags = $c->getAttribute('tags');
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-posts single-post">
                    <article class="post post-large blog-single-post">
                        <div class="post-image">
                            <?php $ai = new Area('Blog Post Header'); $ai->display($c); ?>
                        </div>

                        <div class="post-date">
                            <span class="day"><?php echo date("d",strtotime($date)); ?></span>
                            <span class="month"><?php echo date("M",strtotime($date)); ?></span>
                        </div>
                        <div class="post-content">
                            <?php echo '<p><h4>'.$c->getCollectionDescription().'</h4></p>';?>
                            <div class="post-meta">
                                <span><i class="fa fa-user"></i> <a href="#"><?php echo $c->getVersionObject()->getVersionAuthorUserName()?></a> </span>
                                <?php
                                $tags = explode(' ', trim($tags));
                                if (count($tags)>1){
                                    echo '<span><i class="fa fa-tag"></i>';
                                    for($k=0; $k<count($tags); $k++)
                                    {
                                        echo $tags[$k].' ';
                                    }
                                    echo '</span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="post-content">
                            <?php $as = new Area('Main'); $as->display($c); ?>
                        </div>
                        <div class="post-content">
                            <?php $a = new Area('Blog Post More'); $a->display($c); ?>
                        </div>
                        <div class="post-content">
                            <?php $ai = new Area('Blog Post Footer'); $ai->display($c); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>
