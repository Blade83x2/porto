<?php defined('C5_EXECUTE') or die("Access Denied.");
/**>       ____  _           _       ___ _____
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
$nh = Core::make('helper/navigation');
$db = Database::connection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
echo '<nav class="nav-main mega-menu"><ul class="nav nav-pills nav-main" id="mainMenu">';
if (!is_object($c))
    $c = \Concrete\Core\Page\Page::getCurrentPage();
if ($portoSetup['searchpage_id'] > 0 && $c->cID != $portoSetup['searchpage_id'])
{
    if (is_object($searchPage=\Concrete\Core\Page\Page::getByID($portoSetup['searchpage_id'])))
    {
        echo '<li><div class="input-group hidden-md hidden-lg">';
        echo '<input id="searchTextResponsive" type="text" class="form-control" placeholder="'.((isset($portoSetup['searchpage_text']))? $portoSetup['searchpage_text']:'').'" autocomplete="off">';
            echo '<span class="input-group-btn">';
                echo '<button id="searchButtonResponsive" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>';
            echo '</span>';
        echo '</div></li>';
        $loadSearchSript = true;
        $searchSubmitPath = DIR_REL.$searchPage->getCollectionPath();
        unset($searchPage);
    }
}

foreach ($controller->getNavItems() as $ni)
{
    $classes                                            = array();
    if ($ni->isCurrent)                                 $classes[] = 'active';
    if ($ni->inPath && !$ni->isCurrent)                 $classes[] = 'active';
    if ($ni->hasSubmenu)
    {
        if($ni->level==1)                               $classes[] = 'dropdown';
        else                                            $classes[] = 'dropdown-submenu';
    }
    $ni->classes = implode(" ", $classes);
    $niObj                                              = $ni->cObj;
    $parentPage                                         = Page::getByID($niObj->cParentID);
    $gandparentPage                                     = Page::getByID($parentPage->cParentID);

    $icon = ($niObj->getAttribute('porto_navigation_fa_icon') && $niObj->getAttribute('porto_navigation_fa_icon')!='')?'<i class="fa fa-'.$niObj->getAttribute('porto_navigation_fa_icon').'"></i>&nbsp;':'';
	if($niObj->getAttribute('porto_megamenu_full_width') && !$parentPage->getAttribute('porto_megamenu_full_width') && !$gandparentPage->getAttribute('porto_megamenu_full_width')){
        echo '<li class="dropdown mega-menu-item mega-menu-fullwidth'.((strlen($ni->classes)>0)?' '.$ni->classes:'').'">';
        echo '<a class="dropdown-toggle" href="#">'.$icon.t($ni->name).' <i class="fa fa-angle-down"></i></a>';
        echo '<ul class="dropdown-menu"><li><div class="mega-menu-content"><div class="row">';
        if(sizeof($childrens=$controller->getChildPages($niObj))>0) {
            foreach($childrens as $_child) {
                if (!$_child->getCollectionAttributeValue('exclude_nav')) {
                    $child_icon = ($_child->getAttribute('porto_navigation_fa_icon') && $_child->getAttribute('porto_navigation_fa_icon')!='')?'<i class="fa fa-'.$_child->getAttribute('porto_navigation_fa_icon').'"></i> ':'';
                    echo '<div class="col-md-3"><ul class="sub-menu"><li>';
                    echo '<span class="mega-menu-sub-title" title="'.t($_child->getCollectionName()).'">'.$child_icon.t($_child->getCollectionName()).'</span>';
                    echo '<ul class="sub-menu">';
                    if(sizeof($subchildrens=$controller->getChildPages($_child)) > 0)
                    {
                        foreach($subchildrens as $sub_child)
                        {
                            $subchild_icon = ($sub_child->getAttribute('porto_navigation_fa_icon') && $sub_child->getAttribute('porto_navigation_fa_icon')!='')?'<i class="fa fa-'.$sub_child->getAttribute('porto_navigation_fa_icon').'"></i> ':'';
                            echo (!$sub_child->getCollectionAttributeValue('exclude_nav'))?'<li><a href="'.$nh->getLinkToCollection($sub_child).'" title="'.t($sub_child->getCollectionName()).'">'.$subchild_icon.t($sub_child->getCollectionName()).'</a></li>':'';
                        }
                    }
                    echo '</ul>';
                    echo '</li></ul></div>';
                }
            }
        }
        echo '</div></div></li></ul>';
		echo '</li>';
    }
    elseif(!$niObj->getAttribute('porto_megamenu_full_width') && !$parentPage->getAttribute('porto_megamenu_full_width') && !$gandparentPage->getAttribute('porto_megamenu_full_width'))
    {
        echo '<li'.((strlen($ni->classes)>0)?' class="'.$ni->classes.'"':'').'>';
        echo '<a href="'.(($ni->hasSubmenu)?'#':$ni->url).'"'.(($ni->target!='_self')?' target="'.$ni->target.'"':'').((strlen($ni->classlink)>0)?' class="'.$ni->classlink.'"':'').'>'.$icon.t($ni->name).(($ni->hasSubmenu && $ni->level==1)?' <i class="fa fa-angle-down"></i>':'').'</a>';
        if ($ni->hasSubmenu)    echo '<ul class="dropdown-menu">';
        else                    echo '</li>'.(str_repeat('</ul></li>', $ni->subDepth));
	}
}
if ($portoSetup['show_login'])
{
    $u = new \Concrete\Core\User\User();
    if($u->isLoggedIn()) {
        echo '<li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">';
            echo '<a class="dropdown-toggle" href="#"><i class="fa fa-user"></i>'.t('User').'</a>';
            echo '<ul class="dropdown-menu">';
                echo '<li>';
                    echo '<div class="mega-menu-content">';
                        #echo '<div class="container">';
                            echo '<div class="row">';
                                echo '<div class="col-md-6">';
                                    echo '<div class="user-avatar">';
                                        if(is_object($u)) $ui=\Concrete\Core\User\UserInfo::getByID($u->getUserID());
                                        $ih = Core::make('helper/image');
                                        $av = Core::make('helper/concrete/avatar');
                                        echo '<div class="img-thumbnail">';
                                        if (is_object($ui) && $ui->hasAvatar() == true)
                                        {
                                            echo '<img src="'.(is_object($av)?$av->getImagePath($ui, false):'').'" alt="'.(is_object($u)?$u->getUserName():'').'" />';
                                        }
                                        else
                                        {
                                            if(is_object($ui))
                                            {
                                                switch($ui->getAttribute('gender'))
                                                {
                                                    case 'male':
                                                        echo '<img src="'.$view->getThemePath().'/img/avatar_male.png" alt="'.(is_object($u)?$u->getUserName():'').'" />';
                                                        break;
                                                    case 'female':
                                                        echo '<img src="'.$view->getThemePath().'/img/avatar_female.png" alt="'.(is_object($u)?$u->getUserName():'').'" />';
                                                        break;
                                                    default:
                                                        echo '<img src="'.$view->getThemePath().'/img/avatar_none.jpg" alt="'.(is_object($u)?$u->getUserName():'').'" />';
                                                        break;
                                                }
                                            }
                                        }
                                        echo '</div>';
                                        echo '<p>';
                                        unset($av);
                                        echo '<strong class="portoMenuLinkTextColor">'.(is_object($u)?$u->getUserName():'').'</strong>';
                                        echo '</p>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-md-6">';

                                echo '<ul class="position_links" style="list-style:none;">';
                                if (Config::get('concrete.user.profiles_enabled'))
                                {
                                    echo '<li class="position_links"><a href="'.URL::to('/members', 'profile').'" class="portoMenuLinkTextColor"><i class="fa fa-twitch"></i>&nbsp;'.t('Profil').'</a></li>';
                                    echo '<li class="position_links"><a href="'.URL::to('/members', 'directory').'" class="portoMenuLinkTextColor"><i class="fa fa-users"></i>&nbsp;'.t('Users').'</a></li>';
                                }
                                echo '<li class="position_links"><a href="'.URL::to('/account').'" class="portoMenuLinkTextColor"><i class="fa fa-cog"></i>&nbsp;'.t('Settings').'</a></li>';
                                echo '<li class="position_links"><a href="'.URL::to('/account/messages/', 'inbox').'" class="portoMenuLinkTextColor"><i class="fa fa-comment"></i>&nbsp;'.t('Messages').'</a></li>';
                                if (is_object($pk=PermissionKey::getByHandle('porto_dashboard')) && $pk->can()) {
                                    echo '<li class="position_links"><a href="'.URL::to('/dashboard/porto_design').'" class="portoMenuLinkTextColor" target="_blank"><i class="fa fa-dashboard"></i>&nbsp;'.t('Administration').'</a></li>';
                                }
                                echo '<li class="position_links"><a href="'.URL::to('/login', 'logout', Core::make('helper/validation/token')->generate('logout')).'" class="portoMenuLinkTextColor"><i class="fa fa-sign-out"></i>&nbsp;'.t("Sign Out").'</a></li>';
                                echo '</ul>';
                                echo '<ul class="position_rechts" style="list-style:none;">';
                                if (Config::get('concrete.user.profiles_enabled'))
                                {
                                    echo '<li class="position_rechts"><a href="'.URL::to('/members', 'profile').'" class="portoMenuLinkTextColor ">'.t('Profil').'&nbsp;<i class="fa fa-twitch"></i></a></li>';
                                    echo '<li class="position_rechts"><a href="'.URL::to('/members', 'directory').'" class="portoMenuLinkTextColor">'.t('Users').'&nbsp;<i class="fa fa-users"></i></a></li>';
                                }
                                echo '<li class="position_rechts"><a href="'.URL::to('/account').'" class="portoMenuLinkTextColor">'.t('Settings').'&nbsp;<i class="fa fa-cog"></i></a></li>';
                                echo '<li class="position_rechts"><a href="'.URL::to('/account/messages/', 'inbox').'" class="portoMenuLinkTextColor">'.t('Messages').'&nbsp;<i class="fa fa-comment"></i></a></li>';
                                if (is_object($pk=PermissionKey::getByHandle('porto_dashboard')) && $pk->can())
                                {
                                    echo '<li class="position_rechts"><a href="'.URL::to('/dashboard/porto_design').'" class="portoMenuLinkTextColor" target="_blank">'.t('Administration').'&nbsp;<i class="fa fa-dashboard"></i></a></li>';
                                }
                                echo '<li class="position_rechts"><a href="'.URL::to('/login', 'logout', Core::make('helper/validation/token')->generate('logout')).'" class="portoMenuLinkTextColor">'.t("Sign Out").'&nbsp;<i class="fa fa-sign-out"></i></a></li>';
                                echo '</ul>';

                                echo '</div>';
                            echo '</div>';
                        #echo '</div>';
                    echo '</div>';
                echo '</li>';
            echo '</ul>';
        echo '</li>';
    }
    elseif(!$u->isLoggedIn()) {
        if(is_object($login=\Concrete\Core\Page\Page::getByPath('/login')) && is_object($registerPage=\Concrete\Core\Page\Page::getByPath('/register')) && is_object($c=\Concrete\Core\Page\Page::getCurrentPage())) {
            if($c->cID != $login->cID && $c->cID != $registerPage->cID) {
                echo '<li class="dropdown mega-menu-item mega-menu-signin signin" id="headerAccount">';
                echo '<a class="dropdown-toggle" href="#"><i class="fa fa-user"></i>'.t('Login').'</a>';
                    echo '<ul class="dropdown-menu">';
                        echo '<li>';
                            echo '<div class="mega-menu-content">';
                                echo '<div class="row">';
                                    echo '<div class="col-md-12">';
                                        echo '<div class="signin-form">';
                                            echo '<div style="float:left;margin-right:3px"><span style="font-size:20px" class="portoMenuLinkTextColor">'.t('Login').'</span></div>';
                                            $activeAuths = AuthenticationType::getList(true, true);
                                            $loadAuthScript = true;
                                            foreach ($activeAuths as $auth) {
                                                if($auth->getAuthenticationTypeHandle()=='concrete' && count($activeAuths)>1) {
                                                    echo '<div style="float:left"><div onclick="portoNavigationLoad(\'login_form_concrete\')" class="portoMenuLinkTextColor"><i class="fa fa-user" title="'.BASE_URL.'" style="cursor:pointer;margin-left:5px;"></i></div></div>';
                                                }
                                                if($auth->getAuthenticationTypeHandle()=='community') {
                                                    echo '<div style="float:left"><div onclick="portoNavigationLoad(\'login_form_community\')" class="portoMenuLinkTextColor"><i class="fa fa-users" title="concrete5.org" style="cursor:pointer;margin-left: 2px;"></i></div></div>';
                                                }
                                                echo '<div style="float:left"><div onclick="portoNavigationLoad(\'login_form_'.$auth->getAuthenticationTypeHandle().'\')" class="portoMenuLinkTextColor"><i class="fa fa-'.$auth->getAuthenticationTypeHandle().'" title="'.$auth->getAuthenticationTypeName().'" style="cursor:pointer;margin-left: 5px;"></i></div></div>';
                                            }
                                            echo '<div style="clear: left"></div>';
                                            echo '<div class="row" id="login_form_concrete">';
                                                echo '<div class="col-md-12">';
                                                    echo '<form action="'.View::url('/login', 'authenticate', 'concrete').'" method="post">';
                                                        echo '<div class="row"><div class="form-group"><div class="col-sm-12"><input type="text" name="uName" placeholder="'.((Config::get('concrete.user.registration.email_registration'))?t('Email Address'):t('Username')).'" class="form-control input-sm" required></div></div></div>';
                                                        echo '<div class="row"><div class="form-group"><div class="col-md-12"><input type="password" name="uPassword" placeholder="'.t('Password').'" class="form-control input-sm" required><div style="cursor: pointer;" class="pull-right portoMenuLinkTextColor" id="headerRecover">'.t('Forgot Your Password?').'</div></div></div></div>';
                                                        echo '<div class="row"><div class="col-md-9"><span class="remember-box checkbox"><label for="uMaintainLogin"><input type="checkbox" id="uMaintainLogin" name="uMaintainLogin" value="1">'.t('Stay signed in for two weeks').'</label></span></div><div class="col-md-3">'.(Core::make('helper/validation/token')->output('login_concrete', true)).'<input type="submit" value="'.t('Login').'" class="btn btn-primary pull-right push-bottom"></div></div>';
                                                    echo '</form>';
                                                echo '</div>';
                                            echo '</div>';
                                            foreach ($activeAuths as $auth) {
                                                if($auth->getAuthenticationTypeHandle()!='concrete') {
                                                    echo '<div class="row" id="login_form_'.$auth->getAuthenticationTypeHandle().'" style="display:none"><div class="col-md-12"><form action="'.View::url('/ccm/system/authentication/oauth2/'.$auth->getAuthenticationTypeHandle(), 'attempt_auth').'" method="post"><div class="row"><div class="col-md-12"><input type="submit" value="'.t('Sign in with %s', $auth->getAuthenticationTypeName()).'" class="btn btn-primary pull-left push-bottom"></div></div></form></div></div>';
                                                }
                                            }
                                            $registerPage = \Concrete\Core\Page\Page::getByPath('/register');
                                            $currentPage = \Concrete\Core\Page\Page::getCurrentPage();
                                            if (Config::get('concrete.user.registration.enabled') && ($registerPage->cID != $currentPage->cID)) {
                                                echo '<div onclick="location.href=\''.View::url('/register').'\';" class="portoMenuLinkTextColor" style="cursor:pointer">'.t('Register').'</div>';
                                            }
                                            unset($registerPage, $currentPage);
                                        echo '</div>';
                                        echo '<div class="recover-form">';
                                            echo '<span  style="font-size:20px">'.t('Forgot Your Password?').'</span>';
                                            echo '<p>'.t('Enter your email address below. We will send you instructions to reset your password.').'</p>';
                                            echo '<form action="'.$view->url('/login/concrete', 'forgot_password').'" method="post"><div class="row"><div class="form-group"><div class="col-md-12"><input type="email" name="uEmail" id="uEmail" class="form-control input-sm" placeholder="'.t('Email Address').'" required></div></div></div><div class="row"><div class="col-md-6"><div style="cursor:pointer;" id="headerRecoverCancel" class="portoMenuLinkTextColor">'.t('Back').'</div></div><div class="col-md-6"><input type="submit" value="'.t('Reset and Email Password').'" name="resetPassword" class="btn btn-primary pull-right push-bottom"></div></div></form>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</li>';
                    echo '</ul>';
                echo '</li>';
            }
        }
    }
}
echo '</ul></nav>'."\n";
if ($loadAuthScript==true) {
    echo '<script> ';
        echo ' if (typeof portoNavigationLoad != \'function\') { ';
            echo ' function portoNavigationLoad(handle) { ';
                foreach ($activeAuths as $auth) {
                    echo ' if ($(\'div #login_form_'.$auth->getAuthenticationTypeHandle().'\').is(\':visible\')){ ';
                        echo ' if (handle == \'login_form_'.$auth->getAuthenticationTypeHandle().'\') return; ';
                            echo ' $("div #login_form_'.$auth->getAuthenticationTypeHandle().'").fadeOut( "fast", function() { ';
                                echo ' $(\'div #\'+handle).fadeIn(); ';
                        echo ' }); ';
                    echo ' } ';
                }
            echo ' } ';
        echo ' } ';
    echo '</script>';
}
if ($loadSearchSript==true && $portoSetup['searchpage_empty_query']!='') {
    echo '<script> ';
    echo '$(document).ready(function(){ ';
        echo "$('#searchTextResponsive').keypress(function(e){ ";
            echo "if (e.which == 13) { ";
                echo "if($(\"#searchTextResponsive\").val()=='') { ";
                    echo "$('#modalBoxSmallLabel').text('".t($portoSetup['searchpage_text'])."'); ";
                    echo "$('#modalBoxSmallBody').text('".t($portoSetup['searchpage_empty_query'])."'); ";
                    echo "$('#modalBoxSmall').modal({ show: true, keyboard: true }); ";
                    echo "} ";
                echo "else { location.href='".$searchSubmitPath."?query='+$('#searchTextResponsive').val(); }";
            echo "} ";
        echo "}); ";
        echo '$("#searchButtonResponsive").click(function(){ ';
            echo "if($(\"#searchTextResponsive\").val()=='') { ";
                echo "$('#modalBoxSmallLabel').text('".t($portoSetup['searchpage_text'])."'); ";
                echo "$('#modalBoxSmallBody').text('".t($portoSetup['searchpage_empty_query'])."'); ";
                echo "$('#modalBoxSmall').modal({ show: true, keyboard: true }); ";
            echo "} ";
            echo "else { location.href='".$searchSubmitPath."?query='+$('#searchTextResponsive').val(); }";
        echo "}); ";
    echo "}); ";
    echo '</script> ';
}
?>