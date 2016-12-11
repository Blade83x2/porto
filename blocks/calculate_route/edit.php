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
    <label for="textHeading" class="col-md-3 control-label"><?php echo t('Block heading Text')?></label>
    <div class="col-md-8 col-md-offset-1">
        <input type="text" class="form-control" id="textHeading" name="textHeading" value="<?php if(isset($textHeading)){ echo $textHeading; } ?>" placeholder="<?php echo t("Calculate Route")?>" />
    </div>
</div>
<div class="form-group form-group-md">
    <label for="startPlaceholder" class="col-md-3 control-label"><?php echo t('Source Address Placeholder')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('Placeholder for Input example!')?>"></i>
    </label>
    <div class="col-md-8 col-md-offset-1">
        <input type="text" class="form-control" id="startPlaceholder" name="startPlaceholder" value="<?php if(isset($startPlaceholder)){ echo $startPlaceholder; } ?>" />
    </div>
</div>
<div class="form-group form-group-md">
    <label for="serviceProvider" class="col-md-3 control-label"><?php echo t('Service Provider')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('Service Provider that delivers the information about the route!')?>"></i>
    </label>
    <div class="col-md-8 col-md-offset-1">
        <select class="form-control" id="serviceProvider" name="serviceProvider">
            <option value="none"<?php if ($serviceProvider=='none') { echo ' selected="selected"';}?>><?php echo t('Select a Provider')?></option>
            <option value="userchoice"<?php if ($serviceProvider=='userchoice') { echo ' selected="selected"';}?>><?php echo t('Let the User decide')?></option>
            <option value="google"<?php if ($serviceProvider=='google') { echo ' selected="selected"';}?>>google</option>
            <option value="falk"<?php if ($serviceProvider=='falk') { echo ' selected="selected"';}?>>falk</option>
            <option value="bahn"<?php if ($serviceProvider=='bahn') { echo ' selected="selected"';}?>>bahn</option>
            <option value="bing"<?php if ($serviceProvider=='bing') { echo ' selected="selected"';}?>>bing</option>
            <option value="map24"<?php if ($serviceProvider=='map24') { echo ' selected="selected"';}?>>map24</option>
            <option value="klicktel"<?php if ($serviceProvider=='klicktel') { echo ' selected="selected"';}?>>klicktel</option>
            <option value="viamichelin"<?php if ($serviceProvider=='viamichelin') { echo ' selected="selected"';}?>>viamichelin</option>
        </select>
    </div>
</div>
<div class="form-group form-group-md">
    <label for="target" class="col-md-3 control-label"><?php echo t('Target Address')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('This is the target Address for the route!')?>"></i>
    </label>
    <div class="col-md-8 col-md-offset-1">
        <input type="text" class="form-control" id="target" name="target" value="<?php if(isset($target)){ echo $target; } ?>" placeholder="<?php echo t("Streetname & Number, Zipcode, Location")?>" />
    </div>
</div>
<div class="form-group form-group-md">
    <label for="buttonText" class="col-md-3 control-label"><?php echo t('Button Text')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('Text of the Button!')?>"></i>
    </label>
    <div class="col-md-8 col-md-offset-1">
        <input type="text" class="form-control" id="buttonText" name="buttonText" value="<?php if(isset($buttonText)){ echo $buttonText; } ?>" placeholder="<?php echo t("Calculate Route")?>" />
    </div>
</div>
<!--
<div class="form-group form-group-md">
    <label for="buttonWidth" class="col-md-3 control-label"><?php echo t('Button Width')?>
        <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('This means the Bootstrap col-md-x Classes for the Button width!')?>"></i>
    </label>
    
    <div class="col-md-8 col-md-offset-1">
        <select class="form-control" id="buttonWidth" name="buttonWidth">
            <option value="3"<?php if ($buttonWidth=='3') { echo ' selected="selected"';}?>>3</option>
            <option value="4"<?php if ($buttonWidth=='4') { echo ' selected="selected"';}?>>4</option>
            <option value="5"<?php if ($buttonWidth=='5') { echo ' selected="selected"';}?>>5</option>
            <option value="6"<?php if ($buttonWidth=='6') { echo ' selected="selected"';}?>>6</option>
            <option value="7"<?php if ($buttonWidth=='7') { echo ' selected="selected"';}?>>7</option>
            <option value="8"<?php if ($buttonWidth=='8') { echo ' selected="selected"';}?>>8</option>
            <option value="9"<?php if ($buttonWidth=='9') { echo ' selected="selected"';}?>>9</option>
            <option value="10"<?php if ($buttonWidth=='10') { echo ' selected="selected"';}?>>10</option>
            <option value="11"<?php if ($buttonWidth=='11') { echo ' selected="selected"';}?>>11</option>
            <option value="12"<?php if ($buttonWidth=='12') { echo ' selected="selected"';}?>>12</option>
        </select>
    </div>
    
</div>
-->