<?php
namespace Concrete\Package\Porto\Block\AudioPlayer;
use
    \Concrete\Core\Block\BlockController,
    \FileSet,
    \Core,
    \File,
    \Concrete\Core\File\FileList;
use Concrete\Core\File\Type\Type as FileType;

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
	    $btTable                                  = 'PortoPackageAudioPlayer',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "850",
	    $btInterfaceHeight                        = "615",
        $btCacheBlockRecord                       = true, // Should be safe in most cases, this will lighten the load on your database.
        $btCacheBlockOutput                       = false, // Basically, when this option is set, the block will always load whatever was entered after the last "save". This is also generally safe to use. However, in situations where you are relying on visitor contribution or other dynamic content, the cached output will be wrong.
        $btCacheBlockOutputOnPost                 = true, // This option will cache a block, even when the page it is on is recieving a post request. So you would want this disabled for something that needs input to change, but you can set this to true for something that does not.
        $btCacheBlockOutputForRegisteredUsers     = false; // Unregistered users will never have complicated permissions that might influence what they can or can not see, so some things are cacheable for them, but not registered users. If your block has nothing to do with permissions, this can be true.


    public
        $al = NULL,
        $ih = NULL;

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t("MP3 Player");
    }

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t("Audio Player for MP3 files from Fileset");
    }

    /**
     * @return string
    */
    public function getBlockTypeHelp()
    {
        $help = t("Select a Fileset with MP3 Files included for displaying a MP3 Player with Playlist");
        return $help;
    }

    /**
     * @return array
    */
    public function getJavaScriptStrings()
    {
        return array(
          //  'prev_btn' => t('Previus'),
           // 'next_btn' => t('Next'),
        );
        // in javascriptcode alert( ccm_t('prev_btn') );
    }

    /**
     * @param string $outputContent
    */
    public function registerViewAssets($outputContent = '')
    {
        ## Require our formigoSlider javascript
        #$this->requireAsset('javascript','formigoSlider');
    }

    /**
     * @return string
    */
    public function getSearchableContent()
    {
        return $this->name.' - '.$this->description;
    }

    /**
     * @param void
     * @return void
    */
    public function on_start()
    {
        $this->al = Core::make('helper/concrete/asset_library');
        $this->set('al', $this->al);
        $this->set('picture', $this->getImageObjFromInt($this->picture));
        $this->form = Core::make('helper/form');
        $this->set('form', $this->form);
        $this->ih = Core::make('helper/image');
        $this->set('ih', $this->ih);
    }

    /**
     * @param void
     * @return void
    */
    public function add()
    {
	    $this->set('editor', Core::make('editor'));
    }

    /**
     * @param void
     * @return void
    */
    public function edit()
    {
	    $this->set('editor', Core::make('editor'));
    }

    /**
     * @param void
     * @return void
    */
    public function view()
    {
        $html = Core::make('helper/html');
	    $this->addHeaderItem($html->css(DIR_REL.'/packages/porto/blocks/audio_player/src/amazingaudioplayer.css'));
	    $this->addFooterItem($html->javascript(DIR_REL.'/packages/porto/blocks/audio_player/src/amazingaudioplayer.js?ver=1.0'));
	    $this->addFooterItem($html->javascript(DIR_REL.'/packages/porto/blocks/audio_player/src/initaudioplayer.js'));
    }

    /**
     * @param array $args
    */
    public function save($args)
    {
        $args['filesetid'] = (is_numeric($args['filesetid'])?$args['filesetid']:0);
        $args['picture'] = (is_numeric($args['picture'])?$args['picture']:0);
        $args['name'] = trim($args['name']);
        $args['description'] = trim($args['description']);
        parent::save($args);
    }

    /**
     * @param $args
     * @return bool|\Concrete\Core\Error\Error
    */
    public function validate($args)
    {
        $error = Core::make('helper/validation/error');
        if($args['filesetid']<1)
        {
            $error->add(t('No MP3 FileSet selected!'));
        }
        else
        {
            if(is_object($selectedSet = FileSet::getByID($args['filesetid'])))
            {
                $fileList = new FileList();
                $fileList->filterBySet($selectedSet);
                $fileList->filterByType(FileType::T_AUDIO);
                if(count($fileList->getResults())==0)
                {
                    $error->add(t('MP3 FileSet has no Audio Files!'));
                }
            }
            else
            {
                $error->add(t('MP3 FileSet Error!'));
            }
        }
        $args['name'] = trim($args['name']);
        #if(empty($args['name']))
        #{
        #    $error->add(t('Album Name fail!'));
        #}
        return $error;
    }

    /**
     * @return mixed
    */
    public function getFileSetID()
    {
        return $this->filesetid;
    }

    /**
     * @param $int
     * @return bool|File
    */
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