<?php
namespace Concrete\Package\Porto\Block\MemberListing;
use
    File,
    Page,
    Core,
    \Concrete\Core\Support\Facade\Database,
    \Concrete\Core\Block\BlockController,
    \Concrete\Core\Attribute\Key\Category as AttributeKeyCategory,
    \Concrete\Core\Attribute\Type as AttributeType;

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
class Controller extends BlockController
{
	protected
	    $btTable                                  = 'PortoPackageMemberListing',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "700",
	    $btInterfaceHeight                        = "830",
        $btCacheBlockRecord                       = true,
        $btCacheBlockOutput                       = true,
        $btCacheBlockOutputOnPost                 = false,
        $btCacheBlockOutputForRegisteredUsers     = true;

    protected
        $effect                                   = NULL,
        $divClassContainer                        = 12, # col-md-{$col}  // min 6, max 12
        $position                                 = 'left', # position vom bild (left|right)
        $createFrom                               = NULL, # (createFromSingle|createFromGroup|createFromUserProfile)
        $form                                     = NULL,
        $ih                                       = NULL,
        $al                                       = NULL;


    public function getBlockTypeDescription()
    {
        return t("Display Userdata");
    }

    public function getBlockTypeName()
    {
        return t("Member Listing");
    }

    public function getBlockTypeHelp()
    {
        $help = t("<b>This Block returns a Picture with a Table of data.</b><p>You can create your own Fields or reading the content from a User group.</p>");
        return $help;
    }

    public function getSearchableContent()
    {
        return $this->name.' '.$this->department.' '.$this->telefon.' '.$this->fax.' '.$this->web.' '.$this->mobil.
        ' '.$this->ownfieldskey1. ' '.$this->ownfieldsvalue1.
        ' '.$this->ownfieldskey2. ' '.$this->ownfieldsvalue2.
        ' '.$this->ownfieldskey3. ' '.$this->ownfieldsvalue3.
        ' '.$this->ownfieldskey4. ' '.$this->ownfieldsvalue4.
        ' '.$this->ownfieldskey5. ' '.$this->ownfieldsvalue5.
        ' '.$this->ownfieldskey6. ' '.$this->ownfieldsvalue6.
        ' '.$this->ownfieldskey7. ' '.$this->ownfieldsvalue7.
        ' '.$this->ownfieldskey8. ' '.$this->ownfieldsvalue8.
        ' '.$this->ownfieldskey9. ' '.$this->ownfieldsvalue9.
        ' '.$this->ownfieldskey10. ' '.$this->ownfieldsvalue10.
        ' '.$this->ownfieldskey11. ' '.$this->ownfieldsvalue11.
        ' '.$this->ownfieldskey12. ' '.$this->ownfieldsvalue12.
        ' '.$this->ownfieldskey13. ' '.$this->ownfieldsvalue13.
        ' '.$this->ownfieldskey14. ' '.$this->ownfieldsvalue14.
        ' '.$this->ownfieldskey15. ' '.$this->ownfieldsvalue15.
        ' '.$this->ownfieldskey16. ' '.$this->ownfieldsvalue16.
        ' '.$this->ownfieldskey17. ' '.$this->ownfieldsvalue17.
        ' '.$this->ownfieldskey18. ' '.$this->ownfieldsvalue18.
        ' '.$this->ownfieldskey19. ' '.$this->ownfieldsvalue19.
        ' '.$this->ownfieldskey20. ' '.$this->ownfieldsvalue20.
        ' '.$this->gText1. ' '.$this->gAttr1.
        ' '.$this->gText2. ' '.$this->gAttr2.
        ' '.$this->gText3. ' '.$this->gAttr3.
        ' '.$this->gText4. ' '.$this->gAttr4.
        ' '.$this->gText5. ' '.$this->gAttr5.
        ' '.$this->gText6. ' '.$this->gAttr6.
        ' '.$this->gText7. ' '.$this->gAttr7.
        ' '.$this->gText8. ' '.$this->gAttr8.
        ' '.$this->gText9. ' '.$this->gAttr9.
        ' '.$this->gText10. ' '.$this->gAttr10.
        ' '.$this->gText11. ' '.$this->gAttr11.
        ' '.$this->gText12. ' '.$this->gAttr12.
        ' '.$this->gText13. ' '.$this->gAttr13.
        ' '.$this->gText14. ' '.$this->gAttr14.
        ' '.$this->gText15. ' '.$this->gAttr15.
        ' '.$this->gText16. ' '.$this->gAttr16.
        ' '.$this->gText17. ' '.$this->gAttr17.
        ' '.$this->gText18. ' '.$this->gAttr18.
        ' '.$this->gText19. ' '.$this->gAttr19.
        ' '.$this->gText20. ' '.$this->gAttr20;
    }

