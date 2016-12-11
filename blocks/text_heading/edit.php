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
<br>
<div class="form-group form-group-md">
    <label for="headingtext" class="col-md-3 control-label"><?php echo t('Heading Text')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('This Text is allways displays in upercase!')?>"></i>
    </label>
    <div class="col-md-9">
        <input type="text" class="col-md-12" id="headingtext" name="headingtext" value="<?php echo $headingtext?>">
    </div>
</div>
<div class="form-group form-group-md">
    <label for="textsize" class="col-md-3 control-label"><?php echo t('Text size')?></label>
    <div class="col-md-9">
        <select class="form-control pointer col-md-12" id="textsize" name="textsize">
            <option value="h1"<?php if ($textsize=='h1') { echo ' selected="selected"';}?>><?php echo t('H1')?></option>
            <option value="h2"<?php if ($textsize=='h2') { echo ' selected="selected"';}?>><?php echo t('H2')?></option>
            <option value="h3"<?php if ($textsize=='h3') { echo ' selected="selected"';}?>><?php echo t('H3')?></option>
            <option value="h4"<?php if ($textsize=='h4') { echo ' selected="selected"';}?>><?php echo t('H4')?></option>
            <option value="h5"<?php if ($textsize=='h5') { echo ' selected="selected"';}?>><?php echo t('H5')?></option>
            <option value="h6"<?php if ($textsize=='h6') { echo ' selected="selected"';}?>><?php echo t('H6')?></option>
        </select>
    </div>
</div>
<div class="form-group form-group-md">
    <label for="textstrong" class="col-md-3 control-label"><?php echo t('Text strong')?></label>
    <div class="col-md-9">
        <select class="form-control pointer col-md-12" id="textstrong" name="textstrong">
            <option value="1"<?php if ($textstrong=='1') { echo ' selected="selected"';}?>><?php echo t('Yes')?></option>
            <option value="0"<?php if ($textstrong=='0') { echo ' selected="selected"';}?>><?php echo t('No')?></option>
        </select>
    </div>
</div>
<div class="form-group form-group-md">
    <label for="texteffect" class="col-md-3 control-label"><?php echo t('Text Effect')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('Chose an Effekt for displaying the Text. The animation is disabled in edit Mode!')?>"></i>
    </label>
    <div class="col-md-9">
        <select class="form-control pointer col-md-12" id="texteffect" name="texteffect">
            <option value="none"<?php if ($texteffect=='none') { echo ' selected="selected"';}?>><?php echo t('None')?></option>
            <option value="random"<?php if ($texteffect=='random') { echo ' selected="selected"';}?>><?php echo t('Random')?></option>
            <option value="fadeIn"<?php if ($texteffect=='fadeIn') { echo ' selected="selected"';}?>>fadeIn</option>
            <option value="fadeInUp"<?php if ($texteffect=='fadeInUp') { echo ' selected="selected"';}?>>fadeInUp</option>
            <option value="fadeInDown"<?php if ($texteffect=='fadeInDown') { echo ' selected="selected"';}?>>fadeInDown</option>
            <option value="fadeInLeft"<?php if ($texteffect=='fadeInLeft') { echo ' selected="selected"';}?>>fadeInLeft</option>
            <option value="fadeInRight"<?php if ($texteffect=='fadeInRight') { echo ' selected="selected"';}?>>fadeInRight</option>
            <option value="fadeInUpBig"<?php if ($texteffect=='fadeInUpBig') { echo ' selected="selected"';}?>>fadeInUpBig</option>
            <option value="fadeInDownBig"<?php if ($texteffect=='fadeInDownBig') { echo ' selected="selected"';}?>>fadeInDownBig</option>
            <option value="fadeInLeftBig"<?php if ($texteffect=='fadeInLeftBig') { echo ' selected="selected"';}?>>fadeInLeftBig</option>
            <option value="fadeInRightBig"<?php if ($texteffect=='fadeInRightBig') { echo ' selected="selected"';}?>>fadeInRightBig</option>
            <option value="bounceIn"<?php if ($texteffect=='bounceIn') { echo ' selected="selected"';}?>>bounceIn</option>
            <option value="bounceInUp"<?php if ($texteffect=='bounceInUp') { echo ' selected="selected"';}?>>bounceInUp</option>
            <option value="bounceInDown"<?php if ($texteffect=='bounceInDown') { echo ' selected="selected"';}?>>bounceInDown</option>
            <option value="bounceInLeft"<?php if ($texteffect=='bounceInLeft') { echo ' selected="selected"';}?>>bounceInLeft</option>
            <option value="bounceInRight"<?php if ($texteffect=='bounceInRight') { echo ' selected="selected"';}?>>bounceInRight</option>
            <option value="rotateIn"<?php if ($texteffect=='rotateIn') { echo ' selected="selected"';}?>>rotateIn</option>
            <option value="rotateInUpLeft"<?php if ($texteffect=='rotateInUpLeft') { echo ' selected="selected"';}?>>rotateInUpLeft</option>
            <option value="rotateInDownLeft"<?php if ($texteffect=='rotateInDownLeft') { echo ' selected="selected"';}?>>rotateInDownLeft</option>
            <option value="rotateInUpRight"<?php if ($texteffect=='rotateInUpRight') { echo ' selected="selected"';}?>>rotateInUpRight</option>
            <option value="rotateInDownRight"<?php if ($texteffect=='rotateInDownRight') { echo ' selected="selected"';}?>>rotateInDownRight</option>
            <option value="flash"<?php if ($texteffect=='flash') { echo ' selected="selected"';}?>>flash</option>
            <option value="shake"<?php if ($texteffect=='shake') { echo ' selected="selected"';}?>>shake</option>
            <option value="bounce"<?php if ($texteffect=='bounce') { echo ' selected="selected"';}?>>bounce</option>
            <option value="tada"<?php if ($texteffect=='tada') { echo ' selected="selected"';}?>>tada</option>
            <option value="swing"<?php if ($texteffect=='swing') { echo ' selected="selected"';}?>>swing</option>
            <option value="wobble"<?php if ($texteffect=='wobble') { echo ' selected="selected"';}?>>wobble</option>
            <option value="wiggle"<?php if ($texteffect=='wiggle') { echo ' selected="selected"';}?>>wiggle</option>
        </select>
    </div>
</div>