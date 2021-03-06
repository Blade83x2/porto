<?php defined('C5_EXECUTE') or die("Access Denied.");
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
?>
<footer class="short" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php
                if ($portoSetup['page_logo_mini'] != 0)
                {
                    if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['page_logo_mini']) ))
                    {
                        ?>
                        <div class="logo">
                            <a href="<?php echo BASE_URL?>">
                                <img alt="" class="img-responsive" src="<?php echo \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['page_logo_mini'])?>">
                            </a>
                        </div>
                        <br>
                        <?php
                    }
                }
                $a = new GlobalArea('Footer Site Title');
                $a->display();
                if ($portoSetup['load_footerinfotext_from_metadescription'] == 1)
                {
                    $home = \Concrete\Core\Page\Page::getByID(HOME_CID);
                    if(trim($home->getCollectionAttributeValue('meta_description'))!='')    echo '<p>'.$home->getCollectionAttributeValue('meta_description').'</p>';
                    elseif(trim($home->getCollectionDescription())!='')                     echo '<p>'.$home->getCollectionDescription().'</p>';
                    unset($home);
                }
                ?>
            </div>
            <div class="col-md-3">
                <?php
                $a = new \Concrete\Core\Area\GlobalArea('Footer Navigation');
                $a->display();
                ?>
            </div>
            <div class="col-md-3">
                <?php
                $a = new \Concrete\Core\Area\GlobalArea('Footer Navigation 2');
                $a->display();
                ?>
            </div>
            <div class="col-md-3">
                <?php
                $a = new \Concrete\Core\Area\GlobalArea('Footer Navigation 3');
                $a->display();
                ?>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-right"  style="padding-top:29px;">
                    <?php
                    $a = new GlobalArea('Footer Legal');
                    $a->display();
                    ?>
                    <p>
                        <?php
                        if ($portoSetup['footer_copyright'] != '')
                        {
                            echo htmlentities(preg_replace('/%Y/', date("Y"), $portoSetup['footer_copyright']), ENT_QUOTES, APP_CHARSET);
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