    public function on_start()
    {

    }

    public function duplicate($newBlockID)
    {

    }

    public function delete()
    {
	    $db = Database::getActiveConnection();
	    $db->executeQuery("DELETE FROM PortoPackageMemberListing WHERE bID=?", array($this->bID));
    }

    public function view()
    {
        $this->set('btName', $this->btName);
	    $this->set('userAttributePicture', $this->userAttributePicture);
        $this->set('gPictureID', $this->gPictureID);
    }

    public function edit()
    {
        $this->set('createFrom', $this->createFrom);
        $this->set('effect', $this->effect);
        $this->set('position', $this->position);
        $this->set('divClassContainer', $this->divClassContainer);
        $this->set('picture', $this->getImageObjFromInt($this->picture));
        $this->al = Core::make('helper/concrete/asset_library');
        $this->set('al', $this->al);
        $this->form = Core::make('helper/form');
        $this->set('form', $this->form);
        $this->set('gender', $this->gender);
        $this->set('name', $this->name);
        $this->set('location', $this->location);
        $this->set('department', $this->department);
        $this->set('telefon', $this->telefon);
        $this->set('fax', $this->fax);
        $this->set('mobil', $this->mobil);
        $this->set('email', $this->email);
        $this->set('web', $this->web);
        $this->set('createFrom', $this->createFrom);
        $this->set('ownfieldskey1', $this->ownfieldskey1);
        $this->set('ownfieldsvalue1', $this->ownfieldsvalue1);
        $this->set('ownfieldskey2', $this->ownfieldskey2);
        $this->set('ownfieldsvalue2', $this->ownfieldsvalue2);
        $this->set('ownfieldskey3', $this->ownfieldskey3);
        $this->set('ownfieldsvalue3', $this->ownfieldsvalue3);
        $this->set('ownfieldskey4', $this->ownfieldskey4);
        $this->set('ownfieldsvalue4', $this->ownfieldsvalue4);
        $this->set('ownfieldskey5', $this->ownfieldskey5);
        $this->set('ownfieldsvalue5', $this->ownfieldsvalue5);
        $this->set('ownfieldskey6', $this->ownfieldskey6);
        $this->set('ownfieldsvalue6', $this->ownfieldsvalue6);
        $this->set('ownfieldskey7', $this->ownfieldskey7);
        $this->set('ownfieldsvalue7', $this->ownfieldsvalue7);
        $this->set('ownfieldskey8', $this->ownfieldskey8);
        $this->set('ownfieldsvalue8', $this->ownfieldsvalue8);
        $this->set('ownfieldskey9', $this->ownfieldskey9);
        $this->set('ownfieldsvalue9', $this->ownfieldsvalue9);
        $this->set('ownfieldskey10', $this->ownfieldskey10);
        $this->set('ownfieldsvalue10', $this->ownfieldsvalue10);
        $this->set('ownfieldskey11', $this->ownfieldskey11);
        $this->set('ownfieldsvalue11', $this->ownfieldsvalue11);
        $this->set('ownfieldskey12', $this->ownfieldskey12);
        $this->set('ownfieldsvalue12', $this->ownfieldsvalue12);
        $this->set('ownfieldskey13', $this->ownfieldskey13);
        $this->set('ownfieldsvalue13', $this->ownfieldsvalue13);
        $this->set('ownfieldskey14', $this->ownfieldskey14);
        $this->set('ownfieldsvalue14', $this->ownfieldsvalue14);
        $this->set('ownfieldskey15', $this->ownfieldskey15);
        $this->set('ownfieldsvalue15', $this->ownfieldsvalue15);
        $this->set('ownfieldskey16', $this->ownfieldskey16);
        $this->set('ownfieldsvalue16', $this->ownfieldsvalue16);
        $this->set('ownfieldskey17', $this->ownfieldskey17);
        $this->set('ownfieldsvalue17', $this->ownfieldsvalue17);
        $this->set('ownfieldskey18', $this->ownfieldskey18);
        $this->set('ownfieldsvalue18', $this->ownfieldsvalue18);
        $this->set('ownfieldskey19', $this->ownfieldskey19);
        $this->set('ownfieldsvalue19', $this->ownfieldsvalue19);
	    $this->set('ownfieldskey20', $this->ownfieldskey20);
        $this->set('ownfieldsvalue20', $this->ownfieldsvalue20);
	
        $types = AttributeType::getList();
        $categories = AttributeKeyCategory::getList();
        foreach($types as $at)
        {
            if($at->atHandle=='image_file')
            {
                foreach($categories as $cat)
                {
                    if($cat->getAttributeKeyCategoryHandle()=='user')
                    {
                        if($at->isAssociatedWithCategory($cat))
                        {
                            $this->set('userImageActive', true);
                            break 2;
                        }
                        else
                        {
                            $this->set('userImageActive', false);
                            break 2;
                        }
                    }
                }
            }
        }
        $this->set('userAttributePicture', $this->userAttributePicture);
        $this->set('gPictureID', $this->gPictureID);
        $this->set('gText1', $this->gText1);
        $this->set('gAttr1', $this->gAttr1);
        $this->set('gText2', $this->gText2);
        $this->set('gAttr2', $this->gAttr2);
        $this->set('gText3', $this->gText3);
        $this->set('gAttr3', $this->gAttr3);
        $this->set('gText4', $this->gText4);
        $this->set('gAttr4', $this->gAttr4);
        $this->set('gText5', $this->gText5);
        $this->set('gAttr5', $this->gAttr5);
        $this->set('gText6', $this->gText6);
        $this->set('gAttr6', $this->gAttr6);
        $this->set('gText7', $this->gText7);
        $this->set('gAttr7', $this->gAttr7);
        $this->set('gText8', $this->gText8);
        $this->set('gAttr8', $this->gAttr8);
        $this->set('gText9', $this->gText9);
        $this->set('gAttr9', $this->gAttr9);
        $this->set('gText10', $this->gText10);
        $this->set('gAttr10', $this->gAttr10);
        $this->set('gText11', $this->gText11);
        $this->set('gAttr11', $this->gAttr11);
        $this->set('gText12', $this->gText12);
        $this->set('gAttr12', $this->gAttr12);
        $this->set('gText13', $this->gText13);
        $this->set('gAttr13', $this->gAttr13);
        $this->set('gText14', $this->gText14);
        $this->set('gAttr14', $this->gAttr14);
        $this->set('gText15', $this->gText15);
        $this->set('gAttr15', $this->gAttr15);
        $this->set('gText16', $this->gText16);
        $this->set('gAttr16', $this->gAttr16);
        $this->set('gText17', $this->gText17);
        $this->set('gAttr17', $this->gAttr17);
        $this->set('gText18', $this->gText18);
        $this->set('gAttr18', $this->gAttr18);
        $this->set('gText19', $this->gText19);
        $this->set('gAttr19', $this->gAttr19);
        $this->set('gText20', $this->gText20);
        $this->set('gAttr20', $this->gAttr20);
    }

