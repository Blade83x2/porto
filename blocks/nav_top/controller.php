<?php
namespace Concrete\Package\Porto\Block\NavTop;
use
    Core,
	\Concrete\Core\Block\BlockController;

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
	    $btTable            = 'PortoPackageNavTop',
	    $btInterfaceWidth   = "370",
	    $btInterfaceHeight  = "600",
	    $btDefaultSet       = 'porto';


    public function getBlockTypeDescription()
    {
        return t("Display Links and a Phone number");
    }

    public function getBlockTypeName()
    {
        return t("Navigation Headerinfo");
    }


    public function save($args)
    {
        $args['tel'] = trim($args['tel']);
        $args['link1_text'] = trim($args['link1_text']);
        $args['link2_text'] = trim($args['link2_text']);
        parent::save($args);
    }

    public function validate($args)
    {
        $error = Core::make('helper/validation/error');
        $errorCnt = 0;
        # Link 1 check
        if (!empty($args['link1_text']) xor !empty($args['link1_page_id']))
        {
            if (empty($args['link1_text']))
            {
                $error->add(t('Link 1 Name is empty!'));
                $errorCnt++;
            }
            if (empty($args['link1_page_id']))
            {
                $error->add(t('Page for Link 1 is not selected!'));
                $errorCnt++;
            }
        }
        # Link 2 check
        if (!empty($args['link2_text']) xor !empty($args['link2_page_id']))
        {
            if (empty($args['link2_text']))
            {
                $error->add(t('Link 2 Name is empty!'));
                $errorCnt++;
            }
            if (empty($args['link2_page_id']))
            {
                $error->add(t('Page for Link 2 is not selected!'));
                $errorCnt++;
            }
        }
        # wurde irgendwas eingetragen??
        if ($errorCnt==0)
        {
            if (empty($args['link1_text']) && empty($args['link1_page_id']) && empty($args['link2_text']) && empty($args['link2_page_id']) && empty($args['tel']))
            {
                $error->add(t('No data given!'));
            }
        }
        return $error;
    }
}
?>