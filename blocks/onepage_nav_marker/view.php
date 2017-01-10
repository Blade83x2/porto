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
{
    ?>
    <div id="id<?php echo $pID?>"></div>
    <?php
    $c = Page::getCurrentPage();
    $p = Page::getByID((int)$pID);
    if ($c->isEditMode())
    {
        if(is_object($p) && !$p->isError() && $p->isActive())
        {
            ?>
            <div class="ccm-edit-mode-disabled-item">
                <div style="padding:8px 0px;"><b><?php echo t('OnePage Nav Marker').':</b> '.t($p->getCollectionName()); ?><br />
                <?php
		    $db = Database::getActiveConnection();
		    $areasc = unserialize($areas);
		    $areaCount = array();
		    foreach ($areasc as $key => $val)
		    {
			$all = $db->fetchAll("SELECT arHandle FROM Areas WHERE arID=? AND cID=? AND arIsGlobal=?", array(substr($key, 4), intval($pID), 0));
			if($val==1)
			{
			    if(strlen($all[0]['arHandle'])>0)
			    {
				$areaCount[] = $all[0]['arHandle'];
			    }
			}
		    }
		    if (count($areaCount)>0){
			$areaCount = implode(", ", $areaCount);
			echo '<span style="color:#004400">'.t('Included Areas').': <b>'.$areaCount.'</b></span>';
		    }
		    else
		    {
			echo '<span style="color:#ff0000">'.t('No Included Areas!').'</span>';
		    }
                ?>
                </div>
            </div>
        <?php
        }
        elseif( !$p->isActive())
        {
            ?>
            <div class="ccm-edit-mode-disabled-item">
                <div style="padding:8px 0px;">
		    <b><?php echo t('OnePage Nav Marker')?>:</b> 
		    <span style="color:#ff0000"><?php echo t($p->getCollectionName()).' '.t('is not active')?></span>
		</div>
            </div>
	    <?php
        }
        elseif( $p->isError()){
            
            ?>
            <div class="ccm-edit-mode-disabled-item">
                <div style="padding:8px 0px;">
		    <b><?php echo t('OnePage Nav Marker')?>:</b> 
		    <span style="color:#ff0000"><?php echo t($p->getCollectionName()).' '.t('is error')?></span>
		</div>
            </div>
	    <?php
        }
    }



    if(is_object($p) && !$p->isError() && $p->cID > 0 && $p->isActive())
    {
        ?>

        <?php
        $db = Database::getActiveConnection();
        $areas = unserialize($areas);
        foreach ($areas as $key => $val)
        {
            $all = $db->fetchAll("SELECT arHandle FROM Areas WHERE arID=? AND cID=? AND arIsGlobal=?", array(substr($key, 4), intval($pID), 0));
            if($val==1)
            {
                if(strlen($all[0]['arHandle'])>0)
                {
                    if (!$c->isEditMode())
		    {
			$a = new Area($all[0]['arHandle']);
			$a->display(Page::getByID($pID));
		    }
                }
            }
        }
    }
}
?>