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
    <label class="col-md-6 control-label"><?php echo t('Type')?></label>
    <div class="col-md-3">
        <input type="radio" class="pointer" name="createFrom" id="createFromSingle" value="createFromSingle"<?php if($createFrom=='createFromSingle'){echo ' checked="checked"';}?> />&nbsp;<label for="createFromSingle" class="control-label pointer"><?php echo t('Single Entry')?></label><br>
    </div>
    <div class="col-md-3">
        <input type="radio" class="pointer" name="createFrom" id="createFromGroup" value="createFromGroup"<?php if($createFrom=='createFromGroup'){echo ' checked="checked"';}?> />&nbsp;<label for="createFromGroup" class="control-label pointer"><?php echo t('User Group')?></label><br>
    </div>
</div>
<div class="form-group form-group-md">
    <label for="effect" class="col-md-4 control-label"><?php echo t('Loading Effect')?></label>
    <div class="col-md-6 col-md-offset-2">
        <select class="form-control pointer" id="effect" name="effect">
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
<div class="form-group form-group-md">
    <label for="position" class="col-md-4 control-label"><?php echo t('Picture Position')?></label>
    <div class="col-md-6 col-md-offset-2">
        <select class="form-control pointer" id="position" name="position">
            <option value="left"<?php if ($position=='left') { echo ' selected="selected"';}?>><?php echo t('Left')?></option>
            <option value="right"<?php if ($position=='right') { echo ' selected="selected"';}?>><?php echo t('Right')?></option>
        </select>
    </div>
</div>
<div class="form-group form-group-md">
    <label for="divClassContainer" class="col-md-4 control-label"><?php echo t('Container').' '.t('Width')?></label>
    <div class="col-md-6 col-md-offset-2">
        <select class="form-control pointer" id="divClassContainer" name="divClassContainer">
            <option value="6"<?php if ($divClassContainer=='6') { echo ' selected="selected"';}?>>6</option>
            <option value="7"<?php if ($divClassContainer=='7') { echo ' selected="selected"';}?>>7</option>
            <option value="8"<?php if ($divClassContainer=='8') { echo ' selected="selected"';}?>>8</option>
            <option value="9"<?php if ($divClassContainer=='9') { echo ' selected="selected"';}?>>9</option>
            <option value="10"<?php if ($divClassContainer=='10') { echo ' selected="selected"';}?>>10</option>
            <option value="11"<?php if ($divClassContainer=='11') { echo ' selected="selected"';}?>>11</option>
            <option value="12"<?php if ($divClassContainer=='12') { echo ' selected="selected"';}?>>12</option>
        </select>
    </div>
</div>
<!-- Single -->
<div class="form-group form-group-md" id="pictureDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="picture" class="col-md-4 control-label"><?php echo t('Picture')?></label>
    <div class="col-md-6 col-md-offset-2">
        <?php echo $al->image('picture', 'picture', t('Select Image'), $picture); ?>
    </div>
</div>
<div class="form-group form-group-md" id="genderDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="gender" class="col-md-4 control-label"><?php echo t('Salutation')?></label>
    <div class="col-md-6 col-md-offset-2">
        <select class="form-control pointer" id="gender" name="gender">
            <option value="none"<?php if ($gender=='none') { echo ' selected="selected"';}?>><?php echo t('Select')?></option>
            <option value="male"<?php if ($gender=='male') { echo ' selected="selected"';}?>><?php echo t('male')?></option>
            <option value="female"<?php if ($gender=='female') { echo ' selected="selected"';}?>><?php echo t('female')?></option>
            <option value="company"<?php if ($gender=='company') { echo ' selected="selected"';}?>><?php echo t('Company')?></option>
        </select>
    </div>
</div>
<div class="form-group form-group-md" id="nameDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="name" class="col-md-4 control-label"><?php echo t('Name')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="text" class="form-control" name="name" id="name" value="<?php if (isset($name)) echo $name?>" />
    </div>
