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
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
?>
<div class="form-group form-group-md">
    <label for="createFromSubPages0" class="col-md-4 control-label"><?php echo t('Type')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="radio" name="createFromSubPages" id="createFromSubPages0" value="0"<?php if($createFromSubPages==0 || !isset($createFromSubPages)){echo ' checked="checked"';}?> />&nbsp;<label for="createFromSubPages0" class="control-label"><?php echo t('Single')?></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="createFromSubPages" id="createFromSubPages1" value="1"<?php if($createFromSubPages!=0){echo ' checked="checked"';}?> />&nbsp;<label for="createFromSubPages1" class="control-label"><?php echo t('Create from Page')?></label>&nbsp;&nbsp;&nbsp;&nbsp;

    </div>
</div>


<div class="form-group form-group-md">
    <label for="effect" class="col-md-4 control-label"><?php echo t('Loading Effect')?></label>
    <div class="col-md-6 col-md-offset-2">
        <select class="form-control" id="effect" name="effect">
            <option value="none"<?php if ($effect=='none') { echo ' selected="selected"';}?>><?php echo t('None')?></option>
            <option value="random"<?php if ($effect=='random') { echo ' selected="selected"';}?>><?php echo t('Random')?></option>
            <option value="fadeIn"<?php if ($effect=='fadeIn') { echo ' selected="selected"';}?>>fadeIn</option>
            <option value="fadeInUp"<?php if ($effect=='fadeInUp') { echo ' selected="selected"';}?>>fadeInUp</option>
            <option value="fadeInDown"<?php if ($effect=='fadeInDown') { echo ' selected="selected"';}?>>fadeInDown</option>
            <option value="fadeInLeft"<?php if ($effect=='fadeInLeft') { echo ' selected="selected"';}?>>fadeInLeft</option>
            <option value="fadeInRight"<?php if ($effect=='fadeInRight') { echo ' selected="selected"';}?>>fadeInRight</option>
            <option value="fadeInUpBig"<?php if ($effect=='fadeInUpBig') { echo ' selected="selected"';}?>>fadeInUpBig</option>
            <option value="fadeInDownBig"<?php if ($effect=='fadeInDownBig') { echo ' selected="selected"';}?>>fadeInDownBig</option>
            <option value="fadeInLeftBig"<?php if ($effect=='fadeInLeftBig') { echo ' selected="selected"';}?>>fadeInLeftBig</option>
            <option value="fadeInRightBig"<?php if ($effect=='fadeInRightBig') { echo ' selected="selected"';}?>>fadeInRightBig</option>
            <option value="bounceIn"<?php if ($effect=='bounceIn') { echo ' selected="selected"';}?>>bounceIn</option>
            <option value="bounceInUp"<?php if ($effect=='bounceInUp') { echo ' selected="selected"';}?>>bounceInUp</option>
            <option value="bounceInDown"<?php if ($effect=='bounceInDown') { echo ' selected="selected"';}?>>bounceInDown</option>
            <option value="bounceInLeft"<?php if ($effect=='bounceInLeft') { echo ' selected="selected"';}?>>bounceInLeft</option>
            <option value="bounceInRight"<?php if ($effect=='bounceInRight') { echo ' selected="selected"';}?>>bounceInRight</option>
            <option value="rotateIn"<?php if ($effect=='rotateIn') { echo ' selected="selected"';}?>>rotateIn</option>
            <option value="rotateInUpLeft"<?php if ($effect=='rotateInUpLeft') { echo ' selected="selected"';}?>>rotateInUpLeft</option>
            <option value="rotateInDownLeft"<?php if ($effect=='rotateInDownLeft') { echo ' selected="selected"';}?>>rotateInDownLeft</option>
            <option value="rotateInUpRight"<?php if ($effect=='rotateInUpRight') { echo ' selected="selected"';}?>>rotateInUpRight</option>
            <option value="rotateInDownRight"<?php if ($effect=='rotateInDownRight') { echo ' selected="selected"';}?>>rotateInDownRight</option>
            <option value="flash"<?php if ($effect=='flash') { echo ' selected="selected"';}?>>flash</option>
            <option value="shake"<?php if ($effect=='shake') { echo ' selected="selected"';}?>>shake</option>
            <option value="bounce"<?php if ($effect=='bounce') { echo ' selected="selected"';}?>>bounce</option>
            <option value="tada"<?php if ($effect=='tada') { echo ' selected="selected"';}?>>tada</option>
            <option value="swing"<?php if ($effect=='swing') { echo ' selected="selected"';}?>>swing</option>
            <option value="wobble"<?php if ($effect=='wobble') { echo ' selected="selected"';}?>>wobble</option>
            <option value="wiggle"<?php if ($effect=='wiggle') { echo ' selected="selected"';}?>>wiggle</option>
        </select>
    </div>
