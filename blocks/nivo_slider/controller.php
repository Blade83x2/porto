<?php
namespace Concrete\Package\Porto\Block\NivoSlider;
use
    \Concrete\Core\Block\BlockController,
    \FileSet,
    \Core,
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
=>  (c) ............... 2005-2015 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
class Controller extends BlockController
{
	protected
	    $btTable                                  = 'PortoPackageNivoSlider',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "680",
	    $btInterfaceHeight                        = "460",
        $btCacheBlockRecord                       = false,
        $btCacheBlockOutput                       = false,
        $btCacheBlockOutputOnPost                 = false,
        $btCacheBlockOutputForRegisteredUsers     = true;

    public function getBlockTypeName()
    {
        return t("Nivo Slider");
    }

    public function getBlockTypeDescription()
    {
        return t("Slider for Images");
    }

    public function getBlockTypeHelp()
    {
        $help = t("Create a Image Slider from a Fileset");
        return $help;
    }


    public function getJavaScriptStrings()
    {
        return array(
          //  'prev_btn' => t('Previus'),
           // 'next_btn' => t('Next'),
        );
        // in javascriptcode alert( ccm_t('prev_btn') );
    }

    public function getSearchableContent()
    {
        return $this->effect;
    }

    public function on_start()
    {

    }

    public function add()
    {
        $this->set('animateSpeed', 500);
        $this->set('animateInterval', 4000);
    }

    public function edit()
    {

    }

    public function view()
    {

    }

    public function save($args)
    {
        $args['filesetid'] = (is_numeric($args['filesetid'])?$args['filesetid']:0);
        $args['effect'] = trim($args['effect']);
        $args['animateSpeed'] = (is_numeric($args['animateSpeed'])?$args['animateSpeed']:500);
        $args['animateInterval'] = (is_numeric($args['animateInterval'])?$args['animateInterval']:1000);
        $args['directionNavArrows'] = (($args['directionNavArrows']==1)?1:0);
        $args['bulseyeArrows'] = (($args['bulseyeArrows']==1)?1:0);
        $args['generateNavThumbs'] = (($args['generateNavThumbs']==1)?1:0);
        $args['pauseOnMouseOver'] = (($args['pauseOnMouseOver']==1)?1:0);
        $args['autoStart'] = (($args['autoStart']==1)?1:0);
        $args['randomStart'] = (($args['randomStart']==1)?1:0);
        parent::save($args);
    }

    public function validate($args)
    {
        $error = Core::make('helper/validation/error');
        if($args['filesetid']<1){
            $error->add(t('No Image FileSet selected!'));
        } else {
            $fileList = new FileList();
            $fileList->filterBySet(FileSet::getByID($args['filesetid']));
            $fileList->filterByType(FileType::T_IMAGE);
            if(count($fileList->get())<1){
                $error->add(t('No Images in FileSet present!'));
            }
        }
        $effectArray = array('none', 'random','sliceDown','sliceDownLeft','sliceUp','sliceUpLeft','sliceUpDown','sliceUpDownLeft','fold','fade','slideInRight','slideInLeft', 'boxRandom','boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse');
        if(!in_array($args['effect'], $effectArray)){
            $error->add(t('Effect fails!'));
        }
        if(($args['animateSpeed'] = (int)$args['animateSpeed'])<500){
            $error->add(t('Animate Speed min is 500ms!'));
        }
        if($args['animateSpeed'] > 3000){
            $error->add(t('Animate Speed max is 3000ms!'));
        }
        if(($args['animateInterval'] = (int)$args['animateInterval'])<2000){
            $error->add(t('Animate Interval min is 2000ms!'));
        }
        if($args['animateInterval']>20000){
            $error->add(t('Animate Interval max is 20000ms!'));
        }
        return $error;
    }

    public function getFileSetID()
    {
        return $this->filesetid;
    }
}
?>