</div>
<div class="form-group form-group-md" id="departmentDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="department" class="col-md-4 control-label"><?php echo t('Department')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="text" class="form-control" name="department" id="department" value="<?php if (isset($department)) echo $department?>" />
    </div>
</div>
<div class="form-group form-group-md" id="locationDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="location" class="col-md-4 control-label"><?php echo t('Location')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="text" class="form-control" name="location" id="location" value="<?php if (isset($location)) echo $location?>" />
    </div>
</div>
<div class="form-group form-group-md" id="telefonDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="department" class="col-md-4 control-label"><?php echo t('Telefon')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="tel" class="form-control" name="telefon" id="telefon" value="<?php if (isset($telefon)) echo $telefon?>" />
    </div>
</div>
<div class="form-group form-group-md" id="faxDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="fax" class="col-md-4 control-label"><?php echo t('Fax')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="tel" class="form-control" name="fax" id="fax" value="<?php if (isset($fax)) echo $fax?>" />
    </div>
</div>
<div class="form-group form-group-md" id="mobilDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="mobil" class="col-md-4 control-label"><?php echo t('Mobil')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="tel" class="form-control" name="mobil" id="mobil" value="<?php if (isset($mobil)) echo $mobil?>" />
    </div>
</div>
<div class="form-group form-group-md" id="emailDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="email" class="col-md-4 control-label"><?php echo t('Email')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="email" class="form-control" name="email" id="email" value="<?php if (isset($email)) echo $email?>" />
    </div>
</div>
<div class="form-group form-group-md" id="webDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="web" class="col-md-4 control-label"><?php echo t('Web')?></label>
    <div class="col-md-6 col-md-offset-2">
        <input type="text" class="form-control" name="web" id="web" value="<?php if (isset($web)) echo $web?>" />
    </div>
</div>
<div class="form-group form-group-md" id="addownfieldsDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <label for="addownfields" class="col-md-4 control-label"><?php echo t('Own Fields')?></label>
    <div class="col-md-6 col-md-offset-2">
        <button class="btn btn-primary" id="addownfields" onclick="return false;"><i style="cursor:pointer;" class="glyphicon glyphicon-plus"></i> <?php echo t('Add')?></button>
    </div>
</div>

<div class="form-group form-group-md<?php if($ownfieldskey1!=''){ echo ' ownfields1';}?><?php if($ownfieldskey2!=''){ echo ' ownfields2';}?><?php if($ownfieldskey3!=''){ echo ' ownfields3';}?><?php if($ownfieldskey4!=''){ echo ' ownfields4';}?><?php if($ownfieldskey5!=''){ echo ' ownfields5';}?><?php if($ownfieldskey6!=''){ echo ' ownfields6';}?><?php if($ownfieldskey7!=''){ echo ' ownfields7';}?><?php if($ownfieldskey8!=''){ echo ' ownfields8';}?><?php if($ownfieldskey9!=''){ echo ' ownfields9';}?><?php if($ownfieldskey10!=''){ echo ' ownfields10';}?><?php if($ownfieldskey11!=''){ echo ' ownfields11';}?><?php if($ownfieldskey12!=''){ echo ' ownfields12';}?><?php if($ownfieldskey13!=''){ echo ' ownfields13';}?><?php if($ownfieldskey14!=''){ echo ' ownfields14';}?><?php if($ownfieldskey15!=''){ echo ' ownfields15';}?><?php if($ownfieldskey16!=''){ echo ' ownfields16';}?><?php if($ownfieldskey17!=''){ echo ' ownfields17';}?><?php if($ownfieldskey18!=''){ echo ' ownfields18';}?><?php if($ownfieldskey19!=''){ echo ' ownfields19';}?><?php if($ownfieldskey20!=''){ echo ' ownfields20';}?>" id="ownfieldsDiv"<?php if (isset($createFrom) && $createFrom!='createFromSingle'){ echo ' style="display:none;"';}?>>
    <?php
      $countFields = 0 ;
      for ($k=1; $k<21; $k++)
      {
	  if(strlen(${"ownfieldskey{$k}"})>0)
	  {
	      ?>
	      <div class="form-group form-group-md" id="ownfields<?php echo $k?>">
		    <div class="col-md-6">
			<div class="input-group">
			    <span class="input-group-addon"><button class="btn btn-xs removeButton" onclick="return removeField(<?php echo $k?>)"><i class="glyphicon glyphicon-minus pointer"></i></button></span>
			    <input type="text" class="form-control" name="ownfieldskey<?php echo $k?>" id="ownfieldskey_<?php echo $k?>" value="<?php echo ${"ownfieldskey{$k}"}; ?>">
			</div>
		    </div>
		    <div class="col-md-6">
			<input type="text" class="form-control" name="ownfieldsvalue<?php echo $k?>" id="ownfieldsvalue_<?php echo $k?>" value="<?php echo ${"ownfieldsvalue{$k}"}; ?>">
		    </div>
		</div>
	      <?php
	      $countFields++;
	  }
      }
    ?>
