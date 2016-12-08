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
<footer class="short" id="footer">
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-4" style="padding-top:29px;">
                    <?php
                    $a = new GlobalArea('Footer Legal');
                    $a->display();
                    ?>
                    <?php
                    if ($portoSetup['footer_copyright'] != '')
                    {
                        echo htmlentities(preg_replace('/%Y/', date("Y"), $portoSetup['footer_copyright']), ENT_QUOTES, APP_CHARSET);
                    }
                    ?>
                </div>
                <div class="col-md-8" style="padding-top:29px;">
                    <?php
                    $home = \Concrete\Core\Page\Page::getByID(HOME_CID);
                    if (is_array($childreenArray=$home->getCollectionChildrenArray()) && count($childreenArray) > 0)
                    {
                        unset($home);
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
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>