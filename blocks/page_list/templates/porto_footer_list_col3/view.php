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
$th = Core::make('helper/text');
if (count($pages) > 0)
{
    $db = Database::getActiveConnection();
    $footer_type = $db->fetchColumn('SELECT footer_type FROM PortoPackage WHERE cID=?', array(1));
    if((int)$footer_type==3){
        echo '<ul class="list icons list-unstyled">';
        $i = '<i class="fa fa-caret-right"></i>';
    }
    else
    {
        echo '<ul class="nav nav-list primary push-bottom">';
        $i = '';
    }

    foreach ($pages as $page)
    {
        echo '<li>'.$i.'<a href="'.$nh->getLinkToCollection($page).'"'.(($page->cPointerExternalLinkNewWindow==1)?' target="_blank"':'').'>'.$th->entities($page->getCollectionName()).'</a></li>';
    }
    echo '</ul>';
}
unset($th);
?>