</div>

<!-- Group -->
<div class="form-group form-group-md" id="groupDiv"<?php if (isset($createFrom) && $createFrom!='createFromGroup'){ echo ' style="display:none;"';}?>>
    <label for="groupUl" class="col-md-4 control-label"><?php echo t('Display Users from Group')?> <i class="launch-tooltip fa fa-question-circle" title="<?php echo t('Each User from the selected Group returns a Table of data!')?>"></i></label>
    <div class="col-md-6 col-md-offset-2">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="groupButton">
                <?php
                $db = \Database::connection();
                if(isset($gID) && $gID > 0)
                {
                    $gName = $db->fetchColumn("SELECT gName FROM Groups WHERE gID=?", array($gID));
                    $gCount = $db->fetchAll("SELECT uID FROM UserGroups WHERE gID=?", array($gID));
                    echo t($gName).' ('.count($gCount).')';
                }
                else
                {
                    echo t('Select a User Group to display');
                }
                ?>
                <span class="caret"></span>
            </button>
            <input type="hidden" id="gID" name="gID" value="<?php if(isset($gID)){ echo $gID; } else { echo 'groupID_select'; } ?>">
            <ul class="dropdown-menu" role="menu" style="width:300px" id="groupUl">
            <?php
            echo '<li><a href="javascript:$(\'#gID\').val(\'groupID_select\'); $(\'#groupButton\').html(\''.t('Select a User Group to display').' <span class=\\\'caret\\\'></span> \')">'.t('Select a User Group to display').'</a></li>';
            $groups = $db->fetchAll("SELECT gID, gName FROM Groups");
            if(count($groups))
            {
                foreach($groups as $key => $g)
                {
                    if ($g['gName'] != "Guest")
                    {
                        $gCount = $db->fetchAll("SELECT uID FROM UserGroups WHERE gID=?", array($g['gID']));
                        echo '<li><a href="javascript:$(\'#gID\').val('.$g['gID'].'); $(\'#groupButton\').html(\''.t($g['gName']).' ('.count($gCount).') <span class=\\\'caret\\\'></span> \')">'.t($g['gName']).' ('.count($gCount).')</a></li>';
                    }
                }
            }
            ?>
            </ul>
        </div>
    </div>
