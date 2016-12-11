<?php
namespace Concrete\Package\Porto\Block\History;
use
    Core,
    File,
    Page,
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
	    $btTable                                  = 'PortoPackageHistory',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "700",
	    $btInterfaceHeight                        = "500",
        $btCacheBlockRecord                       = true,
        $btCacheBlockOutput                       = true,
        $btCacheBlockOutputOnPost                 = true,
        $btCacheBlockOutputForRegisteredUsers     = true;

    public
        $form,
        $al,
        $pageselect,
        $ih;

    protected
        $effect                                   = NULL,
        $divClassContainer                        = 12, # col-md-{$col}  // min 6, max 12
        $redirectToPage                           = NULL, # umleiten auf seite nach klick
        $position                                 = 'left', # position vom bild (left|right)
        $picture                                  = NULL, # ID von Bild
        $year                                     = NULL, # angezeigtes jahr
        $text                                     = ''; # angezeigter Text


    public function getBlockTypeDescription()
    {
        return t("Display a Picture, a Year and Text");
    }

    public function getBlockTypeName()
    {
        return t("History");
    }

    public function getBlockTypeHelp()
    {
        $help = t("Add an Element that includes a Picture and a Text. Optional settings: Loading Effect, Linking to another Page and Year");
        return $help;
    }

    public function getSearchableContent()
    {
        return $this->year.' '.$this->text;
    }

    public function on_start()
    {

    }

    public function view()
    {
        $this->ih = Core::make('helper/image');
        $this->set('ih', $this->ih);
    }

    public function edit()
    {
        $this->pageselect = Core::make('helper/form/page_selector');
        $this->set('pageselect', $this->pageselect);
        $this->set('pageWithSubpages', $this->createFromSubPages);
        $this->al = Core::make('helper/concrete/asset_library');
        $this->set('al', $this->al);
        $this->set('picture', $this->getImageObjFromInt($this->picture));
        $this->form = Core::make('helper/form');
        $this->set('form', $this->form);
    }
    public function add()
    {
        $this->edit();
    }

    public function save($args)
    {
        $single = ($args['createFromSubPages']==0)?true:false;
        #$args['divClassContainer'] = (int)$args['divClassContainer'];
        #$args['position'] = trim($args['position']);
        $args['effect'] = trim($args['effect']);
        $args['redirectToPage'] = ($single)?(int)$args['redirectToPage']:'';
        $args['picture'] = ($single)?(int)$args['picture']:'';
        $args['year'] = ($single)?(int)$args['year']:'';
        $args['text'] = ($single)? trim($args['text']):'';

        $args['createFromSubPages'] = (int)$args['pageWithSubpages'];
        unset($args['pageWithSubpages']);

        parent::save($args);
    }

    public function validate($args)
    {
        $error = Core::make('helper/validation/error');
        /*
        if((int)$args['divClassContainer']<6 || (int)$args['divClassContainer']>12)
        {
            $error->add(t('Error').' '.t('in').' '.t('Container').' '.t('Width').'!');
        }
        if($args['position']!='left' && $args['position']!='right')
        {
            $error->add(t('Error').' '.t('in').' '.t('Position').'!');
        }
        */
        if($args['effect']!='none'
        && $args['effect']!='random'
        && $args['effect']!='fadeIn'
        && $args['effect']!='fadeInUp'
        && $args['effect']!='fadeInDown'
        && $args['effect']!='fadeInLeft'
        && $args['effect']!='fadeInRight'
        && $args['effect']!='fadeInUpBig'
        && $args['effect']!='fadeInDownBig'
        && $args['effect']!='fadeInLeftBig'
        && $args['effect']!='fadeInRightBig'
        && $args['effect']!='bounceIn'
        && $args['effect']!='bounceInUp'
        && $args['effect']!='bounceInDown'
        && $args['effect']!='bounceInLeft'
        && $args['effect']!='bounceInRight'
        && $args['effect']!='rotateIn'
        && $args['effect']!='rotateInUpLeft'
        && $args['effect']!='rotateInDownLeft'
        && $args['effect']!='rotateInUpRight'
        && $args['effect']!='rotateInDownRight'
        && $args['effect']!='flash'
        && $args['effect']!='shake'
        && $args['effect']!='bounce'
        && $args['effect']!='tada'
        && $args['effect']!='swing'
        && $args['effect']!='wobble'
        && $args['effect']!='wiggle') {
            $error->add(t('Error').' '.t('in').' '.t('Loading Effect').'!');
        }

        $single = ($args['createFromSubPages']==0)?true:false;

        if ($args['createFromSubPages']!=0)
        {
            if(!is_object($page=Page::getByID((int)$args['pageWithSubpages'])) || $page->isError())
            {
                $error->add(t('Source Page').' '.t('Error').'!');
            }
        }

        if ($args['redirectToPage']!=0 && $single)
        {
            if(!is_object($page=Page::getByID((int)$args['redirectToPage'])) || $page->isError())
            {
                $error->add(t('Link to Page').' '.t('Error').'!');
            }
        }
        if ($args['picture'] != 0 && $single)
        {
            $file = File::getById((int)$args['picture']);
            if ($file instanceof File)
            {
                if (!in_array(strtolower($file->getExtension()), array('gif', 'jpg', 'jpeg', 'png')))
                {
                    $error->add(t('Picture').' '.t('Error').'!');
                }
            }
            else
            {
                $error->add(t('Picture').' '.t('Error').'!');
            }
        }
        else
        {
            if($single)
                $error->add(t('Picture').' '.t('Error').'!');
        }
        if(!is_numeric($args['year']) && $single && $args['year']!='none')
        {
            $error->add(t('Year').' '.t('Error').'!');
        }
        if($args['year']=='none'){
            $args['year'] = 0;
        }

        if(strlen(trim($args['text']))==0 && $single)
        {
            $error->add(t('Text').' '.t('Error').'!');
        }
        return $error;
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
