<?php
namespace Concrete\Package\Porto\Theme\Porto;
use Concrete\Core\Page\Theme\Theme;
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
=>  Filename: page_theme.php
=>  Filetime: 03:08 - 06.01.15
=>  Coder:    $ Blade83
*/
class PageTheme extends Theme
{

    /**
     * Twitters Bootstrap GRID System aktivieren!
     * Wenn in einer Area vor dem $a->display($c);
     * der Befehl $a->enableGridContainer(); ausgeführt wird,
     * kann in der Area ein Bootstrap 3 Grid Layout erstellt werden.
     *
    */
    protected $pThemeGridFrameworkHandle = 'bootstrap3';




    /**
     * Name für das Theme
     *
     * @param void
     * @return string
    */
    public function getThemeName() { return t("Porto Template"); }




    /**
     * Beschreibung für das Theme
     *
     * @param void
     * @return string
    */
    public function getThemeDescription(){ return t("The Porto Bootstrap 3 Template"); }





    /**
     * Standart Designvorlage für Blocktypen.
     * Beim erstellen des Blocks auf der Seite wird diesem direkt eine Desinvorlage zugewiesen.
     *
     * @param void
     * @return array
    */
    public function getThemeDefaultBlockTemplates()
    {
        return array(
            #'autonav'       => 'porto_navigation.php',
            'search'        => 'porto_search',
            'social_links'  => 'porto_social_links',
            'tags'          => 'porto_tags',
            'image'         => 'magnific_pop',
        );
    }




    /**
     * Im Package Controller unter public function on_start(){...} werden alle CSS sowie JavaScript includes registriert.
     * Hier werden diese geladen mit
     * $this->requireAsset('javascript', 'bootstrap/*');
     * oder verboten mit
     * $this->providesAsset('javascript', 'bootstrap/tooltip');
     *
     * @param void
     * @return void
    */
    public function registerAssets()
    {
        # Header
        #$this->requireAsset('core/lightbox');
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('css', 'font-awesome');
        $this->requireAsset('css', 'nivo-slider');
        $this->requireAsset('css', 'nivo-slider-default-theme');
        $this->requireAsset('javascript', 'nivo-slider');
        $this->requireAsset('css', 'bootstrap');
        $this->requireAsset('javascript', 'bootstrap');
        $this->providesAsset('javascript', 'bootstrap/tooltip');
        $this->providesAsset('javascript', 'bootstrap/popover');
        $this->providesAsset('javascript', 'bootstrap/dropdown');
        $this->providesAsset('javascript', 'bootstrap/alert');
        $this->providesAsset('javascript', 'bootstrap/button');
        $this->providesAsset('javascript', 'bootstrap/transition');
        $this->requireAsset('css', 'googlefont');
        $this->requireAsset('css', 'owlcarouseltheme');
        $this->requireAsset('css', 'owlcarousel');
        $this->requireAsset('css', 'magnificpopup');
        $this->requireAsset('css', 'themeelements');
        $this->requireAsset('css', 'themeblog');
        $this->requireAsset('css', 'themeanimate');
        $this->requireAsset('css', 'theme');
        $this->requireAsset('javascript', 'modernizr');
        # Footer
        $this->requireAsset('javascript', 'jqueryappear');
        $this->requireAsset('javascript', 'jqueryeasing');
        $this->requireAsset('javascript', 'jquerycookie');
        $this->requireAsset('javascript', 'common');
        $this->requireAsset('javascript', 'jqueryvalidation');
        $this->requireAsset('javascript', 'jquerystellar');
        $this->requireAsset('javascript', 'jqueryeasypiechart');
        $this->requireAsset('javascript', 'isotope');
        $this->requireAsset('javascript', 'owlcarousel');
        $this->requireAsset('javascript', 'magnificpopup');
       # $this->requireAsset('javascript', 'jqueryvide'); # video backgrounds
        $this->requireAsset('javascript', 'theme');
        $this->requireAsset('javascript', 'themepunchtools');
        $this->requireAsset('javascript', 'themepunchrevolution');
        $this->requireAsset('javascript', 'jqueryflipshow');
        $this->requireAsset('javascript', 'picturefill');
        $this->requireAsset('javascript', 'themeinit');
    }

    /**
     * Bei einem Bildupload werden automatisch neue Bilder mit unterschiedlichen Größen erstellt damit auf kleinen Geräten die passende Bildgröße geladen werden kann
     *
     * @return array
    */
    public function getThemeResponsiveImageMap()
    {
        return array(
            'large'     => '900px',
            'medium'    => '768px',
            'mini'      => '320px',
            'thumbnail' => '165px',
            'small'     => '0'
        );
    }

    /**
     * Diese Klassen werden unter Design & Vorlagen -> Benutzerdefinierte Klasse in die Liste geladen, aber nicht automatisch ausgewählt
     *
     * @return array
     */
    public function getThemeBlockClasses()
    {
         return array(
             'image' => array(
                 #'lightbox2',
                 'img-thumbnail',
                 'img-responsive'
             ),
         );
    }

    /**
     * Diese Klassen werden unter Bereichsdesign bearbeiten -> Benutzerdefinierte Klasse in die Liste geladen, aber nicht automatisch ausgewählt
     *
     * @return array
    */
    public function getThemeAreaClasses()
    {
         return array(
             #'Main' => array('CSS_CLASS')
         );
    }

    /**
     * Block Inhalt bekommt neue Schaltflächen mit unten stehenden CSS Spezifikationen
     *
     * @return array
    */
    public function getThemeEditorClasses()
    {
         return array(
             /*
             array(
                 'title' => t('Orange Button'),
                 'menuClass' => 'rannnnge',
                 'spanClass' => 'btn btn-orange'
             ),
             array(
                 'title' => t('Green Button'),
                 'menuClass' => '',
                 'spanClass' => 'btn btn-green'
             )
             */
         );
    }
}
?>