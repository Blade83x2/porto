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
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
if (!$c->isEditMode()) { ?>
<nav id="footernav" class="navbar navbar-default navbar-fixed-bottom" style="<?php if ($c->isEditMode() && isset($portoSetup['boxed_design']) && $portoSetup['boxed_design']==1) { ?> position:relative;<?php } ?>">
<?php } ?>
    <div class="<?php if (isset($portoSetup['boxed_design']) && $portoSetup['boxed_design']==1) echo 'container'; else echo 'full-width';?>">
        <div class="row">
            <div class="col-md-12">
                <div style="float:left">
                <?php
                $a = new GlobalArea('Footer Legal');
                $a->display();
                ?>
                <?php
                if ($portoSetup['footer_copyright'] != '')
                {
                    echo "&nbsp;&nbsp;".htmlentities(preg_replace('/%Y/', date("Y"), $portoSetup['footer_copyright']), ENT_QUOTES, APP_CHARSET);
                }
                ?>
                </div>
                <div style="float:right">
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

                        foreach($displayLinks as $childPage)
                        {
                            echo '<a href="'.$nh->getLinkToCollection($childPage).'">'.$th->entities($childPage->getCollectionName()).'</a>&nbsp;&nbsp;';
                        }
                        echo "&nbsp;&nbsp;&nbsp;";
                        unset($th, $nh);
                    }
                    unset($displayLinks, $childreenArray);
                }
                ?>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
<?php if (!$c->isEditMode()) { ?>
</nav>
<?php 
} 
$view = \view::getInstance();
$view->addHeaderItem('<style type="text/css"> html.boxed .body { margin-bottom:80px; } </style>');




?>
