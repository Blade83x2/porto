<?php
namespace Concrete\Package\Porto;
defined('C5_EXECUTE') or die(_("Access Denied."));
/**       ____  _           _       ___ _____
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
=>  Filename: controller.php
=>  Filetime: 00:08 - 16.12.14
=>  Coder:    $ Blade83
 */

/**
 * @author Johannes Krämer
 * @copyright Copyright (c) 2016, Johannes Krämer
 */
use
    \Log,
    \Core,
    \Package,
    \Job,
    \Config,
    \Concrete\Core\View,
    \Request,
    
    \Concrete\Core\Permission\Key\Key as PermissionKey,
    \PermissionAccess,
    \Concrete\Core\Permission\Access\Entity\GroupEntity,

    \Concrete\Core\Page\Page,
    \Concrete\Core\Page\Type\Type as PageType,
    \Concrete\Core\Page\Template as PageTemplate,
    \Concrete\Core\Page\Theme\Theme as PageTheme,
    \Concrete\Core\Page\Type\PublishTarget\Type\Type as PublishTargetType,
    \Concrete\Core\Page\Single as SinglePage,

    \Concrete\Core\Block\BlockType\BlockType,
    \Concrete\Core\Block\BlockType\Set as BlockTypeSet,

    \Concrete\Core\Attribute\Key\Category as AttributeKeyCategory,
    \Concrete\Core\Attribute\Set as AttributeSet,
    \Concrete\Core\Attribute\Type as AttributeType,
    \Concrete\Core\Attribute\Key\CollectionKey as CollectionAttributeKey,

    \Concrete\Attribute\Select\Option,
    \UserAttributeKey,

    \Concrete\Core\User\User,
    \Concrete\Core\User\UserInfo,
    \Group,
    \GroupSet,

    \Concrete\Core\File\Set\Set as FileSet,
    \Concrete\Core\File\FileList,
    \Concrete\Core\File\Importer as FileImporter,

    \Concrete\Core\Asset\Asset,
    \Concrete\Core\Asset\AssetList;

/**
 * Class Controller
 * @package Concrete\Package\Porto
*/
class Controller extends Package
{

    protected
        $pkgHandle                      = 'porto',
	    $pkgVersion                     = '0.7.16',
        $appVersionRequired             = '5.7.5.2',
        $pkgAutoloaderMapCoreExtensions = false;

    private
        $db                             = NULL,
        $isUpdate                       = false;

    /**
     * @param void
     * @return string
    */
    public function getPackageDescription()
    {
        return t("The Porto Package was built with Bootstrap v3.2.0 for concrete 5.7! It includes 2 Themes, Blocks, Templates and more...");
    }

    /**
     * @param void
     * @return string
    */
    public function getPackageName()
    {
        return t("Porto Package");
    }

