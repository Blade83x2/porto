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

=>  Coder:    $ Blade83
*/
class Controller extends BlockController 
{
	protected
	    $btTable                                    = 'PortoPackageNavTop',
	    $btInterfaceWidth                           = "370",
	    $btInterfaceHeight                          = "600",
	    $btDefaultSet                               = 'porto',
        $btCacheBlockRecord                         = true, // Should be safe in most cases, this will lighten the load on your database.
        $btCacheBlockOutput                         = true, // Basically, when this option is set, the block will always load whatever was entered after the last "save". This is also generally safe to use. However, in situations where you are relying on visitor contribution or other dynamic content, the cached output will be wrong.
        $btCacheBlockOutputOnPost                   = true, // This option will cache a block, even when the page it is on is recieving a post request. So you would want this disabled for something that needs input to change, but you can set this to true for something that does not.
        $btCacheBlockOutputForRegisteredUsers       = true; // Unregistered users will never have complicated permissions that might influence what they can or can not see, so some things are cacheable for them, but not registered users. If your block has nothing to do with permissions, this can be true.


    public function getBlockTypeDescription()
    {
        return t("Display Links and a Phone number");
    }

    public function getBlockTypeName()
    {
        return t("Navigation Headerinfo");
    }

    public function getJavaScriptStrings()
    {
        // in javascriptcode alert( ccm_t('image-required') );
        return array(
            // 'image-required' => t('You must select an image.'),
        );
    }

    public function registerViewAssets($outputContent = '')
    {
        ## Require our formigoSlider javascript
        #$this->requireAsset('javascript','formigoSlider');
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