<?php
defined('C5_EXECUTE') or die("Access Denied.");
/**>         ____  _           _       ___ _____
 *>          | __ )| | __ _  __| | ___ ( _ )___ /
 *>         |  _ \| |/ _` |/ _` |/ _ \/ _ \ |_ \
 *>        | |_) | | (_| | (_| |  __/ (_) |__) |
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
<div class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-md-3 control-label"><?php echo t('Name')?></label>
        <div class="col-md-9">
            <?php
            echo $form->text('name', $name, array('class' => 'form-control', 'placeholder'=>t('Name for Heading description')));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="pictureID" class="col-md-3 control-label"><?php echo t('Image')?></label>
        <div class="col-md-9">
            <?php
            echo $al->image('pictureID', 'pictureID', t('Choose Image'), $pictureID);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="proTextDescription" class="col-md-3 control-label"><?php echo t('Pro Name')?></label>
        <div class="col-md-9">
            <?php echo $form->text('proTextDescription', $proTextDescription, array('class' => 'form-control', 'placeholder'=>t('Name the pro list'))); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="proText" class="col-md-3 control-label"><?php echo t('Pro list')?></label>
        <div class="col-md-9">
            <?php echo $form->textarea('proText', $proText, array('class' => 'form-control', 'placeholder'=>t('Pro arguments (1 pro line)'))); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="contraTextDescription" class="col-md-3 control-label"><?php echo t('Contra Name')?></label>
        <div class="col-md-9">
            <?php echo $form->text('contraTextDescription', $contraTextDescription, array('class' => 'form-control', 'placeholder'=>t('Name the contra list'))); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="contraText" class="col-md-3 control-label"><?php echo t('Contra list')?></label>
        <div class="col-md-9">
            <?php echo $form->textarea('contraText', $contraText, array('class' => 'form-control', 'placeholder'=>t('Contra arguments (1 pro line)'))); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="herkunft" class="col-md-3 control-label"><?php echo t('Origin')?></label>
        <div class="col-md-9">
            <?php echo $form->text('herkunft', $herkunft, array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="zubereitung" class="col-md-3 control-label"><?php echo t('Preparation')?></label>
        <div class="col-md-9">
            <?php echo $form->textarea('zubereitung', $zubereitung, array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="anwendung" class="col-md-3 control-label"><?php echo t('Practical use')?></label>
        <div class="col-md-9">
            <?php echo $form->textarea('anwendung', $anwendung, array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="anmerkung" class="col-md-3 control-label"><?php echo t('Note')?></label>
        <div class="col-md-9">
            <?php echo $form->textarea('anmerkung', $anmerkung, array('class' => 'form-control')); ?>
        </div>
    </div>
</div>