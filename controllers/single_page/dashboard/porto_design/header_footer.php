<?php
namespace Concrete\Package\Porto\Controller\SinglePage\Dashboard\PortoDesign;
use
    \Concrete\Core\Page\Controller\DashboardPageController,
    Core,
    Request,
    PermissionKey,
    Database,
    Package;

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

class HeaderFooter extends DashboardPageController
{
    private
        $db	= NULL;

    public function on_start()
    {
        $this->db = Database::getActiveConnection();
    }

    public function view()
    {
        $res = $this->db->getRow("SELECT * FROM PortoPackage WHERE cID=?", array(1));
        if ($res)
        {
            if (is_object($p = Package::getByHandle('porto')))
            {
                $this->set('imgPath', BASE_URL.$p->getRelativePath().'/themes/porto/img/help/dashboard/');
            }
            $this->set('header_type', $res['header_type']);
            $this->set('footer_type', $res['footer_type']);
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
            $sql= "UPDATE PortoPackage SET
                header_type=?,
                footer_type=?
            WHERE cID=1";
            $this->db->ExecuteQuery($sql, array(
                (int) Request::post('header_type'),
                (int) Request::post('footer_type'),
            ));
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