    public function add()
    {
        $this->edit();
        $this->set('createFrom', 'createFromSingle');
    }

    public function save($args)
    {
        $single = ($args['createFrom']=='createFromSingle')?true:false;
        $args['picture'] = ($single)?$args['picture']:'';
        $args['gender'] = ($single)?$args['gender']:'';
        $args['name'] = ($single)?$args['name']:'';
        $args['location'] = ($single)?$args['location']:'';
        $args['department'] = ($single)?$args['department']:'';
        $args['telefon'] = ($single)?$args['telefon']:'';
        $args['fax'] = ($single)?$args['fax']:'';
        $args['mobil'] = ($single)?$args['mobil']:'';
        $args['email'] = ($single)?$args['email']:'';
        $args['web'] = ($single)?$args['web']:'';
        if ($single)
        {
            if ($args['ownfieldskey1']=='' || $args['ownfieldsvalue1']==''){
                $args['ownfieldskey1'] = '';
                $args['ownfieldsvalue1'] = '';
            }
            if ($args['ownfieldskey2']=='' || $args['ownfieldsvalue2']==''){
                $args['ownfieldskey2'] = '';
                $args['ownfieldsvalue2'] = '';
            }
            if ($args['ownfieldskey3']=='' || $args['ownfieldsvalue3']==''){
                $args['ownfieldskey3'] = '';
                $args['ownfieldsvalue3'] = '';
            }
            if ($args['ownfieldskey4']=='' || $args['ownfieldsvalue4']==''){
                $args['ownfieldskey4'] = '';
                $args['ownfieldsvalue4'] = '';
            }
            if ($args['ownfieldskey5']=='' || $args['ownfieldsvalue5']==''){
                $args['ownfieldskey5'] = '';
                $args['ownfieldsvalue5'] = '';
            }
            if ($args['ownfieldskey6']=='' || $args['ownfieldsvalue6']==''){
                $args['ownfieldskey6'] = '';
                $args['ownfieldsvalue6'] = '';
            }
            if ($args['ownfieldskey7']=='' || $args['ownfieldsvalue7']==''){
                $args['ownfieldskey7'] = '';
                $args['ownfieldsvalue7'] = '';
            }
            if ($args['ownfieldskey8']=='' || $args['ownfieldsvalue8']==''){
                $args['ownfieldskey8'] = '';
                $args['ownfieldsvalue8'] = '';
            }
            if ($args['ownfieldskey9']=='' || $args['ownfieldsvalue9']==''){
                $args['ownfieldskey9'] = '';
                $args['ownfieldsvalue9'] = '';
            }
            if ($args['ownfieldskey10']=='' || $args['ownfieldsvalue10']==''){
                $args['ownfieldskey10'] = '';
                $args['ownfieldsvalue10'] = '';
            }
            if ($args['ownfieldskey1']=='' || $args['ownfieldsvalue1']==''){
                $args['ownfieldskey1'] = '';
                $args['ownfieldsvalue1'] = '';
            }
            if ($args['ownfieldskey11']=='' || $args['ownfieldsvalue11']==''){
                $args['ownfieldskey11'] = '';
                $args['ownfieldsvalue11'] = '';
            }
            if ($args['ownfieldskey12']=='' || $args['ownfieldsvalue12']==''){
                $args['ownfieldskey12'] = '';
                $args['ownfieldsvalue12'] = '';
            }
            if ($args['ownfieldskey13']=='' || $args['ownfieldsvalue13']==''){
                $args['ownfieldskey13'] = '';
                $args['ownfieldsvalue13'] = '';
            }
            if ($args['ownfieldskey14']=='' || $args['ownfieldsvalue14']==''){
                $args['ownfieldskey14'] = '';
                $args['ownfieldsvalue14'] = '';
            }
            if ($args['ownfieldskey15']=='' || $args['ownfieldsvalue15']==''){
                $args['ownfieldskey15'] = '';
                $args['ownfieldsvalue15'] = '';
            }
            if ($args['ownfieldskey16']=='' || $args['ownfieldsvalue16']==''){
                $args['ownfieldskey16'] = '';
                $args['ownfieldsvalue16'] = '';
            }
            if ($args['ownfieldskey17']=='' || $args['ownfieldsvalue17']==''){
                $args['ownfieldskey17'] = '';
                $args['ownfieldsvalue17'] = '';
            }
            if ($args['ownfieldskey18']=='' || $args['ownfieldsvalue18']==''){
                $args['ownfieldskey18'] = '';
                $args['ownfieldsvalue18'] = '';
            }
            if ($args['ownfieldskey19']=='' || $args['ownfieldsvalue19']==''){
                $args['ownfieldskey19'] = '';
                $args['ownfieldsvalue19'] = '';
            }
            if ($args['ownfieldskey20']=='' || $args['ownfieldsvalue20']==''){
                $args['ownfieldskey20'] = '';
                $args['ownfieldsvalue20'] = '';
            }
        }

        $group = ($args['createFrom']=='createFromGroup')?true:false;
        if ($group)
        {
            if ($args['gText1']=='' || $args['gAttr1']=='none'){
                $args['gText1'] = '';  $args['gAttr1'] = '';
            }
            if ($args['gText2']=='' || $args['gAttr2']=='none'){
                $args['gText2'] = '';  $args['gAttr2'] = '';
            }
            if ($args['gText3']=='' || $args['gAttr3']=='none'){
                $args['gText3'] = '';  $args['gAttr3'] = '';
            }
            if ($args['gText4']=='' || $args['gAttr4']=='none'){
                $args['gText4'] = '';  $args['gAttr4'] = '';
            }
            if ($args['gText5']=='' || $args['gAttr5']=='none'){
                $args['gText5'] = '';  $args['gAttr5'] = '';
            }
            if ($args['gText6']=='' || $args['gAttr6']=='none'){
                $args['gText6'] = '';  $args['gAttr6'] = '';
            }
            if ($args['gText7']=='' || $args['gAttr7']=='none'){
                $args['gText7'] = '';  $args['gAttr7'] = '';
            }
            if ($args['gText8']=='' || $args['gAttr8']=='none'){
                $args['gText8'] = '';  $args['gAttr8'] = '';
            }
            if ($args['gText9']=='' || $args['gAttr9']=='none'){
                $args['gText9'] = '';  $args['gAttr9'] = '';
            }
            if ($args['gText10']=='' || $args['gAttr10']=='none'){
                $args['gText10'] = '';  $args['gAttr10'] = '';
            }
            if ($args['gText11']=='' || $args['gAttr11']=='none'){
                $args['gText11'] = '';  $args['gAttr11'] = '';
            }
            if ($args['gText12']=='' || $args['gAttr12']=='none'){
                $args['gText12'] = '';  $args['gAttr12'] = '';
            }
            if ($args['gText13']=='' || $args['gAttr13']=='none'){
                $args['gText13'] = '';  $args['gAttr13'] = '';
            }
            if ($args['gText14']=='' || $args['gAttr14']=='none'){
                $args['gText14'] = '';  $args['gAttr14'] = '';
            }
            if ($args['gText15']=='' || $args['gAttr15']=='none'){
                $args['gText15'] = '';  $args['gAttr15'] = '';
            }
            if ($args['gText16']=='' || $args['gAttr16']=='none'){
                $args['gText16'] = '';  $args['gAttr16'] = '';
            }
            if ($args['gText17']=='' || $args['gAttr17']=='none'){
                $args['gText17'] = '';  $args['gAttr17'] = '';
            }
            if ($args['gText18']=='' || $args['gAttr18']=='none'){
                $args['gText18'] = '';  $args['gAttr18'] = '';
            }
            if ($args['gText19']=='' || $args['gAttr19']=='none'){
                $args['gText19'] = '';  $args['gAttr19'] = '';
            }
            if ($args['gText20']=='' || $args['gAttr20']=='none'){
                $args['gText20'] = '';  $args['gAttr20'] = '';
            }
        }

        $profile = ($args['createFrom']=='createFromUserProfile')?true:false;
        if ($profile)
        {

        }
        parent::save($args);
    }

