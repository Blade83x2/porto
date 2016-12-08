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
=>  (c) ............... 2005-2015 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <?php
            if ($portoSetup['footer_ribbon'] != '')
            {
                ?>
                <div class="footer-ribbon">
                    <span><?php echo htmlentities($portoSetup['footer_ribbon'], ENT_QUOTES, APP_CHARSET)?></span>
                </div>
            <?php
            }
            ?>
            <div class="col-md-3">
                <div class="contact-details">
                    <?php
                    $a = new \Concrete\Core\Area\GlobalArea('Footer Contact');
                    $a->display();
                    ?>

                </div>
            </div>
            <div class="col-md-7">
                <div class="contact-details">
                    <?php
                    $a = new GlobalArea('Footer Site Title');
                    /*
                     * Globale areas haben irgendwie kein grid support
                     */
                    #$a->setAreaGridMaximumColumns(7);
                    #$a->enableGridContainer();
                    $a->display();
                    ?>

                </div>
            </div>
            <div class="col-md-2">
                <?php
                $a = new \Concrete\Core\Area\GlobalArea('Footer Social');
                $a->display();
                ?>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <?php
                if ($portoSetup['page_logo_mini'] != 0)
                {
                    if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['page_logo_mini']) ))
                    {
                        $hasLogo = true;
                        ?>
                        <div class="col-md-1">
                            <div class="logo">
                                <a href="<?php echo BASE_URL?>">
                                    <img alt="" class="img-responsive" src="<?php echo \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['page_logo_mini'])?>">
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
                <div class="col-md-<?php echo ((isset($hasLogo) && $hasLogo==true)?'4':'5')?>">
                    <?php

                    if ($portoSetup['footer_copyright'] != '')
                    {
                        echo htmlentities(preg_replace('/%Y/', date("Y"), $portoSetup['footer_copyright']), ENT_QUOTES, APP_CHARSET);
                    }

                    $a = new GlobalArea('Footer Legal');
                    $a->display();


                    ?>

                </div>
                <div class="col-md-7">
                    <?php
                    $home = \Concrete\Core\Page\Page::getByID(HOME_CID);
                    if (is_array($childreenArray=$home->getCollectionChildrenArray()) && count($childreenArray) > 0)
                    {
                        $displayLinks = array();
                        foreach($childreenArray as $key => $childId)
                        {
                            $child = \Concrete\Core\Page\Page::getByID($childId);
                            if ($child->getAttribute('porto_link_show_in_footer'))
                            {
                                array_push($displayLinks, $child);
                            }
                        }
                        if (count($displayLinks) > 0)
                        {
                            $th = Core::make('helper/text');
                            $nh = Core::make('helper/navigation');
                            echo '<nav id="sub-menu"><ul>';
                            foreach($displayLinks as $childPage)
                            {
                                echo '<li><a href="'.$nh->getLinkToCollection($childPage).'">'.$th->entities($childPage->getCollectionName()).'</a></li>';
                            }
                            echo '</ul></nav>';
                            unset($th, $nh);
                        }
                        unset($displayLinks, $childreenArray);
                    }
                    unset($home);
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>