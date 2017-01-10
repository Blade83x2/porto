<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$navItems = $controller->getNavItems();
if(!is_object($c))
{
    $c = Page::getCurrentPage();
}
?>
<div class="row">
    <div class="col-md-12">
        <?php
        $links = array();
        foreach ($navItems as $ni)
        {
            if (!$ni->isHome && $ni->cID != $c->cID)
            {
                $links[] = '<li><a href="' . $ni->url . '" target="' . $ni->target . '">' . $ni->name . '</a></li>';
            }
        }
        if (count($links)>0)
        {
            $db = \Database::connection();
            $portoSetup = $db->getRow('SELECT breadcrump_banner_text FROM PortoPackage WHERE cID=?', array(1));
            if(!empty($portoSetup['breadcrump_banner_text'])){
                echo $portoSetup['breadcrump_banner_text'];
            }
            echo '<ul class="breadcrumb">'.implode("", $links).'</ul>';
        }
        ?>
    </div>
</div>