    public function validate($args)
    {
	    $db = Database::getActiveConnection();
        $error = Core::make('helper/validation/error');
        $single = ($args['createFrom']=='createFromSingle')?true:false;
        if($args['createFrom']!='createFromSingle'
        && $args['createFrom']!='createFromUserProfile'
        && $args['createFrom']!='createFromGroup')
        {
            $error->add(t('Error').' '.t('in').' '.t('Type').'!');
        }
        if($args['effect']!='none'
        && $args['effect']!='random'
        && $args['effect']!='fadeIn'
        && $args['effect']!='fadeInUp'
        && $args['effect']!='fadeInDown'
        && $args['effect']!='fadeInLeft'
        && $args['effect']!='fadeInRight'
        && $args['effect']!='fadeInUpBig'
        && $args['effect']!='fadeInDownBig'
        && $args['effect']!='fadeInLeftBig'
        && $args['effect']!='fadeInRightBig'
        && $args['effect']!='bounceIn'
        && $args['effect']!='bounceInUp'
        && $args['effect']!='bounceInDown'
        && $args['effect']!='bounceInLeft'
        && $args['effect']!='bounceInRight'
        && $args['effect']!='rotateIn'
        && $args['effect']!='rotateInUpLeft'
        && $args['effect']!='rotateInDownLeft'
        && $args['effect']!='rotateInUpRight'
        && $args['effect']!='rotateInDownRight'
        && $args['effect']!='flash'
        && $args['effect']!='shake'
        && $args['effect']!='bounce'
        && $args['effect']!='tada'
        && $args['effect']!='swing'
        && $args['effect']!='wobble'
        && $args['effect']!='wiggle') {
            $error->add(t('Error').' '.t('in').' '.t('Loading Effect').'!');
        }
        if($args['position']!='left'
            && $args['position']!='right')
        {
            $error->add(t('Error').' '.t('in').' '.t('Picture Position').'!');
        }
        if( $args['divClassContainer']!=6
            && $args['divClassContainer']!=7
            && $args['divClassContainer']!=8
            && $args['divClassContainer']!=9
            && $args['divClassContainer']!=10
            && $args['divClassContainer']!=11
            && $args['divClassContainer']!=12)
        {
            $error->add(t('Error').' '.t('in').' '.t('Container').' '.t('Width').'!');
        }
        if($single)
        {
            if($args['picture']<1)
            {
                $error->add(t('Error').' '.t('in').' '.t('Picture').'!');
            }
            else
            {
                $file = File::getById((int)$args['picture']);
                if ($file instanceof File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $error->add(t('Picture').' '.t('Error').'!');
                    }
                }
                else
                {
                    $error->add(t('Picture').' '.t('Error').'!');
                }
            }
            if(empty($args['name']))
            {
                $error->add(t('Error').' '.t('in').' '.t('Name'));
            }
            if(!empty($args['email']))
            {
                if(!filter_var($args['email'], FILTER_VALIDATE_EMAIL))
                {
                    $error->add(t('Error').' '.t('in').' '.t('Email'));
                }
            }
            if(!empty($args['web']))
            {
                if(!filter_var($args['web'], FILTER_VALIDATE_URL))
                {
                    $error->add(t('Error').' '.t('in').' '.t('Web'));
                }
            }
        }
        
