<?php
namespace Concrete\Package\Porto\Controller\SinglePage\Dashboard\PortoDesign;
use
    \Concrete\Core\Page\Controller\DashboardPageController,
    Core,
    Concrete\Core\Block\Block,
    PermissionKey,
    Request,
    Database,
    \Concrete\Core\Page\Page;

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

class Settings extends DashboardPageController
{
    private
        $db	= NULL;

    public function on_start()
    {

	    $this->db                               = Database::connection();
        $this->set('form',                      Core::make('helper/form'));
        $this->set('al',                        Core::make('helper/concrete/asset_library'));
        $this->set('pageselect',                Core::make('helper/form/page_selector'));
    }

    public function view()
    {
        $res = $this->db->getRow("SELECT * FROM PortoPackage WHERE cID=?", array(1));
        if ($res)
        {
            $info = array();

            $this->set('load_from_cdn',                                 $res['load_from_cdn']);
            $this->set('show_login',                                    $res['show_login']);
            $this->set('boxed_design',                                  $res['boxed_design']);
            $this->set('breadcrump_banner_active',                      $res['breadcrump_banner_active']);
            $this->set('scrolltotop_active',                            $res['scrolltotop_active']);
            $this->set('load_footerinfotext_from_metadescription',      $res['load_footerinfotext_from_metadescription']);

            $this->set('searchpage_id',                                 $res['searchpage_id']);
            $this->set('searchpage_text',                               $res['searchpage_text']);
            $this->set('searchpage_empty_query',                        $res['searchpage_empty_query']);

            if ($res['load_footerinfotext_from_metadescription']==1)
            {
                $home = Page::getByID(HOME_CID);
                if (trim($home->getCollectionDescription())=='' && trim($home->getCollectionAttributeValue('meta_description'))=='')
                {
                    $info[] = t('Footer- Infotext can not autofilled by Meta- Description of "%s" page because it is not defined!', t($home->getCollectionName()));
                }
                unset($home);
            }

            if ($res['searchpage_id']==0)
            {
                $info[] = t('There is no target page for the search function defined!');
            }
            else
            {
                if(!is_object($searchPageLink=Page::getByID($res['searchpage_id'])))
                {
                    $info[] = t('The target page for the search function is incorrect!');
                }
                else
                {
                    if($searchPageLink->cPointerExternalLinkNewWindow==1)
                    {
                        $info[] = t('The target page for the search page must be a internal page!');
                    }
                    else
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
                            $info[] = t('Can not find a Search- Block on the selected search page!');
                        }
                        unset($blocks, $searchBlockAvailable);






                    }
                    unset($searchPageLink);
                }

            }
            if ($res['searchpage_text'] == '' && $res['searchpage_id']!=0)
            {
                $info[] = t('There is no textbox placeholder defined for the search function!');
            }
            if ($res['searchpage_empty_query'] == '' && $res['searchpage_id']!=0)
            {
                $info[] = t('There is no Error Message defined for empty search querys!');
            }



            if (count($info) > 0)
            {
                $this->set('info', '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Information').'</strong><br><br><ul><li>'.implode("</li><li>", $info).'</li></ul></div>');
            }
        }
    }

    public function save()
    {
        if(!$this->hasPermissionToWrite())
        {
            return;
        }
        $vf = Core::make('helper/validation/form');
        $vf->setData($_POST);
        if (is_object($config = \Core::make('config/database')))
        {
            $obj = unserialize($config->get('porto.datamodel'));
            $vf->addRequiredToken($obj->security->formToken);
        }
        if (Request::isPost() && Request::post('submit') && $vf->test())
        {
            $err = array();
            $info = array();
            if ((int)Request::post('searchpage_id') != 0)
            {
                if(!is_object($searchPageLink=Page::getByID((int)Request::post('searchpage_id'))))
                {
                    $err[] = t('The target page for the search function is incorrect!');
                }
                else
                {
                    if($searchPageLink->cPointerExternalLinkNewWindow==1)
                    {
                        $err[] = t('The target page for the search page must be a internal page!');
                    }
                    else
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
                            $info[] = t('Can not find a Search- Block on the selected search page!');
                        }
                        unset($blocks, $searchBlockAvailable);

                    }
                    unset($searchPageLink);
                }
            }
            else
            {
                $info[] = t('There is no target page for the search function defined!');
            }
            if (Request::post('searchpage_text') == '' && (int)Request::post('searchpage_id') != 0)
            {
                $info[] = t('There is no textbox placeholder defined for the search function!');
            }
            if (Request::post('searchpage_empty_query') == '' && (int)Request::post('searchpage_id') != 0)
            {
                $info[] = t('There is no Error Message defined for empty search querys!');
            }


            if(count($err)==0)
            {
                if(count($info)>0)
                {
                    $this->set('info', '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Information').'</strong><br><br><ul><li>'.implode("</li><li>", $info).'</li></ul></div>');
                }
                $sql= "UPDATE PortoPackage SET
                    load_from_cdn=?,
                    show_login=?,
                    boxed_design=?,
                    breadcrump_banner_active=?,
                    scrolltotop_active=?,
                    load_footerinfotext_from_metadescription=?,
                    searchpage_id=?,
                    searchpage_text=?,
                    searchpage_empty_query=?
                WHERE cID=1";
                $this->db->executeQuery($sql, array(
                    (int) Request::post('load_from_cdn'),
                    (int) Request::post('show_login'),
                    (int) Request::post('boxed_design'),
                    (int) Request::post('breadcrump_banner_active'),
                    (int) Request::post('scrolltotop_active'),
                    (int) Request::post('load_footerinfotext_from_metadescription'),
                    (int) Request::post('searchpage_id'),
                    trim((string)Request::post('searchpage_text')),
                    trim((string)Request::post('searchpage_empty_query')),
                ));

                if((int)Request::post('boxed_design')==0)
                {
                    $sql= "UPDATE PortoPackage SET
                              background_image=?,
                              background_fix=?
                           WHERE cID=1";
                    $this->db->executeQuery($sql, array(
                        0,
                        0
                    ));
                }

            }
            else
            {
                $this->set('info', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Error').'</strong><br><br><ul><li>'.implode("</li><li>", $err).'</li></ul></div>');
            }
            return;
        }
    }

    public function hasPermissionToWrite()
    {
        if (is_object($pk=PermissionKey::getByHandle('porto_dashboard')) && $pk->can())
        {
            return true;
        }
        return false;
    }
}
?>