</div>


<div class="form-group form-group-md"<?php if ($createFromSubPages==0 || !isset($createFromSubPages)){ echo ' style="display:none;"';}?> id="pageWithSubpagesDiv">
    <label for="pageWithSubpages" class="col-md-4 control-label"><?php echo t('Link to Page')?>

    </label>
    <div class="col-md-6 col-md-offset-2">
        <?php echo $pageselect->selectPage('pageWithSubpages', $pageWithSubpages);?>
    </div>
</div>

<div<?php if ($createFromSubPages==0 || !isset($createFromSubPages)){ echo ' style="display:none;"';}?> id="descriptionDiv">
    <div class="alert alert-warning alert-dismissible" role="alert">
        <p>
            <strong><?php echo t('This Block will try to read following Page Attributes from all Subpages of the selected Source Page')?></strong>
        </p>
        <br />
        <ul >
            <?php
            $attributeError = '<span style="color:#00ff00">'.t('Available').'</span>';
            $akDetailimage = \Concrete\Core\Attribute\Key\CollectionKey::getByHandle('detailimage');
            if ( is_null($akDetailimage) || !is_object($akDetailimage) || !intval($akDetailimage->getAttributeKeyID()) ) {
                $akThumbnail = \Concrete\Core\Attribute\Key\CollectionKey::getByHandle('thumbnail');
                if ( is_null($akThumbnail) || !is_object($akThumbnail) || !intval($akThumbnail->getAttributeKeyID()) ) {
                    $attributeError = '<span style="color:#ff0000">'.t('Not available').'</span>';
                }
            }
            ?>
            <li><?php echo t('Detail Image').' '.t('or').' '.t('Thumbnail Image')?> (<?php echo $attributeError?>)</li>
            <li><?php echo t('Description').' '.t('or').' '.t('Meta Description')?></li>
            <li><?php echo t('Link')?></li>
            <li><?php echo t('Created Time')?></li>
        </ul>
    </div>
</div>


<div class="form-group form-group-md" id="redirectToPageDiv"<?php if (isset($createFromSubPages) && $createFromSubPages!=0){ echo ' style="display:none;"';}?>>
    <label for="redirectToPage" class="col-md-4 control-label"><?php echo t('Link to Page')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('This is only visible if a Year is selected!')?>"></i>
    </label>
    <div class="col-md-6 col-md-offset-2">
        <?php echo $pageselect->selectPage('redirectToPage', $redirectToPage);?>
    </div>
</div>
<div class="form-group form-group-md" id="pictureDiv"<?php if (isset($createFromSubPages) && $createFromSubPages!=0){ echo ' style="display:none;"';}?>>
    <label for="picture" class="col-md-4 control-label"><?php echo t('Picture')?></label>
    <div class="col-md-6 col-md-offset-2">
        <?php echo $al->image('picture', 'picture', t('Select Image'), $picture); ?>
    </div>
</div>

<div class="form-group form-group-md" id="yearDiv"<?php if (isset($createFromSubPages) && $createFromSubPages!=0){ echo ' style="display:none;"';}?>>
    <label for="year" class="col-md-4 control-label"><?php echo t('Year')?></label>
    <div class="col-md-6 col-md-offset-2">
        <select class="form-control" id="year" name="year">
            <option value="none"><?php echo t('none')?></option>
            <?php
            $now = (int)date("Y");
            for ($i = $now; ; $i--)
            {
                if ($i <= ($now-151))
                    break;
                echo '<option value="'.$i.'"'.(($year==$i)?' selected="selected"':'').'>'.$i.'</option>';
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group-md" id="textDiv"<?php if (isset($createFromSubPages) && $createFromSubPages!=0){ echo ' style="display:none;"';}?>>
    <label for="text" class="col-md-12 control-label"><?php echo t('Text')?></label>
    <div class="col-md-12">
        <?php
        $editor = Core::make('editor');
        $editor->setAllowFileManager(true);
        $editor->setAllowSitemap(true);
        print $editor->outputStandardEditor('text', $text);
        ?>
    </div>
</div>
<script>
    var historyBlock = new HistoryBlock();
    historyBlock.setStartValueMode('<?php if (isset($createFromSubPages) && $createFromSubPages!=0){ echo 'page';}else{ echo 'single';}?>');
    $(document).ready(function() {
        $('#createFromSubPages0').on('click', function(){
            historyBlock.setMode('single');
        });
        $('#createFromSubPages1').on('click', function(){
            historyBlock.setMode('page');
        });
    });
</script>