<?php
namespace Concrete\Package\Porto\Controller\SinglePage\Dashboard;
use Concrete\Core\Block\Block;
use
    \Concrete\Core\Page\Controller\DashboardPageController,
    Loader,
    File,
    PermissionKey,
    Database,
    \Concrete\Core\Page\Page,
    \Concrete\Core\View\View,
    URL,
    \Concrete\Theme\Concrete\PageTheme;

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
=>  (c) ............... 2005-2015 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Filetime: 00:08 - 05.01.15
=>  Coder:    $ Blade83
*/

class PortoDesign extends DashboardPageController
{
    private
        $db = NULL;

    #public function __construct() {
#	$this->redirect("/dashboard/porto_design/settings");
 #   }    
        
        
    public function on_start()
    {
        $this->db = Database::getActiveConnection();
    }

    public function view()
    {
        $infoCnt = 0;
        $infoText = '';
        $res = $this->db->getRow("SELECT * FROM PortoPackage WHERE cID=?", array(1));
        if ($res)
        {

            $app_config_path = DIR_CONFIG_SITE . '/app.php';
            if (file_exists($app_config_path))
            {
                $app_config = require $app_config_path;
                if (in_array($app_config['theme_paths'], $app_config))
                {
                    $concrete5HelpLink = 'http://www.concrete5.org/documentation/developers/5.7/designing-for-concrete5/applying-your-theme-to-single-pages-with-theme-paths/';
                    $view = View::getInstance();
                    $theme_paths = $app_config['theme_paths'];
                    if (!in_array($theme_paths['/account'], $theme_paths))
                    {
                        $infoCnt++;
                        $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/account"</a> '.t('is missing in the configuration File! Example:').' <code>\'/account\' => \'porto\',</code></p>';
                    }
                    else
                    {
                        if($theme_paths['/account']!='porto')
                        {
                            $infoCnt++;
                            $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/account"</a> '.t('is currently set to %s', '<code>\'/account\' => \''.$theme_paths['/account'].'\',</code>').' '.t('Change the line to').' <code>\'/account\' => \'porto\',</code></p>';
                        }
                    }
                    if (!in_array($theme_paths['/account/*'], $theme_paths))
                    {
                        $infoCnt++;
                        $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/account/*"</a> '.t('is missing in the configuration File! Example:').' <code>\'/account/*\' => \'porto\',</code></p>';
                    }
                    else
                    {
                        if($theme_paths['/account/*']!='porto')
                        {
                            $infoCnt++;
                            $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/account/*"</a> '.t('is currently set to %s', '<code>\'/account/*\' => \''.$theme_paths['/account/*'].'\',</code>').' '.t('Change the line to').' <code>\'/account/*\' => \'porto\',</code></p>';
                        }
                    }
                    if (!in_array($theme_paths['/login'], $theme_paths))
                    {
                        $infoCnt++;
                        $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/login"</a> '.t('is missing in the configuration File! Example:').' <code>\'/login\' => \'porto\',</code></p>';
                    }
                    else
                    {
                        if($theme_paths['/login']!='porto')
                        {
                            $infoCnt++;
                            $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/login"</a> '.t('is currently set to %s', '<code>\'/login\' => \''.$theme_paths['/login'].'\',</code>').' '.t('Change the line to').' <code>\'/login\' => \'porto\',</code></p>';
                        }
                    }
                    if (!in_array($theme_paths['/register'], $theme_paths))
                    {
                        $infoCnt++;
                        $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/register"</a> '.t('is missing in the configuration File! Example:').' <code>\'/register\' => \'porto\',</code></p>';
                    }
                    else
                    {
                        if($theme_paths['/register']!='porto')
                        {
                            $infoCnt++;
                            $infoText .= '<p><a href="'.$concrete5HelpLink.'" target="_blank">theme_paths Array Key "/register"</a> '.t('is currently set to %s', '<code>\'/register\' => \''.$theme_paths['/register'].'\',</code>').' '.t('Change the line to').' <code>\'/register\' => \'porto\',</code></p>';
                        }
                    }

                }
                else
                {
                    $infoText .= '<p><a href="http://www.concrete5.org/documentation/developers/5.7/designing-for-concrete5/applying-your-theme-to-single-pages-with-theme-paths/" target="_blank">'. t('The Theme paths array key is missing in your configuration File!').' '.t('Create').' </a><br><br><code> /**<br>&nbsp;&nbsp;* Route themes<br>&nbsp;*/<br>\'theme_paths\' =&gt; array(<br>&nbsp;&nbsp;&nbsp;\'/dashboard\' => \'dashboard\',<br>&nbsp;&nbsp;&nbsp;\'/dashboard/*\' => \'dashboard\',<br>&nbsp;&nbsp;&nbsp;\'/account\' => \'porto\',<br>&nbsp;&nbsp;&nbsp;\'/account/*\' => \'porto\',<br>&nbsp;&nbsp;&nbsp;\'/install\' => VIEW_CORE_THEME,<br>&nbsp;&nbsp;&nbsp;\'/login\' => \'porto\',<br>&nbsp;&nbsp;&nbsp;\'/register\' => \'porto\',<br>&nbsp;&nbsp;&nbsp;\'/maintenance_mode\' => VIEW_CORE_THEME,<br>&nbsp;&nbsp;&nbsp;\'/upgrade\' => VIEW_CORE_THEME<br>),</code><br><br>'.t('in the return array!').'</p>';
                    $infoCnt++;
                }
            }
            else
            {
                $infoText .= '<p><a href="http://www.concrete5.org/documentation/developers/5.7/designing-for-concrete5/applying-your-theme-to-single-pages-with-theme-paths/" target="_blank">'.$app_config_path.'</a> '. t('is not present! Please create the File!').'</p>';
                $infoCnt++;
            }


            if (is_object($currentPageTheme=PageTheme::getSiteTheme()) && method_exists($currentPageTheme, 'getThemeHandle'))
            {
                if ($currentPageTheme->getThemeHandle() != 'porto' && $currentPageTheme->getThemeHandle() != 'onepage')
                {
                    $infoCnt++;
                    $infoText .= '<p>'.t('Currently there are no Porto Theme active. Go to %s and enable one of the Porto Themes!', '<a href="'.URL::to('/dashboard/pages/themes').'">Themes</a>').'</p>';
                }
                else
                {
                    # 404
                    if ($pg = Page::getByPath('/page_not_found')) {
                        $blocks = $pg->getBlocks('Main');
                        if (count($blocks) < 1)
                        {
                            $infoCnt++;
                            $infoText .= '<p>'.t('The System- Page %s does not have any content! You can create it now!', '<a href="'.$pg->getCollectionLink().'" target="_blank">'.t($pg->getCollectionName()).'</a>').'</p>';
                        }
                    }
                    # 403
                    if ($pg = Page::getByPath('/page_forbidden')) {
                        $blocks = $pg->getBlocks('Main');
                        if (count($blocks) < 1)
                        {
                            $infoCnt++;
                            $infoText .= '<p>'.t('The System- Page %s does not have any content! You can create it now!', '<a href="'.$pg->getCollectionLink().'" target="_blank">'.t($pg->getCollectionName()).'</a>').'</p>';
                        }
                    }
                }
            }
            else
            {
                $infoCnt++;
                $infoText .= '<p>'.t('Currently there is no Theme active. Go to %s and enable one of the Porto Themes!', '<a href="'.URL::to('/dashboard/pages/themes').'">Themes</a>').'</p>';
            }

            
            if ($res['load_footerinfotext_from_metadescription']==1)
            {
                $home = Page::getByID(HOME_CID);
                if (trim($home->getCollectionDescription())=='' && trim($home->getCollectionAttributeValue('meta_description'))=='')
                {
                    $infoCnt++;
                    $infoText .= '<p>'.t('Footer- Infotext can not autofilled by Meta- Description of "%s" page because it is not defined!', t($home->getCollectionName())).'</p>';
                }
                unset($home);
            }
            
            
            if ($res['searchpage_id'] == 0)
            {
                $infoCnt++;
                $infoText .= '<p>'.t('There is no target page for the search function defined!').'</p>';
            }
            else
            {
                if(is_object($searchPageLink=Page::getByID((int)$res['searchpage_id'])))
                {
                    if($searchPageLink->cPointerExternalLinkNewWindow==0)
                    {
                        $searchBlockAvailable = false;
                        $blocks = array_merge(
                            $searchPageLink->getBlocks('Main'),
                            $searchPageLink->getBlocks('Sidebar'),
                            $searchPageLink->getBlocks('Sidebar Footer')
                        );
                        foreach($blocks as $b)
                        {
                            $block = Block::getByID($b->bID);
                            unset($b);
                            if ($block->getBlockTypeName() == 'Search')
                            {
                                $searchBlockAvailable = true;
                                break;
                            }
                        }
                        if ($searchBlockAvailable == false)
                        {
                            $infoCnt++;
                            $infoText .= '<p>'.t('Can not find a Search- Block on the selected search page!').'</p>';
                        }
                        unset($blocks, $searchBlockAvailable);
                    }
                    else
                    {
			            $infoCnt++;
			            $infoText .= '<p>'.t('The target page for the search page must be a internal page!').'</p>';
                    }
                    if(trim($res['searchpage_text'])=='')
                    {
                        $infoCnt++;
                        $infoText .= '<p>'.t('There is no textbox placeholder defined for the search function!').'</p>';
                    }
                    if(trim($res['searchpage_empty_query'])=='')
                    {
                        $infoCnt++;
                        $infoText .= '<p>'.t('There is no Error Message defined for empty search querys!').'</p>';
                    }
                }
                else
                {
                    $infoCnt++;
                    $infoText .= '<p>'.t('The target page for the search function is incorrect!').'</p>';
                }
            }
            
            
            
            
            
            if ($res['page_logo'] != 0)
            {
                $file = File::getById((int)$res['page_logo']);
                if ($file instanceof File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $this->db->Execute("UPDATE PortoPackage SET page_logo=? WHERE cID=?", array(0, 1));
                        $infoCnt++;
                        $infoText .= '<p>'.t('The stored Logo (Header) is incorrect! The link will be deleted!').'</p>';
                    }
                }
                else
                {
                    $this->db->Execute("UPDATE PortoPackage SET page_logo=? WHERE cID=?", array(0, 1));
                    $infoCnt++;
                    $infoText .= '<p>'.t('The stored Logo (Header) does not exists! The link will be deleted!').'</p>';
                }
            }
            else
            {
		        $infoCnt++;
		        $infoText .= '<p>'.t('Select a Logo (Header) for your page!').'</p>';
            }
            
            
            
            if ($res['page_logo_mini'] != 0)
            {
                $file = File::getById((int)$res['page_logo_mini']);
                if ($file instanceof File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $this->db->Execute("UPDATE PortoPackage SET page_logo_mini=? WHERE cID=?", array(0, 1));
                        $infoCnt++;
                        $infoText .= '<p>'.t('The stored Logo (Footer) is incorrect! The link will be deleted!').'</p>';
                    }
                }
                else
                {
                    $this->db->Execute("UPDATE PortoPackage SET page_logo_mini=? WHERE cID=?", array(0, 1));
                    $infoCnt++;
                    $infoText .= '<p>'.t('The stored Logo (Footer) does not exists! The link will be deleted!').'</p>';
                }
            }
            else
            {
		        $infoCnt++;
		        $infoText .= '<p>'.t('Select a Logo (Footer) for your page!').'</p>';
            }
            if ($infoCnt > 0)
            {
                $this->set('info', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Attention!').'</strong><br><br>'.$infoText.'</div>');
            }
        }
    }
}
?>