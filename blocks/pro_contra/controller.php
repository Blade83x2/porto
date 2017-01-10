<?php
namespace Concrete\Package\Porto\Block\ProContra;
use
    \Core,
    \File,
    \Concrete\Core\Block\BlockController;

defined('C5_EXECUTE') or die("Access Denied.");
/**>          ____  _           _       ___ _____
 *>          | __ )| | __ _  __| | ___ ( _ )___ /
 *>         |  _ \| |/ _` |/ _` |/ _ \/ _ \ |_ \
 *>        | |_) | | (_| | (_| |  __/ (_) |__) |
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
        $btTable                                  = 'PortoPackageProContra',
        $btDefaultSet                             = 'porto',
        $btInterfaceWidth                         = "550",
        $btInterfaceHeight                        = "680",
        $btCacheBlockRecord                       = true, // Should be safe in most cases, this will lighten the load on your database.
        $btCacheBlockOutput                       = true, // Basically, when this option is set, the block will always load whatever was entered after the last "save". This is also generally safe to use. However, in situations where you are relying on visitor contribution or other dynamic content, the cached output will be wrong.
        $btCacheBlockOutputOnPost                 = true, // This option will cache a block, even when the page it is on is recieving a post request. So you would want this disabled for something that needs input to change, but you can set this to true for something that does not.
        $btCacheBlockOutputForRegisteredUsers     = true; // Unregistered users will never have complicated permissions that might influence what they can or can not see, so some things are cacheable for them, but not registered users. If your block has nothing to do with permissions, this can be true.

    public function getBlockTypeName()
    {
        return t("Pro/Contra Table");
    }

    public function getBlockTypeDescription()
    {
        return t("Listing for Pro / Contra");
    }

    public function getBlockTypeHelp()
    {
        $help = t("Add a Pro- Contra Table");
        return $help;
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

    public function getSearchableContent()
    {
        $content = array();
        $content[] = $this->name;
        $content[] = $this->proTextDescription;
        $content[] = $this->proText;
        $content[] = $this->contraTextDescription;
        $content[] = $this->contraText;
        $content[] = $this->herkunft;
        $content[] = $this->zubereitung;
        $content[] = $this->anwendung;
        $content[] = $this->anmerkung;
        return implode(' - ', $content);
    }

    public function view()
    {
        $this->set('ih', \Core::make('helper/image'));
    }

    public function add()
    {
        $this->set('al', \Core::make('helper/concrete/asset_library'));
        $this->set('form', \Core::make('helper/form'));
    }

    public function edit()
    {
        $this->set('al', \Core::make('helper/concrete/asset_library'));
        $this->set('form', \Core::make('helper/form'));
        $this->set('name', $this->name);
        $this->set('pictureID', File::getByID($this->pictureID));
        $this->set('proTextDescription', $this->proTextDescription);
        $this->set('proText', $this->proText);
        $this->set('contraTextDescription', $this->contraTextDescription);
        $this->set('contraText', $this->contraText);
        $this->set('herkunft', $this->herkunft);
        $this->set('zubereitung', $this->zubereitung);
        $this->set('anwendung', $this->anwendung);
        $this->set('anmerkung', $this->anmerkung);
    }

    public function save($args)
    {
        $args['name'] = trim($args['name']);
        $args['proTextDescription'] = trim($args['proTextDescription']);
        $args['proText'] = trim($args['proText']);
        $args['contraTextDescription'] = trim($args['contraTextDescription']);
        $args['contraText'] = trim($args['contraText']);
        $args['herkunft'] = trim($args['herkunft']);
        $args['zubereitung'] = trim($args['zubereitung']);
        $args['anwendung'] = trim($args['anwendung']);
        $args['anmerkung'] = trim($args['anmerkung']);
        parent::save($args);
    }

    public function validate($args)
    {
        $e = \Core::make('helper/validation/error');
        if( strlen( trim($args['name']) ) == 0 && $args['pictureID'] == 0)
        {
            $e->add(t('No entry for Name or / and Picture!'));
        }
        if(strlen(trim($args['proTextDescription']))==0 && strlen(trim($args['contraTextDescription']))==0)
        {
            $e->add(t('Pro- and Contra Name are empty!'));
        }
        if(strlen(trim($args['proTextDescription']))>0 && strlen(trim($args['proText']))==0)
        {
            $e->add(t('Pro list has no values!'));
        }
        if(strlen(trim($args['contraTextDescription']))>0 && strlen(trim($args['contraText']))==0)
        {
            $e->add(t('Contra list has no values!'));
        }

        // TODO
        # image filtern bei select file

        return $e;
    }
}
?>