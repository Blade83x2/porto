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
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
$effectNameArray = array(
    0  => 'fadeIn',
    1  => 'fadeInUp',
    2  => 'fadeInDown',
    3  => 'fadeInLeft',
    4  => 'fadeInRight',
    5  => 'fadeInUpBig',
    6  => 'fadeInDownBig',
    7  => 'fadeInLeftBig',
    8  => 'fadeInRightBig',
    9  => 'bounceIn',
    10 => 'bounceInUp',
    11 => 'bounceInDown',
    12 => 'bounceInLeft',
    13 => 'bounceInRight',
    14 => 'rotateIn',
    15 => 'rotateInUpLeft',
    16 => 'rotateInDownLeft',
    17 => 'rotateInUpRight',
    18 => 'rotateInDownRight',
    19 => 'shake',
    20 => 'bounce',
    21 => 'flash',
    22 => 'tada',
    23 => 'swing',
    24 => 'wobble',
    25 => 'wiggle'
);
$randomNumber = rand(0, count($effectNameArray)-1);
$p = \Concrete\Core\Page\Page::getCurrentPage();
$ih = Core::make('helper/image');

$u = new \Concrete\Core\User\User();
$ui = UserInfo::getByID($u->getUserID());


switch($createFrom)
{
    case 'createFromSingle':
        $picture = \Concrete\Core\File\File::getByID($picture);
        $picture = $ih->getThumbnail($picture, 155, 200, false);
        $image = '<div class="col-sm-2 text-center">';
        if($effect=='none')
        {
            $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive" src="'.$picture->src.'">';
        }
        elseif($effect=='random' && !$p->isEditMode())
        {
            $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive appear-animation" src="'.$picture->src.'" data-appear-animation="'.$effectNameArray[$randomNumber].'">';
        }
        elseif($effect!='random' && $effect!='none' && !$p->isEditMode()  )
        {
            $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive appear-animation" src="'.$picture->src.'" data-appear-animation="'.$effect.'">';
        }
        else
        {
            $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive" src="'.$picture->src.'">';
        }
        $image .=  '</div>';
        $table = '<div style="z-index:4;" class="col-sm-'.($divClassContainer -2).' table-responsive"><table class="table table-striped table-hover">';
        if($gender!='Firma')
        {
            $table .= '<thead><tr><th class="col-sm-3">'.t('Name').'</th><th>'.(($gender!='none')?$gender:'').' '.$name.'</th></tr></thead>';
        }
        else
        {
            $table .= '<thead><tr><th class="col-sm-3">'.t('Firma').'</th><th>'.$name.'</th></tr></thead>';
        }
        $table .= '<tbody>';
        if(!empty($department))
        {
            $table .= '<tr><td>'.t('Abteilung').':</td><td><i class="fa fa-chevron-circle-right"></i> '.$department.'</td></tr>';
        }
        if(!empty($telefon))
        {
            $table .= '<tr><td>'.t('Telefon').':</td><td><i class="fa fa-phone"></i> '.$telefon.'</td></tr>';
        }
        if(!empty($mobil))
        {
            $table .= '<tr><td>'.t('Mobil').':</td><td><i class="fa fa-tablet"></i> '.$mobil.'</td></tr>';
        }
        if(!empty($fax))
        {
            $table .= '<tr><td>'.t('Fax').':</td><td><i class="fa fa-fax"></i> '.$fax.'</td></tr>';
        }
        if(!empty($email))
        {
            $em = explode('@', $email);
            $table .= '<tr><td>'.t('Email').':</td><td><i class="fa fa-envelope"></i> <a onclick="this.href=\'mai\'+\'lto:'.$em[0].'\'+\'@\'+\''.$em[1].'\';" href="" style="unicode-bidi:bidi-override; direction: rtl;">'.strrev(htmlentities($email, ENT_QUOTES, APP_CHARSET)).'</a></td></tr>';
        }
        if(!empty($web))
        {
            $table .= '<tr><td>'.t('Web').':</td><td><i class="fa fa-globe"></i> <a href="'.$web.'" target="_blank">'.$web.'</a></td></tr>';
        }
        if(!empty($location))
        {
            $table .= '<tr><td>'.t('Standort').':</td><td><i class="fa fa-map-marker"></i> '.$location.'</td></tr>';
        }
        for($s=0;$s<21;$s++)
        {
            if(!empty(${"ownfieldskey$s"}))
            {
                $table .= '<tr><td>'.${"ownfieldskey$s"}.':</td><td> '.${"ownfieldsvalue$s"}.'</td></tr>';
            }
        }
        unset($s);
        $table .= '</tbody>';
        $table .= '</table></div>';
        if($position=='left')
        {
            echo '<br><div class="row">'.$image.''.$table.'</div><hr><br>';
        }
        elseif($position=='right')
        {
            echo '<br><div class="row">'.$table.$image.'</div><hr><br>';
        }
        break;
    case 'createFromGroup':

        if(is_object($group = \Group::getByID($gID)))
        {
            $db = \Database::getActiveConnection();
            $userList = new \UserList();
            $userList->filterByGroup($group);
            $users = $userList->get();
            if (count($users)>0)
            {
                foreach($users as $ui)
                {
                    if($gPictureID=='avatar')
                    {
                        $av = Core::make('helper/concrete/avatar');
                        if (is_object($ui) && $ui->hasAvatar()==true && is_object($av))
                        {
                            $image = '<div class="col-sm-2 text-center">';
                            if($effect=='none')
                            {
                                $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive" src="'.$av->getImagePath($ui, false).'">';
                            }
                            elseif($effect=='random' && !$p->isEditMode())
                            {
                                $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive appear-animation" src="'.$av->getImagePath($ui, false).'" data-appear-animation="'.$effectNameArray[$randomNumber].'">';
                            }
                            elseif($effect!='random' && $effect!='none' && !$p->isEditMode()  )
                            {
                                $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive appear-animation" src="'.$av->getImagePath($ui, false).'" data-appear-animation="'.$effect.'">';
                            }
                            else
                            {
                                $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive" src="'.$av->getImagePath($ui, false).'">';
                            }
                            $image .=  '</div>';
                        }
                    }
                    elseif($gPictureID=='attribute')
                    {
                        if (is_object($ui))
                        {
                            $picture = $ui->getAttribute($userAttributePicture);
                            if(intval($picture>0))
                            {
                                $picture = \Concrete\Core\File\File::getByID($picture);
                                $picture = $ih->getThumbnail($picture, 155, 200, false);
                                $image = '<div class="col-sm-2 text-center">';
                                if($effect=='none')
                                {
                                    $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive" src="'.$picture->src.'">';
                                }
                                elseif($effect=='random' && !$p->isEditMode())
                                {
                                    $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive appear-animation" src="'.$picture->src.'" data-appear-animation="'.$effectNameArray[$randomNumber].'">';
                                }
                                elseif($effect!='random' && $effect!='none' && !$p->isEditMode()  )
                                {
                                    $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive appear-animation" src="'.$picture->src.'" data-appear-animation="'.$effect.'">';
                                }
                                else
                                {
                                    $image .= '<img alt="" style="z-index:5;" class="img-thumbnail img-responsive" src="'.$picture->src.'">';
                                }
                                $image .=  '</div>';
                            }
                        }
                    }


                    if($ui->getAttribute('firstname') && $ui->getAttribute('lastname'))
                    {
                        $hasRealName = true;
                    }
                    else
                    {
                        $hasRealName = false;
                    }
                    $table = '';
                    if($position=='left')
                    {
                        $table .= '<br />';
                    }
                    
                    
                    $table .= '<div style="z-index:4;" class="col-sm-'.($divClassContainer -2).' table-responsive"><table class="table table-striped table-hover">';
                    if($hasRealName)
                    {
                        $table .= '<thead><tr><th class="col-sm-3">'.t('Name').'</th><th>'.(($ui->getAttribute('firstname')&&$ui->getAttribute('firstname')!='none')?$ui->getAttribute('firstname').' ':'').' '.$ui->getAttribute('lastname').'</th></tr></thead>';
                    }
                    else
                    {
                        $table .= '<thead><tr><th class="col-sm-3">'.t('Username').'</th><th>'.$ui->getUserName().'</th></tr></thead>';
                    }
                    $table .= '<tbody>';
                    for($s=1; $s<21; $s++)
                    {
                        if(!empty(${"gText{$s}"}))
                        {
                            $handle = ${"gAttr{$s}"};
                            $atID = $db->fetchColumn("SELECT atID FROM AttributeKeys WHERE akHandle=?", array($handle));
                            $atHandle = $db->fetchColumn("SELECT atHandle FROM AttributeTypes WHERE atID=?", array($atID));

                            if($ui->getAttribute($handle)) # && !empty($ui->getAttribute($handle)))
                            {
                                $table .= '<tr><td>'.t(${"gText{$s}"}).'</td><td>';
                                switch($atHandle)
                                {
                                    case 'text':
                                        $table .= $ui->getAttribute($handle);
                                        break;
                                    case 'textarea':
                                        $table .= $ui->getAttribute($handle);
                                        break;
                                    case 'boolean':
                                        $table .= ($ui->getAttribute($handle)==1)?'<span title="'.t('Yes').'" class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>':'<span title="'.t('No').'" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>';
                                        break;
                                    case 'date_time':
                                        $table .= date("d.m.Y H:i", strtotime($ui->getAttribute($handle)));
                                        break;
                                    case 'image_file':

                                        $fh = Core::make('helper/file');

                                        $file = $ui->getAttribute($handle);
                                        $supported_image = array( 'gif', 'jpg', 'jpeg', 'png' );
                                        $extension = strtolower($fh->getExtension($file->getFileName()));
                                        if (in_array($extension, $supported_image))
                                        {
                                            # echo "it's image";
                                            # $table .=  $file->getURL();
                                            $table .= '<a rel="lightbox" href="'.$file->getURL().'" target="_blank">'.basename($file->getURL()).'</a>';
                                        }
                                        else
                                        {
                                            $table .= '<a href="'.$file->getURL().'" target="_blank">'.basename($file->getURL()).'</a>';
                                        }

                                        break;
                                    case 'number':
                                        $table .= $ui->getAttribute($handle);
                                        break;
                                    case 'rating':
                                        $rating =  $ui->getAttribute($handle);
                                        $table .= '<div class="star-rating">';
                                        if($rating==0){
                                            $table .= '<span class="fa fa-star-o"></span>';
                                        } elseif($rating==10){
                                            $table .= '<span class="fa fa-star-half-o"></span>';
                                        } elseif($rating>=20){
                                            $table .= '<span class="fa fa-star"></span>';
                                        }
                                        if($rating<=20){
                                            $table .= '<span class="fa fa-star-o"></span>';
                                        } elseif($rating==30){
                                            $table .= '<span class="fa fa-star-half-o"></span>';
                                        } elseif($rating>=40){
                                            $table .= '<span class="fa fa-star"></span>';
                                        }
                                        if($rating<=40){
                                            $table .= '<span class="fa fa-star-o"></span>';
                                        } elseif($rating==50){
                                            $table .= '<span class="fa fa-star-half-o"></span>';
                                        } elseif($rating>=60){
                                            $table .= '<span class="fa fa-star"></span>';
                                        }
                                        if($rating<=60){
                                            $table .= '<span class="fa fa-star-o"></span>';
                                        } elseif($rating==70){
                                            $table .= '<span class="fa fa-star-half-o"></span>';
                                        } elseif($rating>=80){
                                            $table .= '<span class="fa fa-star"></span>';
                                        }
                                        if($rating<=80){
                                            $table .= '<span class="fa fa-star-o"></span>';
                                        } elseif($rating==90){
                                            $table .= '<span class="fa fa-star-half-o"></span>';
                                        } else{
                                            $table .= '<span class="fa fa-star"></span>';
                                        }
                                        $table .= '</div>';
                                        break;
                                    case 'select':
                                        $table .= $ui->getAttribute($handle);
                                        break;
                                    case 'address':
                                        $table .= '<address>'.$ui->getAttribute($handle).'</address>';
                                        break;
                                    case 'topics':
                                        // TODO anpassen wenn vorhanden
                                        # https://github.com/concrete5/concrete5-5.7.0/blob/master/web/concrete/attributes/topics/controller.php#L247
                                        $table .= $ui->getAttribute($handle);
                                        break;
                                    case 'social_links':
                                        $network = $ui->getAttribute($handle);
                                        if(isset($network['facebook']) && strlen($network['facebook'])>0)
                                            $table .= '<a href="'.$network['facebook'].'" target="_blank"><i class="fa fa-facebook-square" title="facebook"></i></a>&nbsp;';
                                        if(isset($network['twitter']) && strlen($network['twitter'])>0)
                                            $table .= '<a href="'.$network['twitter'].'" target="_blank"><i class="fa fa-twitter-square" title="twitter"></i></a>&nbsp;';
                                        if(isset($network['googleplus']) && strlen($network['googleplus'])>0)
                                            $table .= '<a href="'.$network['googleplus'].'" target="_blank"><i class="fa fa-google-plus-square" title="googleplus"></i></a>&nbsp;';
                                        if(isset($network['instagram']) && strlen($network['instagram'])>0)
                                            $table .= '<a href="'.$network['instagram'].'" target="_blank"><i class="fa fa-instagram" title="instagram"></i></a>&nbsp;';
                                        if(isset($network['tumblr']) && strlen($network['tumblr'])>0)
                                            $table .= '<a href="'.$network['tumblr'].'" target="_blank"><i class="fa fa-tumblr-square" title="tumblr"></i></a>&nbsp;';
                                        if(isset($network['github']) && strlen($network['github'])>0)
                                            $table .= '<a href="'.$network['github'].'" target="_blank"><i class="fa fa-github-square" title="github"></i></a>&nbsp;';
                                        if(isset($network['dribbble']) && strlen($network['dribbble'])>0)
                                            $table .= '<a href="'.$network['dribbble'].'" target="_blank"><i class="fa fa-dribbble" title="dribbble"></i></a>&nbsp;';
                                        if(isset($network['pinterest']) && strlen($network['pinterest'])>0)
                                            $table .= '<a href="'.$network['pinterest'].'" target="_blank"><i class="fa fa-pinterest" title="pinterest"></i></a>&nbsp;';
                                        if(isset($network['youtube']) && strlen($network['youtube'])>0)
                                            $table .= '<a href="'.$network['youtube'].'" target="_blank"><i class="fa fa-youtube" title="youtube"></i></a>&nbsp;';
                                        if(isset($network['linkedin']) && strlen($network['linkedin'])>0)
                                            $table .= '<a href="'.$network['linkedin'].'" target="_blank"><i class="fa fa-linkedin" title="linkedin"></i></a>&nbsp;';
                                        if(isset($network['soundcloud']) && strlen($network['soundcloud'])>0)
                                            $table .= '<a href="'.$network['soundcloud'].'" target="_blank"><i class="fa fa-soundcloud" title="soundcloud"></i></a>&nbsp;';
                                        if(isset($network['foursquare']) && strlen($network['foursquare'])>0)
                                            $table .= '<a href="'.$network['foursquare'].'" target="_blank"><i class="fa fa-foursquare" title="foursquare"></i></a>&nbsp;';
                                        if(isset($network['flickr']) && strlen($network['flickr'])>0)
                                            $table .= '<a href="'.$network['flickr'].'" target="_blank"><i class="fa fa-flickr" title="flickr"></i></a>&nbsp;';
                                        if(isset($network['reddit']) && strlen($network['reddit'])>0)
                                            $table .= '<a href="'.$network['reddit'].'" target="_blank"><i class="fa fa-reddit" title="reddit"></i></a>&nbsp;';
                                        if(isset($network['steam']) && strlen($network['steam'])>0)
                                            $table .= '<a href="'.$network['steam'].'" target="_blank"><i class="fa fa-steam" title="steam"></i></a>&nbsp;';
                                        if(isset($network['vine']) && strlen($network['vine'])>0)
                                            $table .= '<a href="'.$network['vine'].'" target="_blank"><i class="fa fa-vine" title="vine"></i></a>&nbsp;';
                                        if(isset($network['stumbleupon']) && strlen($network['stumbleupon'])>0)
                                            $table .= '<a href="'.$network['stumbleupon'].'" target="_blank"><i class="fa fa-stumbleupon" title="stumbleupon"></i></a>&nbsp;';
                                        if(isset($network['skype']) && strlen($network['skype'])>0)
                                            $table .= '<a href="'.$network['skype'].'" target="_blank"><i class="fa fa-skype" title="skype"></i></a>&nbsp;';
                                        if(isset($network['personal_website']) && strlen($network['personal_website'])>0)
                                            $table .= '<a href="'.$network['personal_website'].'" target="_blank"><i class="fa fa-globe" title="website"></i></a>&nbsp;';
                                        break;
                                }

                                $table .= '</td></tr>';
                            }

                        }

                    }

                    $table .= '</tbody></table></div>';
                    if($position=='left')
                    {
                        echo '<br><div class="row">'.$image.''.$table.'</div><br>';
                    }
                    elseif($position=='right')
                    {
                        echo '<br><div class="row">'.$table.$image.'</div><br>';
                    }
                    unset($image, $table);

                }
            }
            else
            {
                if($p->isEditMode())
                {
                    echo '<p style="color:#ff0000" class="text-center"><b>'.t('Empty').' '.$btName.' ('.$createFrom.') '.t('Block').'</b></p>';
                }
            }

        }

        break;
    case 'createFromUserProfile':
        break;
}
?>
