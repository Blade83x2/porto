<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
#use Concrete\Package\Porto\Block\QrCode;
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
$ui = UserInfo::getByID(USER_SUPER_ID);
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#<?php echo $datatype?>group").show();
        $("#datatype").change(function() {
            $("#textgroup").hide();
            $("#urlgroup").hide();
            $("#emailgroup").hide();
            $("#telgroup").hide();
            $("#smsgroup").hide();
            $("#mmsgroup").hide();
            $("#"+$(this).val()+"group").show();
            /*switch ($(this).val()) {
                case 'contact':
                    // VCARD
                    break;
                case 'mms':
                    $("#mmsgroup").fadeIn( "fast", function() {});
                    break;
                case 'sms':
                    $("#smsgroup").fadeIn( "fast", function() {});
                    break;
                case 'tel':
                    $("#telgroup").fadeIn( "fast", function() {});
                    break;
                case 'url':
                    $("#urlgroup").fadeIn( "fast", function() {});
                    break;
                case 'text':
                    $("#textgroup").fadeIn( "fast", function() {});
                    break;
                case 'email':
                    $("#emailgroup").fadeIn( "fast", function() {});
                    break;
                case 'load':
                    break;
                case 'default':
                    break;
            }*/
        });

    });
</script>
<div class="form-horizontal">
    <div class="form-group">
        <label for="datatype" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code for')?></label>
        <div class="col-md-9 col-sm-12">
            <select name="datatype" id="datatype" class="form-control">
                <option value="load"></option>
                <option value="text"<?php echo (($datatype=='text')?' selected="selected"':'') ?>><?php echo t('Text')?></option>
                <option value="url"<?php echo (($datatype=='url')?' selected="selected"':'') ?>><?php echo t('URL')?></option>
                <option value="email"<?php echo (($datatype=='email')?' selected="selected"':'') ?>><?php echo t('E-Mail')?></option>
                <option value="tel"<?php echo (($datatype=='tel')?' selected="selected"':'') ?>><?php echo t('Tel')?></option>
                <option value="contact"<?php echo (($datatype=='contact')?' selected="selected"':'') ?>><?php echo t('VCARD')?></option>
                <option value="sms"<?php echo (($datatype=='sms')?' selected="selected"':'') ?>><?php echo t('SMS')?></option>
                <option value="mms"<?php echo (($datatype=='mms')?' selected="selected"':'') ?>><?php echo t('MMS')?></option>
                <!--<option value="map"<?php echo (($datatype=='map')?' selected="selected"':'') ?>><?php echo t('Map, Location')?></option>-->
            </select>
        </div>
    </div>



    <div class="form-group" id="textgroup" style="<?php echo (($datatype!='text')?'display:none':'')?>">
        <label for="text" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code text')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->text('text', $text, array('class' => 'form-control', 'placeholder'=>t('Type your text message here'))); ?>
        </div>
    </div>
    <div class="form-group" id="urlgroup" style="<?php echo (($datatype!='url')?'display:none':'')?>">
        <label for="url" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code URL')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->text('url', $url, array('class' => 'form-control', 'placeholder'=>t(BASE_URL))); ?>
        </div>
    </div>
    <div class="form-group" id="emailgroup" style="<?php echo (($datatype!='email')?'display:none':'')?>">
        <label for="email" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code E-Mail')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->text('email', $email, array('class' => 'form-control', 'placeholder'=> (is_object($ui) ? (string)$ui->getUserEmail() : 'email@host.com'))); ?>
        </div>
    </div>
    <div class="form-group" id="telgroup" style="<?php echo (($datatype!='tel')?'display:none':'')?>">
        <label for="tel" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code Tel')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->text('tel', $tel, array('class' => 'form-control', 'placeholder'=>'00491661234567')); ?>
        </div>
    </div>
    <div class="form-group" id="smsgroup" style="<?php echo (($datatype!='sms')?'display:none':'')?>">
        <label for="sms" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code SMS')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->text('sms', $sms, array('class' => 'form-control', 'placeholder'=>'00491601234567:SMS Text')); ?>
        </div>
    </div>
    <div class="form-group" id="mmsgroup" style="<?php echo (($datatype!='mms')?'display:none':'')?>">
        <label for="mms" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code MMS')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->text('mms', $mms, array('class' => 'form-control', 'placeholder'=>'00491601234567:MMS Text')); ?>
        </div>
    </div>







<!--
    <div class="form-group" id="datagroup">
        <label for="data" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code content')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->textarea('data', $data, array('rows'=>'8', 'class' => 'form-control', 'placeholder'=>t('Data Content'))); ?>
        </div>
    </div>
-->










    <div class="form-group">
        <label for="errorCorrectionLevel" class="col-md-3 col-sm-12 control-label"><?php echo t('Error Correction Level')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->select('errorCorrectionLevel', array('L'=>'L - '.t('smallest'),'M'=>'M','Q'=>'Q','H'=>'H - '.t('best')), $errorCorrectionLevel, array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code alt attribute')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->text('title', $title, array('class' => 'form-control', 'placeholder'=>t('Alternative alt and title text from QR Code image'))); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="size" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code image size')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->number('size', $size ? (int)$size : 7, array('min' => '1', 'max' => '10', 'class' => 'form-control'))?>
        </div>
    </div>
    <div class="form-group">
        <label for="margin" class="col-md-3 col-sm-12 control-label"><?php echo t('QR Code image margin')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $form->number('margin', $margin ? (int)$margin : 2, array('min' => '0', 'max' => '50', 'class' => 'form-control'))?>
        </div>
    </div>
    <input type="hidden" id="getReturnType" name="getReturnType" value="<?php echo $getReturnType; ?>" />
</div>