</div>
<div class="form-group form-group-md" id="groupAttributesDiv"<?php if (isset($createFrom) && $createFrom!='createFromGroup'){ echo ' style="display:none;"';}?>>
    <br>
    <?php
    // I know, there are Helpers for that! But i want to lern the c5 Structure!
    $db = \Database::connection();
    if ($akCategoryID = $db->fetchColumn("SELECT akCategoryID FROM AttributeKeyCategories WHERE akCategoryHandle=?", array('user')))
    {
	$AttributeKeys = $db->fetchAll("SELECT akName, atID, akHandle FROM AttributeKeys WHERE akCategoryID=?", array($akCategoryID));
	echo '
	<div class="form-group form-group-md">
	    <label for="gPictureID" class="col-md-4 control-label">'.t('Picture Source').'
	        <i class="launch-tooltip fa fa-question-circle" title="'.t('Let decide you witch Picture should be use. With File/Image you can select an User Image Attribute.').'"></i>
	    </label>
	    <div class="col-md-6 col-md-offset-2">
		<select class="form-control pointer" id="gPictureID" name="gPictureID">
		    <option value="none"'.(($gPictureID=='none')?' selected="selected"':'').'>'.t('Select Picture Source').'</option>
		    <option value="avatar"'.(($gPictureID=='avatar')?' selected="selected"':'').'>'.t('Avatar from User Profile').'</option>
		    <option value="attribute"'.(($gPictureID=='attribute')?' selected="selected"':'').'>'.t('File / Image Attribute from User Profile').'</option>
		</select>
	    </div>
	</div>';
	
	$atIDPicture = $db->fetchColumn("SELECT atID FROM AttributeTypes WHERE atHandle=?", array('image_file'));
	$AttributeKeysPicture = $db->fetchAll("SELECT akName, atID, akHandle FROM AttributeKeys WHERE akCategoryID=? AND atID=?", array($akCategoryID, $atIDPicture));
	echo '
	    <div class="form-group form-group-md" id="userAttributePictureDiv"'.((isset($gPictureID) && $gPictureID=='attribute')?'':' style="display:none"').'>
		    <div class="col-md-6">
		        <label for="userAttributePicture" class="control-label">'.t('User Attribute Picture').'
		            <i class="launch-tooltip fa fa-question-circle" title="'.t('You can create your own Image Attribute Keys under User &gt; Attribute').'"></i>
		        </label>
		    </div>
		    <div class="col-md-6">
		        <select class="form-control pointer" id="userAttributePicture" name="userAttributePicture">';
    foreach($AttributeKeysPicture as $key => $ak)
    {
          echo '<option value="'.$ak['akHandle'].'"'.(($userAttributePicture==$ak['akHandle'])?' selected="selected"':'').'>'.t($ak['akName']).' - '.$ak['akHandle'].'[image_file]</option>';
    }
	echo '</select></div>';
	if($userImageActive)
	{
	    if(count($AttributeKeysPicture)==0) 
	    {
		echo '<p style="color:#ff0000" class="text-center"><b>'.t('No File / Image Attribute for the User available! Click on %s', '<a href="'.View::url('/dashboard/users/attributes').'" target="_self">dashboard/users/attributes</a>').'</b></p>';
	    }
	}
	else 
	{
	    echo '<p style="color:#ff0000" class="text-center"><b>'.t('File / Image are disabled for Users! Click on %s and enable them!', '<a href="'.View::url('/dashboard/system/attributes/types').'" target="_self">dashboard/system/attributes/types</a>').'</b></p>';
	}
	echo '</div>';
	if(count($AttributeKeys)) 
	{
	    echo '<span class="col-md-12"><label class="control-label">'.t('Type a Name to display and select a User Attribute!').'</label>
	        <i class="launch-tooltip fa fa-question-circle" title="'.t('Here you can type in your own Keys. The Values are loading from the User Attributes.').'"></i>
	    </span>';
	    for($iterator=1; $iterator<count($AttributeKeys); $iterator++)
	    {
            if ($iterator>20)
                break;
            echo '
                <div class="form-group form-group-md">
                  <div class="col-md-6">
                      <div class="input-group">
                      <span class="input-group-addon">'.t('Name').'</span>
                      <input type="text" class="form-control" name="gText'.$iterator.'" id="gText'.$iterator.'" value="'.${"gText{$iterator}"}.'">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <select class="form-control pointer" id="gAttr'.$iterator.'" name="gAttr'.$iterator.'">
                      <option value="none"'.((${"gAttr{$iterator}"}=='none')?' selected="selected"':'').'>'.t('User Attribute').'</option>';
            foreach($AttributeKeys as $key => $ak)
            {
                 $akType = $db->fetchColumn("SELECT atHandle FROM AttributeTypes WHERE atID=?", array($ak['atID']));
                // text textarea boolean date_time image_file number rating select address topics social_links
                echo 	  '<option value="'.$ak['akHandle'].'"'.((${"gAttr{$iterator}"}==$ak['akHandle'])?' selected="selected"':'').'>'.t($ak['akName']).' - '.$ak['akHandle'].'['.$akType.']</option>';
            }
            echo '</select></div></div>';
	    }
	}
	else
	{
	    echo '<div class="col-md-12"><div class="alert alert-danger alert-dismissible">
	      <strong>'.t('Warning').'</strong>
	      <p>'.t('No User Attributekeys where found! Please create them first!').'<br>
	    </div></div>';
	}
}
?>
</div>
<!-- createFromUserProfile -->
<div class="form-group form-group-md" id="uIDDiv"<?php if (isset($createFrom) && $createFrom!='createFromUserProfile'){ echo ' style="display:none;"';}?>>
    <label for="user" class="col-md-4 control-label"><?php echo t('User')?></label>
    <div class="col-md-6 col-md-offset-2">
    </div>
