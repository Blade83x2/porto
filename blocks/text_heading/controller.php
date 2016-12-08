<?php
namespace Concrete\Package\Porto\Block\TextHeading;
use
    Page,
    Core,
    \Concrete\Core\Support\Facade\Database,
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
=>  (c) ............... 2005-2015 Johannes Krämer |
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
        $btCacheBlockRecord                       = true,
        $btCacheBlockOutput                       = true,
        $btCacheBlockOutputOnPost                 = true,
        $btCacheBlockOutputForRegisteredUsers     = true;


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
	    $db = Database::getActiveConnection();
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