    /**
     * @param void
     * @return void
    */
    public function on_start()
    {
        Config::set('concrete.white_label.logo', BASE_URL.'/packages/porto/concrete5_dashboard_icon.png');
        Config::set('concrete.white_label.name', Config::get('concrete.site'));
        Config::set('concrete.email.default.address', 'noreply@' . $_SERVER['SERVER_NAME']);
        Config::set('concrete.email.default.name', Config::get('concrete.site'));
        Config::set('concrete.external.intelligent_search_help', true);
        Config::set('concrete.external.news_overlay', false);
        Config::set('concrete.external.news', false);
        Config::set('concrete.misc.app_version_display_in_header', false);

        ##############################################################################################
        # für Ajax                                                                                   #
        #Route::register('/my/custom/route', '\Concrete\Package\Porto\Elements\Classname::method');   #
        ##############################################################################################

        #use Concrete\Core\Http\ResponseAssetGroup;

        #$r = ResponseAssetGroup::get();
        #$r->requireAsset('javascript', 'underscore');
        #$r->requireAsset('javascript', 'core/events');
        #$r->requireAsset('core/legacy');

        $al = AssetList::getInstance();
        $this->db = \Database::connection();
        $cdn = $this->db->getRow("SELECT load_from_cdn FROM PortoPackage WHERE cID=?", array(1));
        # http://documentation.concrete5.org/developers/appendix/asset-list
        if($cdn['load_from_cdn'])
        {
            $al->register('javascript', 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '1.11.1'), $this);
            $al->register('css', 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '3.2.0'), $this);
            /* keine passende cdn version gefunden */ $al->register('css', 'nivo-slider', 'themes/porto/vendor/nivo-slider/nivo-slider.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1.3'), $this);
            /* keine passende cdn version gefunden */ $al->register('css', 'nivo-slider-default-theme', 'themes/porto/vendor/nivo-slider/default/default.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.2'), $this);
            $al->register('javascript', 'nivo-slider', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.min.js', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '3.2'), $this);
            $al->register('css', 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '4.2.0'), $this);
            $al->register('css', 'googlefont', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '1'), $this);
            $al->register('css', 'owlcarouseltheme', '//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.theme.min.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '1.3.2'), $this);
            $al->register('css', 'owlcarousel', '//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '1.3.2'), $this);
            $al->register('css', 'magnificpopup', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/magnific-popup.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '0.9.9'), $this);
            /* Themespezifisch */ $al->register('css', 'themeelements', 'themes/porto/css/theme-elements.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.3.0'), $this);
            /* Themespezifisch */ $al->register('css', 'themeblog', 'themes/porto/css/theme-blog.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.3.0'), $this);
            /* Themespezifisch */ $al->register('css', 'themeanimate', 'themes/porto/css/theme-animate.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1'), $this);
            /* Themespezifisch */ $al->register('css', 'theme', 'themes/porto/css/theme.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1'), $this);
            /* keine passende cdn version gefunden */ $al->register('javascript', 'modernizr', 'themes/porto/vendor/modernizr/modernizr.js', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '3.2.0'), $this);
            /* keine passende cdn version gefunden */ $al->register('javascript', 'jqueryappear', 'themes/porto/vendor/jquery.appear/jquery.appear.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            /* keine passende cdn version gefunden */ $al->register('javascript', 'jqueryeasing', 'themes/porto/vendor/jquery.easing/jquery.easing.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'jquerycookie', '//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '1.4.1'), $this);
            /* Themespezifisch */ $al->register('javascript', 'common', 'themes/porto/vendor/common/common.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'jqueryvalidation', '//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '1.13.0'), $this);
            $al->register('javascript', 'jquerystellar', '//cdnjs.cloudflare.com/ajax/libs/stellar.js/0.6.2/jquery.stellar.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '0.6.2'), $this);
            $al->register('javascript', 'jqueryeasypiechart', '//cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.4/jquery.easypiechart.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '2.1.4'), $this);
            /* nur 2.0.0 version gefunden */ $al->register('javascript', 'isotope', 'themes/porto/vendor/isotope/jquery.isotope.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '2.0.1'), $this);
            $al->register('javascript', 'owlcarousel', '//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '1.3.2'), $this);
            $al->register('javascript', 'magnificpopup', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '0.9.9'), $this);
            /* keine passende cdn version gefunden */ $al->register('javascript', 'jqueryvide', 'themes/porto/vendor/vide/jquery.vide.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '0.1.2'), $this); # video background
            /* Themespezifisch */ $al->register('javascript', 'theme', 'themes/porto/js/theme.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            /* Themespezifisch */ $al->register('javascript', 'themepunchtools', 'themes/porto/vendor/rs-plugin/js/jquery.themepunch.tools.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1.0'), $this);
            /* Themespezifisch */ $al->register('javascript', 'themepunchrevolution', 'themes/porto/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '4.6.0'), $this);
            /* keine passende cdn version gefunden */ $al->register('javascript', 'jqueryflipshow', 'themes/porto/vendor/circle-flip-slideshow/js/jquery.flipshow.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1.0.0'), $this);
            /* Themespezifisch */ $al->register('javascript', 'themeinit', 'themes/porto/js/theme.init.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'picturefill', 'themes/porto/vendor/picturefill/picturefill.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '2.2.0'), $this);
            #$al->register('javascript', 'lightbox', '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/js/lightbox.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => false, 'version' => '2.8.1'), $this);
            #$al->register('css', 'lightbox', '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/css/lightbox.min.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '2.8.1'), $this);
        }
        else
        {
            $al->register('javascript', 'jquery', 'themes/porto/vendor/jquery/jquery.js', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1.11.1'), $this);
            $al->register('css', 'bootstrap', 'themes/porto/vendor/bootstrap/bootstrap.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.2.0'), $this);
            $al->register('css', 'nivo-slider', 'themes/porto/vendor/nivo-slider/nivo-slider.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1.3'), $this);
            $al->register('css', 'nivo-slider-default-theme', 'themes/porto/vendor/nivo-slider/default/default.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.2'), $this);
            $al->register('javascript', 'nivo-slider', 'themes/porto/vendor/nivo-slider/jquery.nivo.slider.js', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.2'), $this);
            $al->register('css', 'font-awesome', 'themes/porto/vendor/fontawesome/css/font-awesome.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '4.2.0'), $this);
            $al->register('css', 'googlefont', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => false, 'version' => '1'), $this);
            $al->register('css', 'owlcarouseltheme', 'themes/porto/vendor/owlcarousel/owl.theme.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1.3.2'), $this);
            $al->register('css', 'owlcarousel', 'themes/porto/vendor/owlcarousel/owl.carousel.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1.3.2'), $this);
            $al->register('css', 'magnificpopup', 'themes/porto/vendor/magnific-popup/magnific-popup.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '0.9.9'), $this);
            $al->register('css', 'themeelements', 'themes/porto/css/theme-elements.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.3.0'), $this);
            $al->register('css', 'themeblog', 'themes/porto/css/theme-blog.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '3.3.0'), $this);
            $al->register('css', 'themeanimate', 'themes/porto/css/theme-animate.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1'), $this);
            $al->register('css', 'theme', 'themes/porto/css/theme.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'modernizr', 'themes/porto/vendor/modernizr/modernizr.js', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'bootstrap', 'themes/porto/vendor/bootstrap/bootstrap.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '3.2.0'), $this);
            $al->register('javascript', 'jqueryappear', 'themes/porto/vendor/jquery.appear/jquery.appear.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'jqueryeasing', 'themes/porto/vendor/jquery.easing/jquery.easing.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'jquerycookie', 'themes/porto/vendor/jquery-cookie/jquery-cookie.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1.4.1'), $this);
            $al->register('javascript', 'common', 'themes/porto/vendor/common/common.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'jqueryvalidation', 'themes/porto/vendor/jquery.validation/jquery.validation.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1.13.0'), $this);
            $al->register('javascript', 'jquerystellar', 'themes/porto/vendor/jquery.stellar/jquery.stellar.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '0.6.2'), $this);
            $al->register('javascript', 'jqueryeasypiechart', 'themes/porto/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '2.1.4'), $this);
            $al->register('javascript', 'isotope', 'themes/porto/vendor/isotope/jquery.isotope.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '2.0.1'), $this);
            $al->register('javascript', 'owlcarousel', 'themes/porto/vendor/owlcarousel/owl.carousel.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1.3.2'), $this);
            $al->register('javascript', 'magnificpopup', 'themes/porto/vendor/magnific-popup/jquery.magnific-popup.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '0.9.9'), $this);
            $al->register('javascript', 'jqueryvide', 'themes/porto/vendor/vide/jquery.vide.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '0.1.2'), $this);
            $al->register('javascript', 'theme', 'themes/porto/js/theme.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'themepunchtools', 'themes/porto/vendor/rs-plugin/js/jquery.themepunch.tools.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1.0'), $this);
            $al->register('javascript', 'themepunchrevolution', 'themes/porto/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '4.6.0'), $this);
            $al->register('javascript', 'jqueryflipshow', 'themes/porto/vendor/circle-flip-slideshow/js/jquery.flipshow.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1.0.0'), $this);
            $al->register('javascript', 'themeinit', 'themes/porto/js/theme.init.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '1'), $this);
            $al->register('javascript', 'picturefill', 'themes/porto/vendor/picturefill/picturefill.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '2.2.0'), $this);
           # $al->register('javascript', 'lightbox', 'themes/porto/vendor/lightbox/lightbox.min.js', array('position'=>Asset::ASSET_POSITION_FOOTER, 'local' => true, 'version' => '2.8.1'), $this);
           # $al->register('css', 'lightbox', 'themes/porto/vendor/lightbox/lightbox.min.css', array('position'=>Asset::ASSET_POSITION_HEADER, 'local' => true, 'version' => '2.8.1'), $this);
        }
    }

	public function install()
	{
		$pkg = parent::install();
		$this->configure($pkg);
	}

    public function upgrade()
    {
        $this->isUpdate = TRUE;
        $pkg = $this;
        parent::upgrade();
        $this->configure($pkg);
    }

    public function uninstall()
    {
        parent::uninstall();
        $r = \Request::getInstance();
        $this->deletePackageTables("PortoPackage");
        if ($r->request->get('portoUninstallFilesets')) 
	    {
            if (is_object($fileSet=FileSet::getByName('Porto Theme Backgrounds')))
            {
                $this->delFilesAndFileSetIfExists($fileSet);
            }
            if (is_object($fileSet=FileSet::getByName('Porto Theme Logos')))
            {
                $this->delFilesAndFileSetIfExists($fileSet);
            }
            if (is_object($fileSet=FileSet::getByName('Porto System Images')))
            {
                $this->delFilesAndFileSetIfExists($fileSet);
            }
	    }

        # Gruppen von GroupSet lösen
        $this->delUserGroupFromUserGroupSet(
            GroupSet::getByName('Porto UA Set'),
            Group::getByID(ADMIN_GROUP_ID)
        );
        $this->delUserGroupFromUserGroupSet(
            GroupSet::getByName('Porto UA Set'),
            Group::getByName('Porto Admins')
        );

        # Gruppen entfernen
        $this->deleteUserGroupSetIfExists('Porto UA Set');
        $this->deleteUserGroupIfExists('Porto Admins');

        # Datei Erweiterungen löschen
        $this->delAllowedFileExtensionIfExists('apk');
        $this->delAllowedFileExtensionIfExists('ipa');
        $this->delAllowedFileExtensionIfExists('mp3');

        # konfiguration entfernen
        if (is_object($config = \Core::make('config/database')))
        {
            if ($config->has('porto.datamodel'))
            {
                $config->clear('porto.datamodel');
            }
        }
        \Core::make('cache')->flush();
    }

    /**
     * @param $pkg
     * @return void
     */
    protected function configure($pkg)
    {
        $r = \Request::getInstance();
        if ($r->request->get('portoInstallEnableLogForInstallation'))
        {
            Log::addEntry("Controller Init", 'Debug');
        }

        # Datenbank prüfen
        $this->db = \Database::connection();
        if (!$res = $this->db->getRow("SELECT cID FROM PortoPackage WHERE cID=1"))
        {
            //TODO hier könnnen BUGS entstehen!!!! ÄNDERN !
            $ui = UserInfo::getByID(USER_SUPER_ID);
            $sql= "INSERT INTO PortoPackage    (cID, breadcrump_banner_active, breadcrump_banner_text, stickymenu_active, scrolltotop_active, load_from_cdn, load_footerinfotext_from_metadescription, second_stickymenu_gfx, second_stickymenu_gfx_x, second_stickymenu_gfx_y, page_logo_x, page_logo_y, header_type, footer_type, show_login, boxed_design, background_image, background_fix, searchpage_id, searchpage_text, searchpage_empty_query, page_logo, page_logo_mini, footer_copyright,                       footer_ribbon, email)"
                 ."VALUES (                     ?,   ?,                        ?,                      ?,                 ?,                  ?,             ?,                                        ?,                     ?,                       ?,                       ?,           ?,           ?,           ?,           ?,          ?,            ?,                ?,              ?,             ?,               ?,                      ?,         ?,              ?,                                      ?,             ?)";
            $this->db->ExecuteQuery($sql,array (1,   1,                        '',                     0,                 1,                  1,             1,                                        0,                     0,                       0,                       0,           0,           1,           3,           1,          0,            0,                0,              0,             t('Search...'),  '',                     0,         0,              '© Copyright %Y. All Rights Reserved.', '',            (is_object($ui)?$ui->getUserEmail():'')));

        /*
         *
         *
         *             // now we add a pending version to the collectionversions table
            $v2 = array(
                $newCID,
                1,
                $pTemplateID,
                $data['name'],
                $data['handle'],
                $data['cDescription'],
                $cDatePublic,
                $cDate,
                VERSION_INITIAL_COMMENT,
                $data['uID'],
                $cvIsApproved,
                $cvIsNew,
                $pThemeID,
            );
            $q2 = 'insert into CollectionVersions (cID, cvID, pTemplateID, cvName, cvHandle, cvDescription, cvDatePublic, cvDateCreated, cvComments, cvAuthorUID, cvIsApproved, cvIsNew, pThemeID) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $r2 = $db->prepare($q2);
            $res2 = $db->execute($r2, $v2);
         */




        }

        # Datei Erweiterungen hinzufügen
        $this->addAllowedFileExtensionIfNotInList('apk');
        $this->addAllowedFileExtensionIfNotInList('ipa');
        $this->addAllowedFileExtensionIfNotInList('mp3');

        # Sicherheitscode
        if (is_object($config = \Core::make('config/database')))
        {
            if (!$config->has('porto.datamodel'))
            {
                $obj = new \stdClass();
                $obj->security = new \stdClass();
                $obj->security->formToken = $this->generateRandomString(32);
                $config->save('porto.datamodel', serialize($obj));
            }
        }

        # Jobs
        if ($r->request->get('portoInstallCronJobs') || $this->isUpdate = TRUE)
        {
            $this->addCronJobIfNotExists($pkg, 'clear_empty_workflow_progress');
        }

        # PageTheme
	    $this->setThemeIfNotExists('porto', $pkg);
	    $this->setThemeIfNotExists('onepage', $pkg);
	
        # PageTemplate
        $this->setPageTemplateIfNotExists('blank', t('Blank'), $pkg);
        $this->setPageTemplateIfNotExists('full', t('Full'), $pkg);
        $this->setPageTemplateIfNotExists('landing', t('Landing Page'), $pkg);
        $this->setPageTemplateIfNotExists('left_sidebar', t('Left Sidebar'), $pkg);
        $this->setPageTemplateIfNotExists('right_sidebar', t('Right Sidebar'), $pkg);
        $this->setPageTemplateIfNotExists('blog', t('Blog'), $pkg);

        # Pagetypes (z.B. für Composer o.ä.)
        $this->installPageType('blog', t('Blog'), $pkg);

        # Dashboard
        $this->setDashboardIfNotExists('porto_design/', t('Porto Package'), $pkg);
        $this->setDashboardIfNotExists('porto_design/settings', t('Settings'), $pkg);
        $this->setDashboardIfNotExists('porto_design/header_footer', t('Header & Footer Design'), $pkg);
        $this->setDashboardIfNotExists('porto_design/menu_logos', t('Menu & Logos'), $pkg);
        $this->setDashboardIfNotExists('porto_design/informationen', t('Information'), $pkg);

        if ($r->request->get('portoInstallBlocks') || $this->isUpdate = TRUE)
        {
            # BlocktypeSet
            $this->setBlockSetIfNotExists('porto', t('Porto Blocktypes'), $pkg);
            # BlockTypes
            $this->setBlockIfNotExistsOrUpdate('nav_top', $pkg);
            $this->setBlockIfNotExistsOrUpdate('history', $pkg);
            $this->setBlockIfNotExistsOrUpdate('member_listing', $pkg);
            $this->setBlockIfNotExistsOrUpdate('onepage_nav_marker', $pkg);
            $this->setBlockIfNotExistsOrUpdate('text_heading', $pkg);
            $this->setBlockIfNotExistsOrUpdate('calculate_route', $pkg);
            $this->setBlockIfNotExistsOrUpdate('contact_us', $pkg);
            $this->setBlockIfNotExistsOrUpdate('nivo_slider', $pkg);
            $this->setBlockIfNotExistsOrUpdate('pro_contra', $pkg);
            $this->setBlockIfNotExistsOrUpdate('audio_player', $pkg);
        }

        # AttributeSet fuer Collection
        $AttribSetIDCollection = $this->setAttributeSetIfNotExistsAndGet('collection', 'porto_collection_attr', t('Porto Menu'), $pkg);
        # AttributeTypes (collection)
        $this->setCollectionAttributeKeyIfNotExists('porto_navigation_fa_icon', t('Font Awesome Icon'), $AttribSetIDCollection, 'select', array(
            'akSelectValues' => array(
                'angellist','area-chart','at','bell-slash','bell-slash-o','bicycle','binoculars','birthday-cake','bus','calculator','cc','cc-amex',
                'cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','copyright','eyedropper','futbol-o','google-wallet','ils','ioxhost',
                'lastfm','lastfm-square','line-chart','meanpath','newspaper-o','paint-brush','paypal','pie-chart','plug','shekel','sheqel','slideshare',
                'soccer-ball-o','toggle-off','toggle-on','trash','tty','twitch','wifi','yelp','adjust','anchor','archive','area-chart','arrows','arrows-h',
                'arrows-v','asterisk','at','automobile','ban','bank','bar-chart','bar-chart-o','barcode','bars','beer','bell','bell-o','bell-slash',
                'bell-slash-o','bicycle','binoculars','birthday-cake','bolt','bomb','book','bookmark','bookmark-o','briefcase','bug','building',
                'building-o','bullhorn','bullseye','bus','cab','calculator','calendar','calendar-o','camera','camera-retro','car','caret-square-o-down',
                'caret-square-o-left','caret-square-o-right','caret-square-o-up','cc','certificate','check','check-circle','check-circle-o','check-square',
                'check-square-o','child','circle','circle-o','circle-o-notch','circle-thin','clock-o','close','cloud','cloud-download','cloud-upload',
                'code','code-fork','coffee','cog','cogs','comment','comment-o','comments','comments-o','compass','copyright','credit-card','crop',
                'crosshairs','cube','cubes','cutlery','dashboard','database','desktop','dot-circle-o','download','edit','ellipsis-h','ellipsis-v',
                'envelope','envelope-o','envelope-square','eraser','exchange','exclamation','exclamation-circle','exclamation-triangle','external-link',
                'external-link-square','eye','eye-slash','eyedropper','fax','female','fighter-jet','file-archive-o','file-audio-o','file-code-o',
                'file-excel-o','file-image-o','file-movie-o','file-pdf-o','file-photo-o','file-picture-o','file-powerpoint-o','file-sound-o',
                'file-video-o','file-word-o','file-zip-o','film','filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flash',
                'flask','folder','folder-o','folder-open','folder-open-o','frown-o','futbol-o','gamepad','gavel','gear','gears','gift','glass',
                'globe','graduation-cap','group','hdd-o','headphones','heart','heart-o','history','home','image','inbox','info','info-circle',
                'institution','key','keyboard-o','language','laptop','leaf','legal','lemon-o','level-down','level-up','life-bouy','life-buoy',
                'life-ring','life-saver','lightbulb-o','line-chart','location-arrow','lock','magic','magnet','mail-forward','mail-reply','mail-reply-all',
                'male','map-marker','meh-o','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile',
                'mobile-phone','money','moon-o','mortar-board','music','navicon','newspaper-o','paint-brush','paper-plane','paper-plane-o','paw',
                'pencil','pencil-square','pencil-square-o','phone','phone-square','photo','picture-o','pie-chart','plane','plug','plus','plus-circle',
                'plus-square','plus-square-o','power-off','print','puzzle-piece','qrcode','question','question-circle','quote-left','quote-right',
                'random','recycle','refresh','remove','reorder','reply','reply-all','retweet','road','rocket','rss','rss-square','search','search-minus',
                'search-plus','send','send-o','share','share-alt','share-alt-square','share-square','share-square-o','shield','shopping-cart','sign-in',
                'sign-out','signal','sitemap','sliders','smile-o','soccer-ball-o','sort','sort-alpha-asc','sort-alpha-desc','sort-amount-asc',
                'sort-amount-desc','sort-asc','sort-desc','sort-down','sort-numeric-asc','sort-numeric-desc','sort-up','space-shuttle','spinner',
                'spoon','square','square-o','star','star-half','star-half-empty','star-half-full','star-half-o','star-o','suitcase','sun-o','support',
                'tablet','tachometer','tag','tags','tasks','taxi','terminal','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up',
                'ticket','times','times-circle','times-circle-o','tint','toggle-down','toggle-left','toggle-off','toggle-on','toggle-right','toggle-up',
                'trash','trash-o','tree','trophy','truck','tty','umbrella','university','unlock','unlock-alt','unsorted','upload','user','users',
                'video-camera','volume-down','volume-off','volume-up','warning','wheelchair','wifi','wrench','file','file-archive-o','file-audio-o',
                'file-code-o','file-excel-o','file-image-o','file-movie-o','file-o','file-pdf-o','file-photo-o','file-picture-o','file-powerpoint-o',
                'file-sound-o','file-text','file-text-o','file-video-o','file-word-o','file-zip-o','circle-o-notch','cog','gear','refresh','spinner',
                'check-square','check-square-o','circle','circle-o','dot-circle-o','minus-square','minus-square-o','plus-square','plus-square-o',
                'square','square-o','cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','credit-card','google-wallet','paypal',
                'area-chart','bar-chart','bar-chart-o','line-chart','pie-chart','bitcoin','btc','cny','dollar','eur','euro','gbp','ils','inr','jpy',
                'krw','money','rmb','rouble','rub','ruble','rupee','shekel','sheqel','try','turkish-lira','usd','won','yen','align-center','align-justify',
                'align-left','align-right','bold','chain','chain-broken','clipboard','columns','copy','cut','dedent','eraser','file','file-o','file-text',
                'file-text-o','files-o','floppy-o','font','header','indent','italic','link','list','list-alt','list-ol','list-ul','outdent','paperclip',
                'paragraph','paste','repeat','rotate-left','rotate-right','save','scissors','strikethrough','subscript','superscript','table','text-height',
                'text-width','th','th-large','th-list','underline','undo','unlink','angle-double-down','angle-double-left','angle-double-right',
                'angle-double-up','angle-down','angle-left','angle-right','angle-up','arrow-circle-down','arrow-circle-left','arrow-circle-o-down',
                'arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left',
                'arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','caret-down','caret-left','caret-right','caret-square-o-down',
                'caret-square-o-left','caret-square-o-right','caret-square-o-up','caret-up','chevron-circle-down','chevron-circle-left','chevron-circle-right',
                'chevron-circle-up','chevron-down','chevron-left','chevron-right','chevron-up','hand-o-down','hand-o-left','hand-o-right','hand-o-up',
                'long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up','toggle-down','toggle-left','toggle-right','toggle-up','arrows-alt',
                'backward','compress','eject','expand','fast-backward','fast-forward','forward','pause','play','play-circle','play-circle-o','step-backward',
                'step-forward','stop','youtube-play','warning','adn','android','angellist','apple','behance','behance-square','bitbucket','bitbucket-square',
                'bitcoin','btc','cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','codepen','css3','delicious','deviantart','digg',
                'dribbble','dropbox','drupal','empire','facebook','facebook-square','flickr','foursquare','ge','git','git-square','github','github-alt',
                'github-square','gittip','google','google-plus','google-plus-square','google-wallet','hacker-news','html5','instagram','ioxhost','joomla',
                'jsfiddle','lastfm','lastfm-square','linkedin','linkedin-square','linux','maxcdn','meanpath','openid','pagelines','paypal','pied-piper',
                'pied-piper-alt','pinterest','pinterest-square','qq','ra','rebel','reddit','reddit-square','renren','share-alt','share-alt-square','skype',
                'slack','slideshare','soundcloud','spotify','stack-exchange','stack-overflow','steam','steam-square','stumbleupon','stumbleupon-circle',
                'tencent-weibo','trello','tumblr','tumblr-square','twitch','twitter','twitter-square','vimeo-square','vine','vk','wechat','weibo','weixin',
                'windows','wordpress','xing','xing-square','yahoo','yelp','youtube','youtube-play','youtube-square','ambulance','h-square','hospital-o',
                'medkit','plus-square','stethoscope','user-md','wheelchair'
            )
        ), $pkg);
        # Porto Meta Tags
        $MetaTagCollection = $this->setAttributeSetIfNotExistsAndGet('collection', 'porto_meta_tags', t('Porto Meta Tags'), $pkg);
        $this->setCollectionAttributeKeyIfNotExists('porto_meta_tags_revisit_after', t('Revisit after'), $MetaTagCollection, 'select', array(
            'akSelectValues' => array(
                '3 days','5 days','7 days','10 days','14 days','21 days','1 month','2 month','4 month','6 month','9 month'
             )
        ), $pkg);
        $this->setCollectionAttributeKeyIfNotExists('porto_meta_tags_robots', t('Robots'), $MetaTagCollection, 'select', array(
            'akSelectValues' => array(
                'index,follow','index,nofollow','noindex,follow','noindex,nofollow'
             )
        ), $pkg);
        $this->setCollectionAttributeKeyIfNotExists('porto_meta_tags_audience', t('Audience'), $MetaTagCollection, 'text', array(
            'akHandle'              => 'porto_meta_tags_audience',
            'akName'                => t('Audience')
        ), $pkg);
        $this->setCollectionAttributeKeyIfNotExists('porto_meta_tags_page_topic', t('Page Topic'), $MetaTagCollection, 'text', array(
            'akHandle'              => 'porto_meta_tags_page_topic',
            'akName'                => t('Page Topic')
        ), $pkg);

        $this->setCollectionAttributeKeyIfNotExists('porto_megamenu_full_width', t('Megamenu full width'), $AttribSetIDCollection, 'boolean', array(), $pkg);
        $this->setCollectionAttributeKeyIfNotExists('porto_link_show_in_footer', t('Show link in footer'), $AttribSetIDCollection, 'boolean', array(), $pkg);
        $this->setCollectionAttributeKeyIfNotExists('detailimage', t('Detail Image'), $AttribSetIDCollection, 'image_file', array(), $pkg);
        $this->setCollectionAttributeKeyIfNotExists('thumbnail', t('Thumbnail Image'), $AttribSetIDCollection, 'image_file', array(), $pkg);
        # AttributeSet fuer User
        $AttribSetIDUser = $this->setAttributeSetIfNotExistsAndGet('user', 'porto_user_attr', t('Porto User Attribute Set'), $pkg);
        # AttributeTypes (user)
        $this->setUserAttributeKeyIfNotExistsOrUpdate('boolean', $pkg, array(
            'akHandle'              => 'company',
            'akName'                => t('Show profile as Company profile'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => false,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'akCheckedByDefault'    => false,        // Kontrollkästchen standardmäßig aktivieren
            'asID'                  => $AttribSetIDUser // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('text', $pkg, array(
            'akHandle'              => 'firma_name',
            'akName'                => t('Company Name'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,          // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('image_file', $pkg, array(
            'akHandle'              => 'firma_logo',
            'akName'                => t('Company Logo'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('text', $pkg, array(
            'akHandle'              => 'firma_branche',
            'akName'                => t('Company branch'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,          // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('address', $pkg, array(
            'akHandle'              => 'firma_addresse',
            'akName'                => t('Company location'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'akHasCustomCountries'  => 0,             // 1=Bestimmte aus der Liste laden
            'akDefaultCountry'      => 'DE',	      // Default Land
            'asID'                  => $AttribSetIDUser// zugehöriges userattribute set
        ));
        /*$this->setUserAttributeKeyIfNotExistsOrUpdate('social_links', $pkg, array(
            'akHandle'              => 'firma_social_links',
            'akName'                => t('Firmen Links'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
        ));*/
        $this->setUserAttributeKeyIfNotExistsOrUpdate('textarea', $pkg, array(
            'akHandle'              		=> 'firmen_motto',
            'akName'                		=> t('Company motto'),
            'akIsSearchable'        		=> true,        // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' 		=> true,        // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  		=> false,        // In Benutzerliste anzeigen
            'uakProfileDisplay'     		=> true,        // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        		=> true,        // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'		=> false,       // Pflichtfeld und bearbeitbar im Profil
            'uakRegisterEdit'       		=> false,       // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'		=> false,       // Pflichtfeld im Registrierungsformular
            'akTextareaDisplayMode' 		=> 'rich_text',	// (text|rich_text|rich_text_custom)
            'akTextareaDisplayModeCustomOptions'=> '',   	// Optionen wenn rich_text_custom rewaehlt wird
            'asID'                  		=> $AttribSetIDUser // zugehöriges userattribute set
        ));

        $this->setUserAttributeKeyIfNotExistsOrUpdate('select', $pkg, array(
            'akHandle'              => 'gender',
            'akSelectValues'        => array(
                t('male'),
                t('female')
            ),
            'akName'                => t('Gender'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'akSelectAllowOtherValues'  => false,     // Benutzern erlauben, eintraege hinzuzufuegen
            'akSelectAllowMultipleValues'=> false,    // Mehrfachselektion erlauben
            'asID'                  => $AttribSetIDUser  // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('text', $pkg, array(
            'akHandle'              => 'firstname',
            'akName'                => t('Firstname'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,          // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('text', $pkg, array(
            'akHandle'              => 'lastname',
            'akName'                => t('Lastname'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,          // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('address', $pkg, array(
            'akHandle'              => 'adresse',
            'akName'                => t('Location'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'akHasCustomCountries'  => 0,             // 1=Bestimmte aus der Liste laden
            'akDefaultCountry'      => 'DE',	      // Default Land
            'asID'                  => $AttribSetIDUser// zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('image_file', $pkg, array(
            'akHandle'              => 'selfi',
            'akName'                => t('Picture'),
            'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('social_links', $pkg, array(
            'akHandle'              => 'social_links',
            'akName'                => t('Social Links'),
            'akIsSearchable'        => false,          // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' => false,          // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
            'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
            'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
            'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
        ));
        $this->setUserAttributeKeyIfNotExistsOrUpdate('textarea', $pkg, array(
            'akHandle'              		=> 'zitat',
            'akName'                		=> t('Blockquote'),
            'akIsSearchable'        		=> true,        // Feld verfügbar in der Benutzersuche der Verwaltung
            'akIsSearchableIndexed' 		=> true,        // Inhalt in die Benutzersuche aufnehmen
            'uakMemberListDisplay'  		=> false,        // In Benutzerliste anzeigen
            'uakProfileDisplay'     		=> true,        // Im öffentlichen Profil sichtbar
            'uakProfileEdit'        		=> true,        // Kann im Profil bearbeitet werden
            'uakProfileEditRequired'		=> false,       // Pflichtfeld und bearbeitbar im Profil
            'uakRegisterEdit'       		=> false,       // Im Registrierungsformular anzeigen.
            'uakRegisterEditRequired'		=> false,       // Pflichtfeld im Registrierungsformular
            'akTextareaDisplayMode' 		=> 'rich_text',	// (text|rich_text|rich_text_custom)
            'akTextareaDisplayModeCustomOptions'=> '',   	// Optionen wenn rich_text_custom rewaehlt wird
            'asID'                  		=> $AttribSetIDUser // zugehöriges userattribute set
        ));

        # FileSets
        if (($fileSet=$this->addFileSetIfNotExistsAndGet('Porto Theme Backgrounds', 'public')) instanceof FileSet)
        {
           $this->importFilesToFileSet($fileSet, 'import/porto_package/Backgrounds');
        }
        if (($fileSet=$this->addFileSetIfNotExistsAndGet('Porto Theme Logos', 'public')) instanceof FileSet)
        {
           $this->importFilesToFileSet($fileSet, 'import/porto_package/Logos');
        }
        if (($fileSet=$this->addFileSetIfNotExistsAndGet('Porto System Images', 'public')) instanceof FileSet)
        {
            $this->importFilesToFileSet($fileSet, 'import/porto_package/Systemimages');
        }
        # UserGroupSet & UserGroups
        $user_group_set = $this->createUserGroupSetIfNotExistsAndGetSet('Porto UA Set', $pkg);
        $user_group = $this->createUserGroupIfNotExistsAndGet('Porto Admins', t('Can change settings for the Porto Package'), $pkg);
        $this->addUserGroupToUserGroupSet($user_group_set, $user_group);
        $this->addUserGroupToUserGroupSet($user_group_set, Group::getByName('Administrators'));
        # User + evt. SuperAdmin zur Porto-Admin Gruppe hinzufügen
        $installerAcc = new User();
        if (!$installerAcc->inGroup($user_group))
        {
            $installerAcc->enterGroup($user_group);
        }
        # su in gruppe adden
        if (is_object($superUser = User::getByUserID(1)))
        {
            if ($superUser->getUserID() != $installerAcc->getUserID())
            {
                if (!$superUser->inGroup($user_group))
                {
                    $superUser->enterGroup($user_group);
                }
            }
        }
        unset($installerAcc, $user_group, $user_group_set, $superUser);
        # Berechtigungen setzen
        $this->addTaskPermissionsIfNotExists(
            'porto_dashboard',
            t('Porto Dashboard'),
            t('Can change settings for the Porto Package'),
            'Porto Admins',
            $pkg
        );

        # Thumbnail Types für Responsive Kompatiblität anlegen
        $this->addThumbnailTypeIfNotExists('small','Small', 740);
        $this->addThumbnailTypeIfNotExists('mini','Mini', 320);
        $this->addThumbnailTypeIfNotExists('medium','Medium', 940);
        $this->addThumbnailTypeIfNotExists('large','Large', 1140);

        \Core::make('cache')->flush();
    }


    ############################################
    #####                                   ####
    #####              LIBRARY              ####
    #####                                   ####
    ############################################

    /**--------------------------------------------------------------
     *
     * Löschen der Porto Tabellen
     *
     * @return void
     * @param $tableName string
     *
     * --------------------------------------------------------------
    */
    protected function deletePackageTables($tableName)
    {

        $db = \Database::connection();
        $tables = $db->executeQuery("SHOW TABLES LIKE '%".$tableName."%'");
        $allTables = array();
        foreach($tables as $key => $val)
        {
            $array = array_values($val);
            $allTables[] = $array[0];
        }
        for($i=0; $i<count($allTables); $i++)
        {
            $db->executeQuery("DROP TABLE IF EXISTS ".trim($allTables[$i]));
        }
        $db->executeQuery("DELETE FROM Config WHERE configGroup=?", array('porto'));
    }



    /**--------------------------------------------------------------
     *
     * Legt ein Blockset Set an
     *
     * @return void
     * @param $handle string
     * @param $name string
     * @param $pkg object Concrete\Package\Porto
     *
     * --------------------------------------------------------------
    */
    protected function setBlockSetIfNotExists($handle, $name, $pkg)
    {
        if (!BlockTypeSet::getByHandle($handle))
        {
            BlockTypeSet::add($handle, $name, $pkg);
        }
    }



    /**--------------------------------------------------------------
     *
     * Legt ein Block vom Package an
     *
     * @return void
     * @param $handle string Handle von Blocktype
     * @param $pkg object Concrete\Package\Porto
     *
     * --------------------------------------------------------------
    */
    protected function setBlockIfNotExistsOrUpdate($handle, $pkg)
    {
        $bt = BlockType::getByHandle($handle);
        if (!is_object($bt))
        {
            $bt = BlockType::installBlockType($handle, $pkg);
        }
        else
        {
            $bt->refresh();
        }
    }



    /**--------------------------------------------------------------
     *
     * Legt das Theme an.
     * Neue PageTypes werden dem Theme automatisch zugewiesen.
     *
     * @return void
     * @param $themeName string
     * @param $pkg object Concrete\Package\Porto
     *
     * --------------------------------------------------------------
    */
    protected function setThemeIfNotExists($themeName, $pkg)
    {
        if(!(PageTheme::getByHandle($themeName)))
        {
            PageTheme::add($themeName, $pkg);
        }
    }


    /**--------------------------------------------------------------
     *
     * Legt SeitenVorlagen mit Icons fest
     *
     * @return void
     * @param $handle string
     * @param $name string
     * @param $pkg object Concrete\Package\Porto
     *
     * --------------------------------------------------------------
    */
    protected function setPageTemplateIfNotExists($handle, $name, $pkg)
    {
        if (!PageTemplate::getByHandle($handle))
        {
            $pTemplateIcon = $handle . '.png';
            if (!file_exists(DIR_FILES_PAGE_TEMPLATE_ICONS . '/' . $pTemplateIcon))
            {
                $pTemplateIcon = FILENAME_PAGE_TEMPLATE_DEFAULT_ICON;
            }
            PageTemplate::add($handle, $name, $pTemplateIcon, $pkg);
        }
    }



    /**--------------------------------------------------------------
     *
     * Fügt den Seitentyp hinzu und gibt ihn für
     * jedes SeitenTemplate frei.
     *
     * @return void
     * @param $handle string
     * @param $name string
     * @param $pkg object Concrete\Package\Porto
     *
     * --------------------------------------------------------------
    */
    protected function installPageType($handle, $name, $pkg)
    {
        if (PageTemplate::getByHandle($handle) && !PageType::getByHandle($handle))
        {
            $pageType = PageType::add(
                array(
                    'handle'                => $handle,
                    'name'                  => $name,
                    'defaultTemplate'       => PageTemplate::getByHandle($handle),
                    'ptIsFrequentlyAdded'   => 1,
                    'ptLaunchInComposer'    => 0
                ),
                $pkg
            );
            $target = PublishTargetType::getByHandle('all');
            $targetConfig = $target->configurePageTypePublishTarget(
                $pageType,
                array(
                    'ptID' => $pageType->getPageTypeID()
                )
            );
            $pageType->setConfiguredPageTypePublishTargetObject($targetConfig);
        }
    }



    /** --------------------------------------------------------------
     *
     * Legt das Dashboard-Menü im Administrationsmenü an
     *
     * @param $pagePath string
     * @param $displayName string
     * @param $pkg object Concrete\Package\Porto
     * @return void
     *
     * --------------------------------------------------------------
    */
    protected function setDashboardIfNotExists($pagePath, $displayName, $pkg)
    {
        $p = Page::getByPath('/dashboard/'.$pagePath);
        if ($p->isError() || (!is_object($p)))
        {
            $p = SinglePage::add('/dashboard/'.$pagePath, $pkg);
        }
        $p->updateCollectionName($displayName);
    }



    /** --------------------------------------------------------------
     *
     * Erstellt ein neues FileSet
     *
     * @return FileSet
     * @param $name string
     * @param $public_private_starred string (public|private|starred)
     *
     * --------------------------------------------------------------
    */
    protected function addFileSetIfNotExistsAndGet($name, $public_private_starred='public')
    {
        switch($public_private_starred)
        {
            case 'public':      $public_private_starred=FileSet::TYPE_PUBLIC;       break;
            case 'private':     $public_private_starred=FileSet::TYPE_PRIVATE;      break;
            case 'starred':     $public_private_starred=FileSet::TYPE_STARRED;      break;
            default:            $public_private_starred=FileSet::TYPE_PUBLIC;       break;
        }
        if(!is_object($fileSet=FileSet::getByName($name)))
        {
            $fileSet = FileSet::createAndGetSet($name, $public_private_starred);
        }
        return $fileSet;
    }


    /** --------------------------------------------------------------
     *
     * Importiert Daten aus dem Packageordner in ein Fileset
     * Dabei wird geprueft ob die Datei noch nicht vorhanden ist
     *
     * @return bool
     * @param $fileSet FileSet
     * @param $packageFolder string
     *
     * --------------------------------------------------------------
    */
    protected function importFilesToFileSet($fileSet, $packageFolder)
    {
        $add = array();
        if ($fileSet instanceof FileSet)
        {
            $storedFiles = array();
            if (is_object($fileList = new FileList()))
            {
                $fileList->filterBySet($fileSet);
                $list = $fileList->getResults();
                if (count($list)>0)
                {
                    foreach($list as $f)
                    {
                        $storedFiles[] = $f->getFilename();
                    }
                }
            }
            if (substr($packageFolder, strlen($packageFolder)-1) != "/")
            {
                $packageFolder = $packageFolder.'/';
            }
            if (substr($packageFolder, 0, 1) == "/")
            {
                $packageFolder = substr($packageFolder, 1);
            }
            if (is_dir($this->getPackagePath().'/'.$packageFolder))
            {
                if ($handle = opendir($this->getPackagePath().'/'.$packageFolder))
                {
                    while($file = readdir($handle))
                    {
                        if ($file != "." && $file != "..")
                        {
                            if(!is_dir($this->getPackagePath().'/'.$packageFolder.$file))
                            {
                                if (is_file($this->getPackagePath().'/'.$packageFolder.$file))
                                {
                                    if(!in_array($file, $storedFiles))
                                    {
                                        $add[] = $file;
                                        $importFile = new FileImporter();
                                        if (is_object($newFile=$importFile->import($this->getPackagePath().'/'.$packageFolder.$file)))
                                        {
                                            if (method_exists($newFile, 'getFileID') && $newFile->getFileID() > 0)
                                            {
                                                $fileSet->addFileToSet($newFile->getFileID());
                                            }
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $this->importFilesToFileSet($fileSet, $packageFolder.$file);
                            }
                        }
                    }
                    closedir($handle);
                    return true;
                }
            }
        }
        return false;
    }


    /**--------------------------------------------------------------
     *
     * Löscht ein FileSet mit denn darin enthaltenen Daten
     *
     * @param $fileSet FileSet
     * @return bool
     *
     * --------------------------------------------------------------
    */
    protected function delFilesAndFileSetIfExists($fileSet)
    {
        if ($fileSet instanceof FileSet)
        {
            $fileList = new FileList();
            $fileList->filterBySet($fileSet);
            $files = $fileList->getResults();
            foreach ($files as $file)
            {
                $file->delete();
            }
            $fileSet->delete();
            return true;
        }
        return false;
    }


    /** --------------------------------------------------------------
     *
     * Fügt neue Datei-Erweiterungen zu denn erlaubten hinzu falls noch nicht vorhanden.
     *
     * @param $extension string Dateierweiterung
     * @return void
     *
     * --------------------------------------------------------------
    */
    protected function addAllowedFileExtensionIfNotInList($extension)
    {
        $helper_file = Core::make('helper/concrete/file');
        $file_types = $helper_file->unserializeUploadFileExtensions(
            Config::get('concrete.upload.extensions')
        );
        if (!in_array($extension, $file_types))
        {
            array_push($file_types, $extension);
            Config::save('concrete.upload.extensions', $helper_file->serializeUploadFileExtensions($file_types));
        }
    }
    
    
    /** --------------------------------------------------------------
     *
     * Löscht eine Datei-Erweiterung von denn erlaubten falls vorhanden
     *
     * @param $extension string Dateierweiterung
     * @return void
     *
     * --------------------------------------------------------------
    */
    protected function delAllowedFileExtensionIfExists($extension)
    {
        $helper_file = Core::make('helper/concrete/file');
        $file_types = $helper_file->unserializeUploadFileExtensions(
            Config::get('concrete.upload.extensions')
        );
        if (in_array($extension, $file_types))
        {
            while (($key = array_search($extension, $file_types)) !== NULL)
            {
                unset($file_types[$key]);
                break;
            }
            Config::save('concrete.upload.extensions', $helper_file->serializeUploadFileExtensions($file_types));
        }
    }


    /**--------------------------------------------------------------
     *
     * Berechtigungskey erstellen
     *
     * @param $permissionKeyHandle string
     * @param $permissionKeyName string
     * @param $permissionKeyDescription string
     * @param $accessToGroupName string
     * @param $pkg object Concrete\Package\Porto
     * @return void
     *
     * --------------------------------------------------------------
     */
    protected function addTaskPermissionsIfNotExists($permissionKeyHandle, $permissionKeyName, $permissionKeyDescription, $accessToGroupName, $pkg)
    {
        if (!is_object(PermissionKey::getByHandle($permissionKeyHandle)))
        {
            $permissionKeyObj = PermissionKey::add($pkCategoryHandle='admin', $permissionKeyHandle, $permissionKeyName, $permissionKeyDescription, $pkCanTriggerWorkflow='', $pkHasCustomClass='', $pkg);
            if (is_object($group = Group::getByID(ADMIN_GROUP_ID)))
            {
                $adminGroupEntity = GroupEntity::getOrCreate($group);
                $pa = PermissionAccess::create($permissionKeyObj);
                $pa->addListItem($adminGroupEntity);
                $pt = $permissionKeyObj->getPermissionAssignmentObject();
                $pt->assignPermissionAccess($pa);
            }
            if (is_object($group = Group::getByName($accessToGroupName)))
            {
                $adminGroupEntity = GroupEntity::getOrCreate($group);
                $pa = PermissionAccess::create($permissionKeyObj);
                $pa->addListItem($adminGroupEntity);
                $pt = $permissionKeyObj->getPermissionAssignmentObject();
                $pt->assignPermissionAccess($pa);
            }
        }
        # check the permission
        #$pk = PermissionKey::getByHandle('porto_dashboard');
        #if ($pk->can()) {
        #    echo t('Yes');
        #} else {
        #    echo t('We are sorry but you have no permissions');
        #}
    }





    /** --------------------------------------------------------------
     *
     * Erstellt eine Benutzergruppe
     *
     * @param $name string
     * @param $description string
     * @param $pkg object Concrete\Package\Porto
     * @return object Group
     *
     * --------------------------------------------------------------
    */
    protected function createUserGroupIfNotExistsAndGet($name, $description, $pkg)
    {
        if (!is_object($group = Group::getByName($name)))
        {
	    $group = Group::add($name, $description, false, $pkg);
        }
        return $group;
    }



    /** --------------------------------------------------------------
     *
     * Löscht eine Benutzergruppe
     *
     * @param $name string
     * @return bool
     *
     * --------------------------------------------------------------
    */
    protected function deleteUserGroupIfExists($name)
    {
        if ($group = Group::getByName($name))
        {
            $group->delete();
            return true;
        }
        return false;
    }




    /** --------------------------------------------------------------
     *
     * Fügt eine UserGruppe zu einem GruppenSet hinzu
     *
     * @param $groupSet object
     * @param $group object
     * @return bool
     *
     * --------------------------------------------------------------
    */
    protected function addUserGroupToUserGroupSet($groupSet, $group)
    {
        if (($groupSet instanceof GroupSet) && ($group instanceof Group))
        {
            $groupSet->addGroup($group);
            return true;
        }
        return false;
    }




    /** --------------------------------------------------------------
     *
     * Löscht eine UserGruppe aus einem GruppenSet
     *
     * @param $groupSet object
     * @param $group object
     * @return bool
     *
     * --------------------------------------------------------------
    */
    protected function delUserGroupFromUserGroupSet($groupSet, $group)
    {
        if (($groupSet instanceof GroupSet) && ($group instanceof Group))
        {
            $groupSet->removeGroup($group);
            return true;
        }
        return false;
    }




    /**--------------------------------------------------------------
     *
     * Erstellt ein UserGroupSet
     *
     * @param $name string
     * @param $pkg object Concrete\Package\Porto
     * @return object 
     *
     * --------------------------------------------------------------
    */
    protected function createUserGroupSetIfNotExistsAndGetSet($name, $pkg)
    {
        if(!is_object($set = GroupSet::getByName($name)))
        {
            $set = GroupSet::add($name, $pkg);

        }
        return $set;
    }




    /**--------------------------------------------------------------
     *
     * Löscht ein UserGroupSet
     *
     * @param $name string
     * @return bool
     *
     * --------------------------------------------------------------
    */
    protected function deleteUserGroupSetIfExists($name)
    {
        if(is_object($set = GroupSet::getByName($name)))
        {
            $set->delete();
            return true;
        }
        return false;
    }




    /**--------------------------------------------------------------
     *
     * Legt ein Attribute Set an
     *
     * @return int
     * @param $category string
     * @param $handle string
     * @param $name string
     * @param $pkg object Concrete\Package\Porto
     *
     * --------------------------------------------------------------
    */
    protected function setAttributeSetIfNotExistsAndGet($category, $handle, $name, $pkg)
    {
        $attrib_set = AttributeKeyCategory::getByHandle($category);
        $attrib_set->setAllowAttributeSets(AttributeKeyCategory::ASET_ALLOW_SINGLE);
        if(!is_object($set = AttributeSet::getByHandle($handle)))
        {
            $set = $attrib_set->addSet($handle, $name, $pkg, 0);
        }
        return $set->asID;
    }



    /**--------------------------------------------------------------
     *
     * Legt ein Collection Attribute Key an
     *
     * @param $akHandle string
     * @param $akName string
     * @param $akAttribSetID int
     * @param $akType string (text|textarea|boolean|date_time|image_file|number|rating|select|address|topics|social_links)
     * @param $akArray array
     * @param $pkg object Concrete\Package\Porto
     * @return void
     *
     * --------------------------------------------------------------
    */
    protected function setCollectionAttributeKeyIfNotExists($akHandle, $akName, $akAttribSetID=0, $akType, $akArray=array(), $pkg)
    {
        $akTypeName = $akType;
        if (is_object($akType=AttributeType::getByHandle($akType)))
        {
            if(!is_object($cak=CollectionAttributeKey::getByHandle($akHandle)))
            {
                $array = array_merge(
                    array(
                        'akHandle'  => $akHandle,
                        'akName'    => $akName,
                        'asID'      => $akAttribSetID
                    ),
                    $akArray
                );
                $cak = CollectionAttributeKey::add(
                    $akType,
                    $array,
                    $pkg
                );
            }
            switch ($akTypeName)
            {
                case 'select':
                    if (is_array($array['akSelectValues']) && count($array['akSelectValues'])>0)
                    {
                        foreach ($array['akSelectValues'] as $option)
                        {
                            Option::add($cak, $option, 0, 0);
                        }
                    }
                    break;
            }
        }
    }


    /**--------------------------------------------------------------
     *
     * Erstellt ein User Attribute
     *
     * @param $type string (text|textarea|number|boolean|image_file|select|date_time|rating|address|social_links|topics)
     * @param $pkg object Concrete\Package\Porto
     * @param $array array
     * @return object UserAttributeKey
     *
     * --------------------------------------------------------------
    */
    protected function setUserAttributeKeyIfNotExistsOrUpdate($type, $pkg, $array)
    {
        /*
        ==> $AttribSetIDUser = $this->setAttributeSetIfNotExistsAndGet('user', 'porto_user_attr', t('Porto User Attribute Set'), $pkg);
        */

        $attrType = AttributeType::getByHandle($type);
        if(!is_object($attr = UserAttributeKey::getByHandle($array['akHandle'])))
        {
            switch ($type)
            {
                /* $this->setUserAttributeKeyIfNotExistsOrUpdate('text', $pkg, array(
                    'akHandle'              => 'firstname',
                    'akName'                => t('Firstname'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,          // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
                ));*/
                case 'text':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired' 	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired' 	=> (($array['uakRegisterEditRequired'])?true:false),
                            'asID' 			            => $array['asID']>0?$array['asID']:false
                        ),
                        $pkg
                    );
                    break;
                    
                /*$this->setUserAttributeKeyIfNotExistsOrUpdate('textarea', $pkg, array(
                    'akHandle'              		=> 'zitat',
                    'akName'                		=> t('Blockquote'),
                    'akIsSearchable'        		=> true,        // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' 		=> true,        // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  		=> false,        // In Benutzerliste anzeigen
                    'uakProfileDisplay'     		=> true,        // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        		=> true,        // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'		=> true,        // Pflichtfeld und bearbeitbar im Profil
                    'uakRegisterEdit'       		=> true,        // Im Registrierungsformular anzeigen.
                    'akTextareaDisplayMode' 		=> 'text',	// (text|)
                    'akTextareaDisplayModeCustomOptions'=> '',   	// ??
                    'asID'                  		=> $AttribSetIDUser // zugehöriges userattribute set
                ));*/
                case 'textarea':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 					            => $array['akHandle'],
                            'akName' 					            => $array['akName'],
                            'akIsSearchable' 				        => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'			        => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 			        => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  			    => (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 				        => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 				        => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'			    => (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'			    => (($array['uakRegisterEditRequired'])?true:false),
                            'akTextareaDisplayMode'			        => $array['akTextareaDisplayMode'],
                            'akTextareaDisplayModeCustomOptions'	=> $array['akTextareaDisplayModeCustomOptions'],
                            'asID'					                => $array['asID']>0?$array['asID']:false
                         ),
                         $pkg
		            );
                    break;
                    
                /*$this->setUserAttributeKeyIfNotExistsOrUpdate('number', $pkg, array(
                    'akHandle'              => 'plz',
                    'akName'                => t('Postleitzahl'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,          // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
                ));*/
                case 'number':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
                    );
                    break;

                /*$this->setUserAttributeKeyIfNotExistsOrUpdate('boolean', $pkg, array(
                    'akHandle'              => 'get_messages',
                    'akName'                => t('Checkboxname'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'akCheckedByDefault'    => false,         // Kontrollkästchen standardmäßig aktivieren
                    'asID'                  => $AttribSetIDUser // zugehöriges userattribute set
                ));*/
                case 'boolean';
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'akCheckedByDefault' 	    => (($array['akCheckedByDefault'])?true:false),
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
                    );
                    break;

                /*$this->setUserAttributeKeyIfNotExistsOrUpdate('image_file', $pkg, array(
                    'akHandle'              => 'image',
                    'akName'                => t('Bildchen'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'asID'                  => $AttribSetIDUser // zugehöriges userattribute set
                ));*/
                case 'image_file':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 				    => $array['akHandle'],
                            'akName' 				    => $array['akName'],
                            'akIsSearchable' 			=> (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'		=> (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 		=> (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'      => (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 			=> (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 			=> (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'asID'				        => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
		            );
                    break;
		
                /*$this->setUserAttributeKeyIfNotExistsOrUpdate('select', $pkg, array(
                    'akHandle'              => 'company',
                    'akSelectValues'        => array(
                    t('Privatperson'),
                    t('Company')
                    ),
                    'akName'                	=> t('Privatperson / Firma'),
                    'akIsSearchable'        	=> true,
                    'akIsSearchableIndexed' 	=> true,
                    'uakMemberListDisplay'  	=> false,
                    'uakProfileEdit' 	    	=> true,
                    'uakRegisterEdit' 	    	=> false,
                    'uakProfileEditRequired'	=> false,
                    'uakRegisterEditRequired'	=> false,
                    'asID'                  	=> $AttribSetIDUser
                ));*/
                case 'select':
                    $select = UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'      => (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'    => (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
		            );
                    if (is_array($array['akSelectValues']) && count($array['akSelectValues']) > 0)
                    {
                        foreach ($array['akSelectValues'] as $option)
                        {
                            Option::add($select, $option, 0, 0);
                        }
                    }
                    return $select;
                    break;

                /* $this->setUserAttributeKeyIfNotExistsOrUpdate('date_time', $pkg, array(
                    'akHandle'              => 'birthday',
                    'akName'                => t('Geburtstag'),
                    'akDateDisplayMode'     => 'date_time',   // Anzeigeart (date_time|date|text)
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => true,          // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
                ));*/
                case 'date_time':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'akDateDisplayMode' 	    => $array['akDateDisplayMode'],
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
                    );
		            break;
		    
                /* $this->setUserAttributeKeyIfNotExistsOrUpdate('rating', $pkg, array(
                    'akHandle'              => 'rating',
                    'akName'                => t('Rating'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
                ));*/
		        case 'rating':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
                    );
                    break;

                /* $this->setUserAttributeKeyIfNotExistsOrUpdate('address', $pkg, array(
                    'akHandle'              => 'address',
                    'akName'                => t('address'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'akHasCustomCountries'  => 0,             // 1=Bestimmte aus der Liste laden
                    'akDefaultCountry'      => 'DE',		// Default Land
                    'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
                ));*/
		        case 'address':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'akHasCustomCountries'	    => (($array['akHasCustomCountries'])?1:0),
                            'akDefaultCountry'		    => $array['akDefaultCountry'],
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
                    );
		            break;
		    
                /* $this->setUserAttributeKeyIfNotExistsOrUpdate('social_links', $pkg, array(
                    'akHandle'              => 'social_links',
                    'akName'                => t('Social Links'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
                ));*/
		        case 'social_links':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
                    );
                    break;

                /* $this->setUserAttributeKeyIfNotExistsOrUpdate('topics', $pkg, array(
                    'akHandle'              => 'topics',
                    'akName'                => t('Topics'),
                    'akIsSearchable'        => true,          // Feld verfügbar in der Benutzersuche der Verwaltung
                    'akIsSearchableIndexed' => true,          // Inhalt in die Benutzersuche aufnehmen
                    'uakMemberListDisplay'  => false,         // In Benutzerliste anzeigen
                    'uakProfileDisplay'     => true,          // Im öffentlichen Profil sichtbar
                    'uakProfileEdit'        => true,          // Kann im Profil bearbeitet werden
                    'uakProfileEditRequired'=> false,         // Pflichtfeld im Profil
                    'uakRegisterEdit'       => false,         // Im Registrierungsformular anzeigen.
                    'uakRegisterEditRequired'=> false,        // Pflichtfeld im Registrierungsformular
                    'akTopicParentNodeID'   => 0,
                    'akTopicTreeID'	        => 0,
                    'asID'                  => $AttribSetIDUser   // zugehöriges userattribute set
                ));*/
		        case 'topics':
                    return UserAttributeKey::add(
                        $attrType,
                        array(
                            'akHandle' 			        => $array['akHandle'],
                            'akName' 			        => $array['akName'],
                            'akIsSearchable' 		    => (($array['akIsSearchable'])?true:false),
                            'akIsSearchableIndexed'	    => (($array['akIsSearchableIndexed'])?true:false),
                            'uakProfileDisplay' 	    => (($array['uakProfileDisplay'])?true:false),
                            'uakMemberListDisplay'  	=> (($array['uakMemberListDisplay'])?true:false),
                            'uakProfileEdit' 		    => (($array['uakProfileEdit'])?true:false),
                            'uakRegisterEdit' 		    => (($array['uakRegisterEdit'])?true:false),
                            'uakProfileEditRequired'	=> (($array['uakProfileEditRequired'])?true:false),
                            'uakRegisterEditRequired'	=> (($array['uakRegisterEditRequired'])?true:false),
                            'akTopicParentNodeID'       => $array['akTopicParentNodeID'],
                            'akTopicTreeID'	            => $array['akTopicTreeID'],
                            'asID'			            => (($array['asID']>0)?$array['asID']:false)
                        ),
                        $pkg
                    );
                    break;
            }
        }
        else
        {
            $attr->update($array);
            return $attr;
        }
    }

    /**--------------------------------------------------------------
     *
     * Löscht ein User Attribute Key
     *
     * @param string $handle
     * @return bool
     *
     * --------------------------------------------------------------
    */
    protected function deleteUserAttributeKey($handle)
    {
        if(is_object($attr = UserAttributeKey::getByHandle($handle)))
        {
            $attr->delete();
            return true;
        }
        return false;
    }





    /** --------------------------------------------------------------
     *
     * Legt einen Thumbnail Type an
     *
     * @param $handle string
     * @param $name string
     * @param $width int
     * @return void
     *
     * --------------------------------------------------------------
    */
    protected function addThumbnailTypeIfNotExists($handle, $name, $width)
    {
        if (!is_object($small = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle($handle)))
        {
            $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
            $type->setName($name);
            $type->setHandle($handle);
            $type->setWidth($width);
            $type->save();
        }
        # bild anzeigen
        // $file, our file object.
        //$image = \Core::make('html/image', array(\Concrete\Core\File\File::getByID((int)$portoSetup[0]['page_logo'])));
        //echo $image->getTag();
    }



    /** --------------------------------------------------------------
     *
     * Erzeugt einen Alphanumerischen Random String
     *
     * @param $length int
     * @return string
     *
     * --------------------------------------------------------------
    */
    protected function generateRandomString($length=10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i=0; $i<$length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



    /** --------------------------------------------------------------
     *
     * Registriert einen CronJob
     *
     * @param $pkg object Concrete\Package\Porto
     * @param $cronJobHandle string
     * @RETURN void
     *
     * --------------------------------------------------------------
    */
    protected function addCronJobIfNotExists($pkg, $cronJobHandle)
    {
        if (!is_object(Job::getByHandle($cronJobHandle)))
        {
            Job::installByPackage($cronJobHandle, $pkg);
        }
    }
}
?>