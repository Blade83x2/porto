<?php
namespace Concrete\Package\Porto\Controller\SinglePage\Dashboard\PortoDesign;
use
    \Concrete\Core\Page\Controller\DashboardPageController,
    Core,
    Request,
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
=>  Project:  Porto
=>  Coder:    $ Blade83
*/

class Informationen extends DashboardPageController
{
    private
        $db	= NULL;

    public function on_start()
    {
        $this->db = Database::getActiveConnection();
    }

    public function view()
    {
        $res = $this->db->getRow("SELECT breadcrump_banner_text, breadcrump_banner_active, footer_copyright, footer_ribbon, email FROM PortoPackage WHERE cID=?", array(1));
        if ($res)
        {
            $this->set('breadcrump_banner_text', $res['breadcrump_banner_text']);
            $this->set('breadcrump_banner_active', $res['breadcrump_banner_active']);
            $this->set('footer_copyright', $res['footer_copyright']);
            $this->set('footer_ribbon', $res['footer_ribbon']);
            $this->set('email', $res['email']);
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
            if(trim(Request::post('email'))!='')
            {
                if(!filter_var(trim(Request::post('email')), FILTER_VALIDATE_EMAIL))
                {
                    $err[] = t('Syntax error in Email Address!');
                }
            }
            if(count($err)==0)
            {
                $sql= "UPDATE PortoPackage SET
                    breadcrump_banner_text=?,
                    footer_copyright=?,
                    footer_ribbon=?,
                    email=?
                WHERE cID=1";
                $this->db->ExecuteQuery($sql, array(
                    trim(  Request::post('breadcrump_banner_text')),
                    trim(  Request::post('footer_copyright')),
                    trim(  Request::post('footer_ribbon')),
                    trim(  Request::post('email'))
                ));
            }
            else
            {
                $this->set('info', '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Error').'</strong><ul><li>'.implode("</li><li>", $err).'</li></ul></div>');
            }
            $this->view();
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