        $group = ($args['createFrom']=='createFromGroup')?true:false;
        if ($group)
        {
            if ($args['gID']=='groupID_select'){
		        $error->add(t('No Group selected'));
            }
            elseif((int)$args['gID']==0){
		        $error->add(t('Group not valid'));
            }
            else
            {
                $gName = $db->fetchColumn("SELECT gName FROM Groups WHERE gID=?", array($args['gID']));
                if ($gName == 'Guest')
                {
                    $error->add(t('Group not allowed'));
                }
            }
            if ($args['gPictureID']=='none'){
		        $error->add(t('Select Picture to display!'));
            }
            else
            {
                if ($args['gPictureID']!='avatar' && $args['gPictureID']!='attribute'){
                    $error->add(t('Picture not allowed!'));
                }
            }
            $gText = array();
            $gAttr = array();
            for($r=1; $r<21; $r++)
            {
                if(!empty($args['gText'.$r]))
                {
                    if(in_array(trim($args['gText'.$r]), $gText))
                    {
                    $error->add(t('Duplicate Entry for').' "'.t($args['gText'.$r]).'"');
                    }
                    else
                    {
                    array_push($gText, trim($args['gText'.$r]));
                    }
                }
                if(trim($args['gAttr'.$r])!='none')
                {
                    if(in_array(trim($args['gAttr'.$r]), $gAttr))
                    {
                        $db = \Database::getActiveConnection();
                        $AttributeKey = $db->fetchColumn("SELECT akName FROM AttributeKeys WHERE akHandle=?", array($args['gAttr'.$r]));
                        #$error->add(t('Duplicate Entry for').' "' .t($AttributeKey).'"');
                    }
                    else
                    {
                        array_push($gAttr, $args['gAttr'.$r]);
                    }
                }
            }
        }
        $profile = ($args['createFrom']=='createFromUserProfile')?true:false;
        if ($profile)
        {

        }
        return $error;
    }

    private function getImageObjFromInt($int)
    {
        $ret = false;
        if ($int > 0)
        {
            $ret = File::getByID($int);
            if (!is_object($ret))
            {
                return false;
            }
        }
        return $ret;
    }
}
?>