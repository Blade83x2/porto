<?php
namespace Concrete\Package\Porto\Block\TextHeading;
use
    \Core,
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
	    $btTable                                  = 'PortoPackageTextHeading',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "700",
	    $btInterfaceHeight                        = "270",
        $btCacheBlockRecord                       = true, // Should be safe in most cases, this will lighten the load on your database.
        $btCacheBlockOutput                       = true, // Basically, when this option is set, the block will always load whatever was entered after the last "save". This is also generally safe to use. However, in situations where you are relying on visitor contribution or other dynamic content, the cached output will be wrong.
        $btCacheBlockOutputOnPost                 = true, // This option will cache a block, even when the page it is on is recieving a post request. So you would want this disabled for something that needs input to change, but you can set this to true for something that does not.
        $btCacheBlockOutputForRegisteredUsers     = true; // Unregistered users will never have complicated permissions that might influence what they can or can not see, so some things are cacheable for them, but not registered users. If your block has nothing to do with permissions, this can be true.

    public function getBlockTypeDescription()
    {
        return t("Create a Text Heading with animations");
    }

    public function getBlockTypeName()
    {
        return t("Text Heading");
    }

    public function getBlockTypeHelp()
    {
        $help = t("<b>Creates a cool Heading-Text with animaitons.</b>");
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
        return $this->headingtext;
    }

    public function on_start()
    {

    }

    public function duplicate($newBlockID)
    {
	
    }

    public function delete()
    {
	    $db = \Database::connection();
	    $db->executeQuery("DELETE FROM PortoPackageTextHeading WHERE bID=?", array($this->bID));
    }

    public function view()
    {
	    $this->set('headingtext', $this->headingtext);
	    $this->set('texteffect', $this->texteffect);
	    $this->set('textsize', $this->textsize);
	    $this->set('textstrong', $this->textstrong);
    }

    public function edit()
    {
	    $this->set('headingtext', $this->headingtext);
	    $this->set('texteffect', $this->texteffect);
	    $this->set('textsize', $this->textsize);
	    $this->set('textstrong', $this->textstrong);
    }

    public function add()
    {
        $this->set('textsize', 'h3');
        $this->set('textstrong', 1);
    }

    public function save($args)
    {
        parent::save($args);
    }

    public function validate($args)
    {
	    $db = \Database::connection();
        $error = Core::make('helper/validation/error');
        if(trim($args['headingtext'])=='')
        {
           $error->add(t('Please type in a heading text!'));
        }

        if($args['textsize']!='h1'
            && $args['textsize']!='h2'
            && $args['textsize']!='h3'
            && $args['textsize']!='h4'
            && $args['textsize']!='h5'
            && $args['textsize']!='h6')
        {
            $error->add(t('Error').' '.t('in').' '.t('Text size').'!');
        }


        if($args['textstrong']!=0 && $args['textstrong']!=1)
        {
            $error->add(t('Error').' '.t('in').' '.t('Text strong').'!');
        }

        if($args['texteffect']!='none'
            && $args['texteffect']!='random'
            && $args['texteffect']!='fadeIn'
            && $args['texteffect']!='fadeInUp'
            && $args['texteffect']!='fadeInDown'
            && $args['texteffect']!='fadeInLeft'
            && $args['texteffect']!='fadeInRight'
            && $args['texteffect']!='fadeInUpBig'
            && $args['texteffect']!='fadeInDownBig'
            && $args['texteffect']!='fadeInLeftBig'
            && $args['texteffect']!='fadeInRightBig'
            && $args['texteffect']!='bounceIn'
            && $args['texteffect']!='bounceInUp'
            && $args['texteffect']!='bounceInDown'
            && $args['texteffect']!='bounceInLeft'
            && $args['texteffect']!='bounceInRight'
            && $args['texteffect']!='rotateIn'
            && $args['texteffect']!='rotateInUpLeft'
            && $args['texteffect']!='rotateInDownLeft'
            && $args['texteffect']!='rotateInUpRight'
            && $args['texteffect']!='rotateInDownRight'
            && $args['texteffect']!='flash'
            && $args['texteffect']!='shake'
            && $args['texteffect']!='bounce'
            && $args['texteffect']!='tada'
            && $args['texteffect']!='swing'
            && $args['texteffect']!='wobble'
            && $args['texteffect']!='wiggle')
        {
            $error->add(t('Error').' '.t('in').' '.t('Text Effect').'!');
        }
        return $error;
    }
}
?>