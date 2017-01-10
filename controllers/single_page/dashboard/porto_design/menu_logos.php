<?php
namespace Concrete\Package\Porto\Controller\SinglePage\Dashboard\PortoDesign;
use
    \Concrete\Core\Page\Controller\DashboardPageController,
    Core,
    Request,
    File,
    PermissionKey,
    Database;

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

=>  Filetime: 00:08 - 24.03.15
=>  Coder:    $ Blade83
*/

class MenuLogos extends DashboardPageController
{
    private
        $db = false;

    public function on_start()
    {
        $this->set('form',                      Core::make('helper/form'));
        $this->set('al',                        Core::make('helper/concrete/asset_library'));
        $this->db                               = Database::connection();
    }

    public function view()
    {
        $infoCnt = 0;
        $infoText = '';
        $res = $this->db->getRow("SELECT * FROM PortoPackage WHERE cID=?", array(1));
        if ($res)
        {
            $this->set('page_logo',                                     $this->getImageObjFromInt($res['page_logo']));
            $this->set('page_logo_x',                                   $res['page_logo_x']);
            $this->set('page_logo_y',                                   $res['page_logo_y']);
            $this->set('page_logo_mini',                                $this->getImageObjFromInt($res['page_logo_mini']));

            $this->set('stickymenu_active',                             $res['stickymenu_active']);
            $this->set('second_stickymenu_gfx',                         $this->getImageObjFromInt($res['second_stickymenu_gfx']));
            $this->set('second_stickymenu_gfx_x',                       $res['second_stickymenu_gfx_x']);
            $this->set('second_stickymenu_gfx_y',                       $res['second_stickymenu_gfx_y']);
            $this->set('second_stickymenu_gfx_top',                     $res['second_stickymenu_gfx_top']);

            $this->set('background_image',                              $this->getImageObjFromInt($res['background_image']));
            $this->set('background_fix',                                $res['background_fix']);
            $this->set('boxed_design',                                  $res['boxed_design']);



            if ($res['page_logo'] != 0)
            {
                $file = File::getById((int)$res['page_logo']);
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $this->db->ExecuteQuery("UPDATE PortoPackage SET page_logo=? WHERE cID=?", array(0, 1));
                        $this->set('page_logo', false);
                        $infoCnt++;
                        $infoText .= '<p>'.t('The stored Logo (Header) is incorrect! The link will be deleted!').'</p>';
                    }
                }
                else
                {
                    $this->db->ExecuteQuery("UPDATE PortoPackage SET page_logo=? WHERE cID=?", array(0, 1));
                    $this->set('page_logo', false);
                    $infoCnt++;
                    $infoText .= '<p>'.t('The stored Logo (Header) does not exists! The link will be deleted!').'</p>';
                }
            }
            if ($res['page_logo_mini'] != 0)
            {
                $file = File::getById((int)$res['page_logo_mini']);
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $this->db->ExecuteQuery("UPDATE PortoPackage SET page_logo_mini=? WHERE cID=?", array(0, 1));
                        $this->set('page_logo_mini', false);
                        $infoCnt++;
                        $infoText .= '<p>'.t('The stored Logo (Footer) is incorrect! The link will be deleted!').'</p>';
                    }
                }
                else
                {
                    $this->db->ExecuteQuery("UPDATE PortoPackage SET page_logo_mini=? WHERE cID=?", array(0, 1));
                    $this->set('page_logo_mini', false);
                    $infoCnt++;
                    $infoText .= '<p>'.t('The stored Logo (Footer) does not exists! The link will be deleted!').'</p>';
                }
            }
            if ($res['second_stickymenu_gfx'] != 0)
            {
                $file = File::getById((int)$res['second_stickymenu_gfx']);
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $this->db->ExecuteQuery("UPDATE PortoPackage SET second_stickymenu_gfx=? WHERE cID=?", array(0, 1));
                        $this->set('second_stickymenu_gfx', false);
                        $infoCnt++;
                        $infoText .= '<p>'.t('The stored Sticky Menu Logo is incorrect! The link will be deleted!').'</p>';
                    }
                }
                else
                {
                    $this->db->ExecuteQuery("UPDATE PortoPackage SET second_stickymenu_gfx=? WHERE cID=?", array(0, 1));
                    $this->set('page_logo_mini', false);
                    $infoCnt++;
                    $infoText .= '<p>'.t('The stored Sticky Menu Logo does not exists! The link will be deleted!').'</p>';
                }
            }
            if ($res['background_image'] != 0)
            {
                $file = File::getById((int)$res['background_image']);
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $this->db->ExecuteQuery("UPDATE PortoPackage SET background_image=? WHERE cID=?", array(0, 1));
                        $this->set('background_image', false);
                        $infoCnt++;
                        $infoText .= '<p>'.t('The stored Background Image is incorrect! The link will be deleted!').'</p>';
                    }
                }
                else
                {
                    $this->db->ExecuteQuery("UPDATE PortoPackage SET background_image=? WHERE cID=?", array(0, 1));
                    $this->set('background_image', false);
                    $infoCnt++;
                    $infoText .= '<p>'.t('The stored Background Image does not exists! The link will be deleted!').'</p>';
                }
            }
            if ($infoCnt > 0)
            {
                $this->set('info', '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Attention!').'</strong>'.$infoText.'</div>');
            }
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




    public function save()
    {
        $formError = 0;
        $formErrorMsg = '';
        if(!$this->hasPermissionToWrite()){

            $formErrorMsg .= '<p>'.t('You do not have permission to edit this page!').'</p>';
            $this->set('msg', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Error!').'</strong>'.$formErrorMsg.'</div>');
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
            // TODO
            ############################################################################################### bei animierem funktioniert top nicht mehr
            $res = $this->db->getRow("SELECT * FROM PortoPackage WHERE cID=?", array(1));
            $page_logo_x                    = $res['page_logo_x'];
            $page_logo_y                    = $res['page_logo_y'];
            $boxed_design                   = $res['boxed_design'];
            if((int)Request::post('page_logo')!=0)
            {
                $file = File::getById((int)Request::post('page_logo'));
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $formError++;
                        $formErrorMsg .= '<p>'.t('The Logo (Header) is incorrect!').'</p>';
                        $this->set('page_logo', false);
                    }
                    else
                    {
                        if ($res['page_logo'] != (int)Request::post('page_logo'))
                        {
                            $page_logo_x = 250;
                            $page_logo_y = 50;
                        }
                        else
                        {
                            $page_logo_x        = (int)Request::post('page_logo_x');
                            $page_logo_y        = (int)Request::post('page_logo_y');
                            if ($page_logo_x<2) $page_logo_x = 1;
                            if ($page_logo_y<2) $page_logo_y = 1;
                        }
                    }
                }
                else
                {
                    $formError++;
                    $formErrorMsg .= '<p>'.t('The Logo (Header) is incorrect!').'</p>';
                    $this->set('page_logo', false);
                }
            }
            else
            {
                $page_logo_x = 0;
                $page_logo_y = 0;
            }

            if((int)Request::post('page_logo_mini')!=0)
            {
                $file = File::getById((int)Request::post('page_logo_mini'));
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $page_logo_mini = 0;
                        $formError++;
                        $formErrorMsg .= '<p>'.t('The Logo (Footer) is incorrect!').'</p>';
                        $this->set('page_logo_mini', false);
                    }
                    else
                    {
                        $page_logo_mini = (int)Request::post('page_logo_mini');
                    }
                }
                else
                {
                    $formError++;
                    $page_logo_mini = 0;
                    $formErrorMsg .= '<p>'.t('The Logo (Footer) is incorrect!').'</p>';
                    $this->set('page_logo_mini', false);
                }
            }

            $second_stickymenu_gfx_x        = $res['second_stickymenu_gfx_x'];
            $second_stickymenu_gfx_y        = $res['second_stickymenu_gfx_y'];
            $second_stickymenu_gfx_top      = $res['second_stickymenu_gfx_top'];
            if( (int)Request::post('second_stickymenu_gfx')>0 && ((int)Request::post('stickymenu_active')==1 || (int)Request::post('stickymenu_active')==2))
            {
                $stickymenu_active = Request::post('stickymenu_active');
                $file = File::getById((int)Request::post('second_stickymenu_gfx'));
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $formError++;
                        $formErrorMsg .= '<p>'.t('The Sticky Menu Logo is incorrect!').'</p>';
                        $this->set('second_stickymenu_gfx', false);
                        $stickymenu_active = 0;
                    }
                    else
                    {
                        $second_stickymenu_gfx = (int)Request::post('second_stickymenu_gfx');
                        if($res['second_stickymenu_gfx'] != (int)Request::post('second_stickymenu_gfx'))
                        {
                            // neue grafik
                            $second_stickymenu_gfx_x = 250;
                            $second_stickymenu_gfx_y = 45;
                            $second_stickymenu_gfx_top = 40;
                        }
                        else
                        {
                            $second_stickymenu_gfx_x = (int)Request::post('second_stickymenu_gfx_x');
                            $second_stickymenu_gfx_y = (int)Request::post('second_stickymenu_gfx_y');
                            if ($second_stickymenu_gfx_x<2) $second_stickymenu_gfx_x = 1;
                            if ($second_stickymenu_gfx_y<2) $second_stickymenu_gfx_y = 1;
                            $second_stickymenu_gfx_top = (int)Request::post('second_stickymenu_gfx_top');
                        }
                    }
                }
                else
                {
                    $formError++;
                    $formErrorMsg .= '<p>'.t('The Sticky Menu Logo is incorrect!').'</p>';
                    $this->set('second_stickymenu_gfx', false);
                    $stickymenu_active = 0;
                }
                unset($file);
            }
            else
            {
                $stickymenu_active = 0;
                $second_stickymenu_gfx = 0;
                $second_stickymenu_gfx_x = 0;
                $second_stickymenu_gfx_y = 0;
                $second_stickymenu_gfx_top = 0;
            }
            if($stickymenu_active==0)
            {
                $second_stickymenu_gfx = 0;
            }

            if((int)Request::post('background_fix')==1 && (int)Request::post('background_image')>0 && $boxed_design==1)
            {
                $background_fix = 1;
            }
            else
            {
                $background_fix = 0;
            }
            if((int)Request::post('background_image')!=0 && $boxed_design==1)
            {
                $file = File::getById((int)Request::post('background_image'));
                if ($file instanceof \Concrete\Core\File\File)
                {
                    if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                    {
                        $background_fix = 0;
                        $formError++;
                        $formErrorMsg .= '<p>'.t('The Background Image is incorrect!').'</p>';
                    }
                    $background_image = (int)Request::post('background_image');
                }
                else
                {
                    $background_fix = 0;
                    $formError++;
                    $formErrorMsg .= '<p>'.t('The Background Image is incorrect!').'</p>';
                    $background_image = 0;
                }
            }
            else
            {
                $background_image = 0;
            }


            if ($formError > 0)
            {
                $this->set('info', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Error!').'</strong>'.$formErrorMsg.'</div>');
                $this->view();
                return;
            }
            else
            {

                $sql= "UPDATE PortoPackage SET
                    page_logo_x=?,
                    page_logo_y=?,
                    page_logo=?
                WHERE cID=1";
                $this->db->ExecuteQuery($sql, array(
                    (int) $page_logo_x,
                    (int) $page_logo_y,
                    (int) Request::post('page_logo')
                ));

                $sql= "UPDATE PortoPackage SET
                        page_logo_mini=?
                    WHERE cID=1";
                $this->db->ExecuteQuery($sql, array(
                    (int)$page_logo_mini
                ));

                $sql= "UPDATE PortoPackage SET
                        second_stickymenu_gfx=?,
                        second_stickymenu_gfx_x=?,
                        second_stickymenu_gfx_y=?,
                        second_stickymenu_gfx_top=?,
                        stickymenu_active=?
                    WHERE cID=1";
                $this->db->ExecuteQuery($sql, array(
                    (int)$second_stickymenu_gfx,
                    (int)$second_stickymenu_gfx_x,
                    (int)$second_stickymenu_gfx_y,
                    (int)$second_stickymenu_gfx_top,
                    (int)$stickymenu_active
                ));

                $sql= "UPDATE PortoPackage SET
                        background_fix=?,
                        background_image=?
                    WHERE cID=1";
                $this->db->ExecuteQuery($sql, array(
                    (int)$background_fix,
                    (int)$background_image
                ));
                $this->redirect('/dashboard/porto_design/menu_logos');
            }
        }
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