</div>
<!-- //createFromUserProfile -->
<script>
    var currentActive = '<?php if (isset($createFrom)) { echo $createFrom; } else { echo 'createFromSingle'; } ?>';
    countFields = <?php echo $countFields; ?>;
    maxFields = 20;
    $(document).ready(function()
    {
	if (<?php echo (int)$countFields; ?> == 20){
	    $("#addownfieldsDiv").css("display", "none");
	}
    });

    if (typeof removeField == "undefined") {
        function removeField(id)
        {
            $("#ownfields"+id).remove();
            $("#ownfieldsDiv").removeClass("ownfields"+id);
            if($('#addownfieldsDiv').css('display')=='none') { $('#addownfieldsDiv').show('slow'); }
            countFields--;
            return false;
        }
    }

    $(document).ready(function()
    {
        $("#gPictureID").on('change', function()
        {
            switch(this.value){
                case 'none':
                case 'avatar':
                $("#userAttributePictureDiv").animate({width: [ "hide", "swing" ], height: [ "hide", "swing" ], opacity: "hide"}, 800, "linear", function() {});
            break;
                case 'attribute':
                $("#userAttributePictureDiv").animate({width: [ "show", "swing" ], height: [ "show", "swing" ], opacity: "show"}, 800, "linear", function() {});
                break;
            }
        });
        $("#addownfields").on('click', function() {
            for (var c=1; c<=maxFields; c++) {
                if (!$("#ownfieldsDiv").hasClass("ownfields"+c)) {
                    $("#ownfieldsDiv").addClass("ownfields"+c).append(
                    "<div class=\"form-group form-group-md\" id=\"ownfields"+c+"\">" +
                        "<div class=\"col-md-6\">" +
                        "<div class=\"input-group\">" +
                            "<span class=\"input-group-addon\"><button class=\"btn btn-xs removeButton\" onclick=\"return removeField("+c+")\"><i class=\"glyphicon glyphicon-minus pointer\"></i></button></span>" +
                            "<input type=\"text\" class=\"form-control\" name=\"ownfieldskey"+c+"\" id=\"ownfieldskey_"+c+"\">" +
                        "</div>" +
                        "</div>" +
                        "<div class=\"col-md-6\">" +
                        "<input type=\"text\" class=\"form-control\" name=\"ownfieldsvalue"+c+"\" id=\"ownfieldsvalue_"+c+"\">" +
                        "</div>" +
                    "</div>");
                    countFields++;
                    if(countFields==maxFields) { $('#addownfieldsDiv').hide('slow'); }
                    break;
                }
                if(countFields==maxFields) { $('#addownfieldsDiv').hide('slow'); }
            }
        });

        $('#createFromSingle').on('click', function(){
            if('createFromSingle'==currentActive) return;
            $("input[name=createFrom]").attr("disabled",true);
            switch (currentActive){
            case 'createFromGroup':
                $("#groupAttributesDiv").animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                    $( "#groupDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                        $( "#pictureDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                            $( "#genderDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                $( "#nameDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                    $( "#departmentDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                        $( "#locationDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                            $( "#telefonDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                $( "#faxDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                    $( "#mobilDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                        $( "#emailDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                            $( "#webDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                if(countFields==20){
                                                                    $( "#ownfieldsDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                        $("input[name=createFrom]").attr("disabled",false);
                                                                    });
                                                                }
                                                                else {
                                                                    $( "#addownfieldsDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                        $( "#ownfieldsDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                            $("input[name=createFrom]").attr("disabled",false);
                                                                        });
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
                break;
            case 'createFromUserProfile':
                $( "#uIDDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                    $( "#pictureDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                        $( "#genderDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                            $( "#nameDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                $( "#departmentDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                    $( "#locationDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                        $( "#telefonDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                            $( "#faxDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                $( "#mobilDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                    $( "#emailDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                        $( "#webDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                            $( "#addownfieldsDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                $( "#ownfieldsDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                    $("input[name=createFrom]").attr("disabled",false);
                                                                });
                                                            });
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
                break;
            }
            currentActive = 'createFromSingle';
        });

        $('#createFromGroup').on('click', function(){
            if('createFromGroup'==currentActive) return;
            $("input[name=createFrom]").attr("disabled",true);
            switch (currentActive){
            case 'createFromSingle':
                $( "#ownfieldsDiv" ).animate({width: [ "hide", "swing" ], height: [ "hide", "swing" ], opacity: "hide"}, 50, "linear", function() {
                    $( "#addownfieldsDiv" ).animate({width: [ "hide", "swing" ], height: [ "hide", "swing" ], opacity: "hide"}, 50, "linear", function() {
                        $( "#webDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                            $( "#emailDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                $( "#mobilDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                    $( "#faxDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                        $( "#telefonDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                            $( "#locationDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                $( "#departmentDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                    $( "#nameDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                        $( "#genderDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                            $( "#pictureDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                $( "#groupDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                    $("#groupAttributesDiv").animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                        $("input[name=createFrom]").attr("disabled",false);
                                                                    });
                                                                });
                                                            });
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
                break;
            case 'createFromUserProfile':
                $( "#uIDDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                    $( "#groupDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                        $("#groupAttributesDiv").animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                            $("input[name=createFrom]").attr("disabled",false);
                        });
                    });
                });
                break;
            }
            currentActive = 'createFromGroup';
        });
        $('#createFromUserProfile').on('click', function(){
            if('createFromUserProfile'==currentActive) return;
            $("input[name=createFrom]").attr("disabled",true);
            switch (currentActive){
            case 'createFromSingle':
                $( "#ownfieldsDiv" ).animate({width: [ "hide", "swing" ], height: [ "hide", "swing" ], opacity: "hide"}, 50, "linear", function() {
                    $( "#addownfieldsDiv" ).animate({width: [ "hide", "swing" ], height: [ "hide", "swing" ], opacity: "hide"}, 50, "linear", function() {
                        $( "#webDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                            $( "#emailDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                $( "#mobilDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                    $( "#faxDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                        $( "#telefonDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                            $( "#locationDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                $( "#departmentDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                    $( "#nameDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                        $( "#genderDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                            $( "#pictureDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                $( "#uIDDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                                                                    $("input[name=createFrom]").attr("disabled",false);
                                                                });
                                                            });
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
                break;
            case 'createFromGroup':
                $("#groupAttributesDiv").animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                    $( "#groupDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                        $( "#uIDDiv" ).animate({width: [ "toggle", "swing" ], height: [ "toggle", "swing" ], opacity: "toggle"}, 50, "linear", function() {
                            $("input[name=createFrom]").attr("disabled",false);
                        });
                    });
                });
                break;
            }
            currentActive = 'createFromUserProfile';
        });
    });    
</script>