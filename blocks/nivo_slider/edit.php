<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
use Concrete\Core\File\Set;
use Concrete\Core\File\Type\Type as FileType;
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
<div class="row">
    <div class="col-md-4">
        <label for="filesetid"><?php echo t('Image File Set')?></label>
    </div>
    <div class="col-md-8">
        <select name="filesetid" id="filesetid" class="form-control">
            <option value="">&nbsp;</option>
            <?php
            $filesets = FileSet::getMySets();
            foreach ($filesets as $fset)
            {
                $fileList = new FileList();
                $fileList->filterBySet(FileSet::getByID($fset->getFileSetId()));
                $fileList->filterByType(FileType::T_IMAGE);
                if ($controller->getFileSetID() == $fset->getFileSetId())
                {
                    $select = ' selected="selected" ';
                }
                else {
                    $select = '';
                }
                echo "<option " . $select . " value=\"" . $fset->getFileSetId() . "\">" . $fset->getFileSetName()." (".count($fileList->get()) . ")</option>";
            }
            ?>
        </select>
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="effect"><?php echo t('Effect')?></label>
    </div>
    <div class="col-md-8">
        <select class="form-control" id="effect" name="effect">
            <option value="none"<?php if ($effect=='none') { echo ' selected="selected"';}?>><?php echo t('None')?></option>
            <option value="random"<?php if ($effect=='random') { echo ' selected="selected"';}?>><?php echo t('Random')?></option>
            <option value="sliceDown"<?php if ($effect=='sliceDown') { echo ' selected="selected"';}?>>sliceDown</option>
            <option value="sliceDownLeft"<?php if ($effect=='sliceDownLeft') { echo ' selected="selected"';}?>>sliceDownLeft</option>
            <option value="sliceUp"<?php if ($effect=='sliceUp') { echo ' selected="selected"';}?>>sliceUp</option>
            <option value="sliceUpLeft"<?php if ($effect=='sliceUpLeft') { echo ' selected="selected"';}?>>sliceUpLeft</option>
            <option value="sliceUpDown"<?php if ($effect=='sliceUpDown') { echo ' selected="selected"';}?>>sliceUpDown</option>
            <option value="sliceUpDownLeft"<?php if ($effect=='sliceUpDownLeft') { echo ' selected="selected"';}?>>sliceUpDownLeft</option>
            <option value="fold"<?php if ($effect=='fold') { echo ' selected="selected"';}?>>fold</option>
            <option value="fade"<?php if ($effect=='fade') { echo ' selected="selected"';}?>>fade</option>
            <option value="slideInRight"<?php if ($effect=='slideInRight') { echo ' selected="selected"';}?>>slideInRight</option>
            <option value="slideInLeft"<?php if ($effect=='slideInLeft') { echo ' selected="selected"';}?>>slideInLeft</option>
            <option value="boxRandom"<?php if ($effect=='boxRandom') { echo ' selected="selected"';}?>>boxRandom</option>
            <option value="boxRain"<?php if ($effect=='boxRain') { echo ' selected="selected"';}?>>boxRain</option>
            <option value="boxRainReverse"<?php if ($effect=='boxRainReverse') { echo ' selected="selected"';}?>>boxRainReverse</option>
            <option value="boxRainGrow"<?php if ($effect=='boxRainGrow') { echo ' selected="selected"';}?>>boxRainGrow</option>
            <option value="boxRainGrowReverse"<?php if ($effect=='boxRainGrowReverse') { echo ' selected="selected"';}?>>boxRainGrowReverse</option>
        </select>
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="animateSpeed"><?php echo t('Animate Speed')?> (ms)</label>
    </div>
    <div class="col-md-8">
        <input class="form-control" type="number" name="animateSpeed" id="animateSpeed" value="<?php echo $animateSpeed?>" placeholder="500" />
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="animateInterval"><?php echo t('Animate Interval')?> (ms)</label>
    </div>
    <div class="col-md-8">
        <input class="form-control" type="number" name="animateInterval" id="animateInterval" value="<?php echo $animateInterval?>" placeholder="4000" />
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="directionNavArrows"><?php echo t('Show directionNav Arrows')?></label>
    </div>
    <div class="col-md-8">
        <select class="form-control" id="directionNavArrows" name="directionNavArrows">
            <option value="0"<?php if ($directionNavArrows=='0') { echo ' selected="selected"';}?>><?php echo t('No')?></option>
            <option value="1"<?php if ($directionNavArrows=='1') { echo ' selected="selected"';}?>><?php echo t('Yes')?></option>
        </select>
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="generateNavThumbs"><?php echo t('Generate Navigation Thumbs')?></label>
    </div>
    <div class="col-md-8">
        <select class="form-control" id="generateNavThumbs" name="generateNavThumbs">
            <option value="0"<?php if ($generateNavThumbs=='0') { echo ' selected="selected"';}?>><?php echo t('No')?></option>
            <option value="1"<?php if ($generateNavThumbs=='1') { echo ' selected="selected"';}?>><?php echo t('Yes')?></option>
        </select>
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="bulseyeArrows"><?php echo t('Show Bulseeye Arrows')?><br /><small><?php echo t('Needs Navigation Thumbs: ').t('No')?></small></label>
    </div>
    <div class="col-md-8">
        <select class="form-control" id="bulseyeArrows" name="bulseyeArrows">
            <option value="0"<?php if ($bulseyeArrows=='0') { echo ' selected="selected"';}?>><?php echo t('No')?></option>
            <option value="1"<?php if ($bulseyeArrows=='1') { echo ' selected="selected"';}?>><?php echo t('Yes')?></option>
        </select>
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="pauseOnMouseOver"><?php echo t('Pause on Mouse over')?></label>
    </div>
    <div class="col-md-8">
        <select class="form-control" id="pauseOnMouseOver" name="pauseOnMouseOver">
            <option value="0"<?php if ($pauseOnMouseOver=='0') { echo ' selected="selected"';}?>><?php echo t('No')?></option>
            <option value="1"<?php if ($pauseOnMouseOver=='1') { echo ' selected="selected"';}?>><?php echo t('Yes')?></option>
        </select>
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="randomStart"><?php echo t('Random Image')?></label>
    </div>
    <div class="col-md-8">
        <select class="form-control" id="randomStart" name="randomStart">
            <option value="0"<?php if ($randomStart=='0') { echo ' selected="selected"';}?>><?php echo t('No')?></option>
            <option value="1"<?php if ($randomStart=='1') { echo ' selected="selected"';}?>><?php echo t('Yes')?></option>
        </select>
    </div>
</div>
<div style="height: 6px;"></div>
<div class="row">
    <div class="col-md-4">
        <label for="autoStart"><?php echo t('Autostart Slider')?></label>
    </div>
    <div class="col-md-8">
        <select class="form-control" id="autoStart" name="autoStart">
            <option value="1"<?php if ($autoStart=='1') { echo ' selected="selected"';}?>><?php echo t('Yes')?></option>
            <option value="0"<?php if ($autoStart=='0') { echo ' selected="selected"';}?>><?php echo t('No')?></option>
        </select>
    </div>
</div>