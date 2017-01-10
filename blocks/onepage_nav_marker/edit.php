<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
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
$home = \Concrete\Core\Page\Page::getByID(HOME_CID);
$current = \Concrete\Core\Page\Page::getCurrentPage();
$current = $current->getCollectionThemeObject();
$IDsInUse = array();
foreach($controller->getUsedIDs() as $k)
{
    array_push($IDsInUse, $k['pID']);
}
if($current->getThemeHandle() != 'onepage')
{
    ?>
    <div class="alert alert-danger alert-dismissible">
         <strong><?php echo t('Error')?></strong><br>
        <?php echo t('This Blocktype works only with the <b>Porto OnePage Template</b>!')?><br>
        <?php echo t('The current Theme for this Page is:')?> <b><?php echo $current->getThemeName()?></b>
    </div>
    <?php
}
?>
<p>
    <b><?php echo t('Import the content from other Pages to this OnePage here. If you click on a Navigation point, the page scrolls to this position!')?></b>
</p>

<div class="form-group form-group-md">
    <label for="pID" class="col-md-5 control-label"><?php echo t('Include Page &amp; Navigation')?> <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('Select Page to include the content in this OnePage Theme.')?>"></i></label>
    <div class="col-md-6 col-md-offset-1">
        <select class="form-control pointer" id="pID" name="pID" style="color: #006699">
            <?php
            $disabled = "";
            if(in_array(HOME_CID, $IDsInUse))
            {
                #$disabled = " disabled=\"disabled\"";
            }
            ?>
            <option value="<?php echo HOME_CID?>"<?php if (intval($pID)==HOME_CID) { echo ' selected="selected"'; } echo $disabled;?>><?php echo t($home->getCollectionName())?></option>
            <?php
            $list = new PageList();
            $list->filterByParentID(HOME_CID);
            $list->filterByAttribute('exclude_nav', 0, 'LIKE');
            $list->sortByDisplayOrder();
            $page = $list->get();
            for($s=0; $s<count($page); $s++)
            {
                $disabled = "";
                #if(in_array($page[$s]->getCollectionID(), $IDsInUse))
                #{
                #    $disabled = " disabled=\"disabled\"";
                #}
                echo '<option value="'.$page[$s]->getCollectionID().'"'.((intval($pID)==$page[$s]->getCollectionID())?' selected="selected"':'').$disabled.'>'.t($page[$s]->getCollectionName()).'</option>';

                $list2 = new PageList();
                $list2->filterByParentID($page[$s]->getCollectionID());
                $list->filterByAttribute('exclude_nav', 0, 'LIKE');
                $list2->sortByDisplayOrder();
                $page2 = $list2->get();
                for($k=0; $k<count($page2); $k++)
                {
                    $disabled = "";
                    if(in_array($page2[$k]->getCollectionID(), $IDsInUse))
                    {
                        #$disabled = " disabled=\"disabled\"";
                    }
                    echo '<option value="'.$page2[$k]->getCollectionID().'"'.((intval($pID)==$page2[$k]->getCollectionID())?' selected="selected"':'').$disabled.'> --&gt; '.t($page2[$k]->getCollectionName()).'</option>';
                    $list3 = new PageList();
                    $list3->filterByParentID($page2[$k]->getCollectionID());
                    $list->filterByAttribute('exclude_nav', 0, 'LIKE');
                    $list3->sortByDisplayOrder();
                    $page3 = $list3->get();
                    for($i=0; $i<count($page3); $i++)
                    {
                        $disabled = "";
                        if(in_array($page3[$i]->getCollectionID(), $IDsInUse))
                        {
                            #$disabled = " disabled=\"disabled\"";
                        }
                        echo '<option value="'.$page3[$i]->getCollectionID().'"'.((intval($pID)==$page3[$i]->getCollectionID())?' selected="selected"':'').$disabled.'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&gt; '.t($page3[$i]->getCollectionName()).'</option>';
                    }
                }
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group form-group-md">
    <label class="col-md-5 control-label"><?php echo t('Included Areas from Page')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('Select your Area to include its content. If you only want to set a link for the scrolleffect, select nothing!')?>"></i>
    </label>
    <div class="col-md-5 col-md-offset-1">
        <?php
            $db = Database::connection();
            $r = $db->executeQuery("SELECT DISTINCT arID, arHandle FROM Areas WHERE arParentID=0 AND arIsGlobal=0 AND cID=?", array($pID));
            while ($row = $r->FetchRow())
            {
                echo "<label><input type='checkbox' name='arID".$row['arID']."' id='arID".$row['arID']."' value='1' ".((${"arID".$row['arID']}==1)?'checked="checked"':'')."/>&nbsp;". trim($row['arHandle'])."</label>&nbsp;&nbsp;";
            }
            $r->Free();
        ?>
    </div>
</div>
<?php if (is_object($p = Page::getCurrentPage())) { ?>
<input type="hidden" name="onPageID" id="onPageID" value="<?php echo $p->getCollectionID()?>">
<?php } ?>