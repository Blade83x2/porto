<?php 
defined('C5_EXECUTE') or die("Access Denied.");
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
$db = Database::getActiveConnection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage()?>">
	<head>
		<?php
        View::element('header_required', array('pageTitle' => $pageTitle), 'porto');
        ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
		if ((isset($portoSetup['boxed_design']) && $portoSetup['boxed_design']==1) && (isset($portoSetup['background_image']) && (int)$portoSetup['background_image'] > 0))
		{
		    if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['background_image']) ))
		    {
                ?>
                <style type='text/css'>
                    body {
                    background-image: url("<?php echo \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['background_image'])?>");
                    <?php if (isset($portoSetup['background_fix']) && $portoSetup['background_fix']==1) echo 'background-attachment:fixed;';  ?>
                    }
                </style>
                <?php
		    }
		}
		if ($c->isEditMode())
        {
		    if(is_object($portoPackage = Package::getByHandle('porto')))
            {
			    echo "<script type=\"text/javascript\"> var PORTO_VER = \"".$portoPackage->getPackageVersion()."\", COOKIE_NAME = \"".Config::get('concrete.session.name')."\"; </script>"."\n";
			    unset($portoPackage);
		    }
		}
		?>
		<!--[if IE]>
			<link rel="stylesheet" href="<?php echo $view->getThemePath()?>/css/ie.css">
		<![endif]-->
		<!--[if lte IE 8]>
			<script src="<?php echo $view->getThemePath()?>/vendor/respond/respond.js"></script>
			<script src="<?php echo $view->getThemePath()?>/vendor/excanvas/excanvas.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="<?php echo $view->getStyleSheet('default.less')?>" type='text/css'>
	</head>
	<body class="one-page<?php if (isset($portoSetup['boxed_design']) && $portoSetup['boxed_design']==1) echo ' boxed'?><?php if ($c->isEditMode()) { ?> editmode<?php } ?>" data-target=".single-menu" data-spy="scroll" data-offset="200">
	    <div class="<?php echo $c->getPageWrapperClass()?>">
		    <div class="body">
			    <header id="header" class="single-menu flat-menu" data-sticky-header-margin-top="0">
				    <div class="container">
					    <?php
					    if($portoSetup['stickymenu_active']==1)
					    {
                            if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['second_stickymenu_gfx']) ))
                            {
                                echo '<div class="logo">';
                                echo '  <a href="'.BASE_URL.DIR_REL.'">';
                                echo '    <img class="img-responsive" alt="" data-sticky-top="'.$portoSetup['second_stickymenu_gfx_top'].'" width="'.$portoSetup['second_stickymenu_gfx_x'].'" height="'.$portoSetup['second_stickymenu_gfx_y'].'" data-sticky-width="'.$portoSetup['second_stickymenu_gfx_x'].'" data-sticky-height="'.$portoSetup['second_stickymenu_gfx_y'].'" src="'. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['second_stickymenu_gfx']).'">';
                                echo '  </a>';
                                echo '</div>';
                            }
                        }
					    elseif ($portoSetup['stickymenu_active']==0)
					    {
					        if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['page_logo']) ))
					        {
						        echo '<div class="logo">';
						        echo '  <a href="'.BASE_URL.DIR_REL.'">';
						        echo '    <img class="img-responsive" alt="" data-sticky-top="'.$portoSetup['second_stickymenu_gfx_top'].'" width="'.$portoSetup['page_logo_x'].'" height="'.$portoSetup['page_logo_y'].'" data-sticky-width="'.$portoSetup['second_stickymenu_gfx_x'].'" data-sticky-height="'.$portoSetup['second_stickymenu_gfx_y'].'" src="'. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['page_logo']).'">';
						        echo '  </a>';
						        echo '</div>';
					        }
					    }
					    elseif ($portoSetup['stickymenu_active']==2)
					    {
					        if (is_object($f1=\Concrete\Core\File\File::getByID((int)$portoSetup['page_logo'])) && is_object($f2=\Concrete\Core\File\File::getByID((int)$portoSetup['second_stickymenu_gfx'])))
					        {
						        echo '<div class="logo">';
						        echo '  <a href="'.BASE_URL.DIR_REL.'">';
						        echo '    <img class="img-responsive" alt="" data-sticky-top="'.$portoSetup['second_stickymenu_gfx_top'].'" width="'.$portoSetup['page_logo_x'].'" height="'.$portoSetup['page_logo_y'].'" data-sticky-width="'.$portoSetup['second_stickymenu_gfx_x'].'" data-sticky-height="'.$portoSetup['second_stickymenu_gfx_y'].'" src="'. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['page_logo']).'">';
						        echo '  </a>';
						        echo '</div>';
					        }
					    }
					    ?>
					    <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						    <i class="fa fa-bars"></i>
					    </button>
				    </div>
				    <div class="navbar-collapse nav-main-collapse collapse">
					    <div class="container">
                            <?php
                            $a = new \Concrete\Core\Area\GlobalArea('Header Social');
                            $a->display();
                            $bt_main = BlockType::getByHandle('autonav');
                            $bt_main->controller->displayPages = 'top';
                            $bt_main->controller->orderBy = 'display_asc';
                            $bt_main->controller->displaySubPages = 'all';
                            $bt_main->controller->displaySubPageLevels = 'all';
                            $bt_main->render('templates/porto_onepage_navigation');
                            ?>
					    </div>
				    </div>
			    </header>
			    <div role="main" class="main">
			    
			    
			    <?php
$a = new \Concrete\Core\Area\Area('Slider');
$a->display($c);
?>
			    
			    
			    
				    <div class="container">
					    <div class="row">
						    <div class="col-md-12">
							    <?php
							    echo '<div id="id'.HOME_CID.'"></div>';
							    $as = new Area('Main');
							    $as->display($c);
							    ?>
						    </div>
					    </div>
				    </div>
			    </div>
			    <?php $this->inc('../porto/inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup));?>
		    </div>
		    <?php
            if (!is_object($c))
            {
		        $c = Page::getCurrentPage();
            }
		    if (!$c->isEditMode())
		    {
		        ?>
		        <script src="<?php echo $view->getThemePath()?>/vendor/common/common.js"></script>
		        <script src="<?php echo $view->getThemePath()?>/js/theme.js"></script>
		        <?php
		        $stickyMenuActivate = '';
		        $stickyMenuDeactivate = '';
		        $logoSmallWidth = '';
		        $logoSmallHeight = '';
		        if (!is_object($cp))
                {
			        $cp = new Permissions($c);
		        }

		        if($portoSetup['stickymenu_active']==1)
		        {
			        if(is_object(\Concrete\Core\File\File::getByID((int)$portoSetup['second_stickymenu_gfx'])))
			        {
			            $stickyMenuActivate = ' $logo.attr("src", \''. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['second_stickymenu_gfx']) .'\'); ';
			            $logoSmallWidth     = ' logoSmallWidth=parseInt('.(int)$portoSetup['second_stickymenu_gfx_x'].'); ';
			            $logoSmallHeight    = ' logoSmallHeight=parseInt('.(int)$portoSetup['second_stickymenu_gfx_y'].'); ';
			        }
		        }
		        elseif($portoSetup['stickymenu_active']==2 )
		        {
			        if(is_object($f1=\Concrete\Core\File\File::getByID((int)$portoSetup['page_logo'])) &&  is_object($f2=\Concrete\Core\File\File::getByID((int)$portoSetup['second_stickymenu_gfx'])) )
			        {
			            $stickyMenuActivate = ' $logo.attr("src", \''. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['second_stickymenu_gfx']) .'\'); ';
			            $logoSmallWidth     = ' logoSmallWidth=parseInt('.(int)$portoSetup['second_stickymenu_gfx_x'].'); ';
			            $logoSmallHeight    = ' logoSmallHeight=parseInt('.(int)$portoSetup['second_stickymenu_gfx_y'].'); ';
			            $stickyMenuDeactivate = ' $logo.attr("src", \''. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['page_logo']) .'\');';
			        }
		        }
		        #$p = \Concrete\Core\Page\Page::getCurrentPage();
		        $p = clone $c;
		        $cPath = $p->getCollectionPath();
		        $canonicalURL = BASE_URL.DIR_REL;
		        $canonicalURL .= URL_REWRITING?"":"/index.php";
		        $canonicalURL .= $cPath;
		        if(!(substr($cPath, strlen($cPath)-1, 1)=="/"))
                {
                    $canonicalURL .= "/";
                }
		        $pageIndentifierVars = array('keywords','fID','tag','productID');
		        $canonicalVars = array();
		        foreach($pageIndentifierVars as $var)
                {
                    if($_REQUEST[$var])
                    {
                        $canonicalVars[] = $var.'='.$_REQUEST[$var];
                    }
                }
		        if( count($canonicalVars) )
                {
                    $canonicalURL .= '?' . join(',',$canonicalVars);
                }
		        if (substr($canonicalURL, -1) == '/')
                {
			        $canonicalURL = substr($canonicalURL, 0, -1);
		        }
		        $this->addHeaderItem("<link rel=\"canonical\" href=\"".preg_replace('/:\/\/www./', '://', $canonicalURL)."\" />");
		        if(!$p->getCollectionAttributeValue('exclude_search_index') && $p->getCollectionAttributeValue('porto_meta_tags_robots')=='')
                {
			        $this->addHeaderItem("<meta name=\"robots\" content=\"index,follow\" />");
		        }
                elseif(strlen($p->getCollectionAttributeValue('porto_meta_tags_robots'))>1 && !$p->getCollectionAttributeValue('exclude_search_index'))
                {
			        $this->addHeaderItem("<meta name=\"robots\" content=\"".$p->getCollectionAttributeValue('porto_meta_tags_robots')."\" />");
		        }
		        if($p->getCollectionAttributeValue('porto_meta_tags_revisit_after')=='')
                {
			        $this->addHeaderItem("<meta name=\"revisit-after\" content=\"1 day\" />");
		        }
                else
                {
			        $this->addHeaderItem("<meta name=\"revisit-after\" content=\"".$p->getCollectionAttributeValue('porto_meta_tags_revisit_after')."\" />");
		        }
		        if($p->getCollectionAttributeValue('porto_meta_tags_audience')=='')
                {
			        $this->addHeaderItem("<meta name=\"audience\" content=\"".t('All')."\" />");
		        }
                else
                {
			        $this->addHeaderItem("<meta name=\"audience\" content=\"".$p->getCollectionAttributeValue('porto_meta_tags_audience')."\" />");
		        }
		        if(strlen($p->getCollectionAttributeValue('porto_meta_tags_page_topic'))>0)
                {
			        $this->addHeaderItem("<meta name=\"page-topic\" content=\"".$p->getCollectionAttributeValue('porto_meta_tags_page_topic')."\" />");
		        }
		        $this->addHeaderItem("\x3C\x6D\x65\x74\x61\x20\x6E\x61\x6D\x65\x3D\x22\x70\x75\x62\x6C\x69\x73\x68\x65\x72\x22\x20\x63\x6F\x6E\x74\x65\x6E\x74\x3D\x22\x4A\x6F\x68\x61\x6E\x6E\x65\x73\x20\x4B\x72\xC3\xA4\x6D\x65\x72\x22\x20\x2F\x3E");
		        $this->addHeaderItem("\x3C\x6D\x65\x74\x61\x20\x6E\x61\x6D\x65\x3D\x22\x63\x6F\x70\x79\x72\x69\x67\x68\x74\x22\x20\x63\x6F\x6E\x74\x65\x6E\x74\x3D\x22\x28\x63\x29\x20\x4A\x6F\x68\x61\x6E\x6E\x65\x73\x20\x4B\x72\xC3\xA4\x6D\x65\x72\x22\x20\x2F\x3E");
		        $u = new \Concrete\Core\User\User();
		        if(!$p->isEditMode())
		        {
			        echo '<script type="text/javascript">';
			        if($portoSetup['show_login']==1 && !$u->isLoggedIn())
			        {
			            echo '(function(theme, $) {
                            theme = theme || {};
                            var initialized = false;
                            $.extend(theme, {
                                Account: {
                                    defaults: { wrapper: $(\'#headerAccount\') }, initialize: function($wrapper, opts) { if (initialized) { return this; } initialized = true; this.$wrapper = ($wrapper || this.defaults.wrapper); this.setOptions(opts).events(); return this; },
                                    setOptions: function(opts) { this.options = $.extend(true, {}, this.defaults, opts, this.$wrapper.data(\'plugin-options\')); return this; },
                                    events: function() {
                                        var self = this;
                                        self.$wrapper.find(\'input\').on(\'focus\', function() { self.$wrapper.addClass(\'open\'); $(document).mouseup(function(e) { if (!self.$wrapper.is(e.target) && self.$wrapper.has(e.target).length === 0) { self.$wrapper.removeClass(\'open\'); } }); });
                                        $(\'#headerSignIn\').on(\'click\', function(e) { e.preventDefault(); self.$wrapper.addClass(\'signin\').removeClass(\'signup\').removeClass(\'recover\'); self.$wrapper.find(\'.signin-form input:first\').focus(); });
                                        $(\'#headerRecover\').on(\'click\', function(e) { e.preventDefault(); self.$wrapper.addClass(\'recover\').removeClass(\'signup\').removeClass(\'signin\'); self.$wrapper.find(\'.recover-form input:first\').focus(); });
                                        $(\'#headerRecoverCancel\').on(\'click\', function(e) { e.preventDefault(); self.$wrapper.addClass(\'signin\').removeClass(\'signup\').removeClass(\'recover\'); self.$wrapper.find(\'.signin-form input:first\').focus(); });
                                    }
                                }
                            });
                        }).apply(this, [window.theme, jQuery]);';
			        }


			        if($portoSetup['stickymenu_active']>0)
			        {
			            echo '
                        (function(theme, $) {
                        theme = theme || {};
                        var initialized = false;
                        $.extend(theme, {
                            StickyMenu: {
                                defaults: {
                                    wrapper: $(\'#header\'),
                                    stickyEnabled: true,
                                    stickyEnableOnBoxed: true,
                                    stickyEnableOnMobile: false, menuAfterHeader: false, logoPaddingTop: 28, logoSmallWidth: 82, logoSmallHeight: 40
                                },
                                initialize: function($wrapper, opts) { if (initialized) { return this; } initialized = true; this.$wrapper = ($wrapper || this.defaults.wrapper); this.setOptions(opts).build().events(); return this; },
                                setOptions: function(opts) { this.options = $.extend(true, {}, this.defaults, opts, this.$wrapper.data(\'plugin-options\')); return this; },
                                build: function() {
                                if (!this.options.stickyEnableOnBoxed && $(\'body\').hasClass(\'boxed\') || !this.options.stickyEnabled) { return false; }
                                var self = this, $body = $(\'body\'), $header = self.$wrapper, $headerContainer = $header.parent(), $headerNavItems = $header.find(\'ul.nav-main > li > a\'), $logoWrapper = $header.find(\'.logo\'), $logo = $logoWrapper.find(\'img\'), logoWidth = $logo.attr(\'width\'), logoHeight = $logo.attr(\'height\'), logoPaddingTop = parseInt($logo.attr(\'data-sticky-padding\') ? $logo.attr(\'data-sticky-padding\') : self.options.logoPaddingTop), logoSmallWidth = parseInt($logo.attr(\'data-sticky-width\') ? $logo.attr(\'data-sticky-width\') : self.options.logoSmallWidth), logoSmallHeight = parseInt($logo.attr(\'data-sticky-height\') ? $logo.attr(\'data-sticky-height\') : self.options.logoSmallHeight), headerHeight = $header.height();
                                stickyHeaderHeight = parseInt($header.attr(\'data-sticky-header-margin-top\'));
                                if (this.options.menuAfterHeader) { $headerContainer.css(\'min-height\', $header.height()); }
                                $(window).afterResize(function() { $headerContainer.css(\'min-height\', $header.height()); });
                                self.checkStickyMenu = function() {
                                if ((!self.options.stickyEnableOnBoxed && $body.hasClass(\'boxed\')) || ($(window).width() < 991 && !self.options.stickyEnableOnMobile))
                                { self.stickyMenuDeactivate(); $header.removeClass(\'fixed\'); return false; }
                                if (!this.options.menuAfterHeader) { if ($(window).scrollTop() > ((headerHeight - 15) - logoSmallHeight)) { self.stickyMenuActivate(); } else { self.stickyMenuDeactivate(); }} else { if ($(window).scrollTop() > $headerContainer.offset().top) { $header.addClass(\'fixed\'); } else { $header.removeClass(\'fixed\'); } }
                                }
                                self.stickyMenuActivate = function() {
                                if ($body.hasClass(\'sticky-menu-active\')) { return false; }
                                $logo.stop(true, true);
                                $body.addClass(\'sticky-menu-active\').removeClass(\'sticky-menu-deactive\').css(\'padding-top\', headerHeight);
                                if(stickyHeaderHeight != 0)
                                {
                                $header.css(\'top\', stickyHeaderHeight);
                                }
                                if ($header.hasClass(\'flat-menu\')) { $headerNavItems.addClass(\'sticky-menu-active\'); }
                                $logoWrapper.addClass(\'logo-sticky-active\');
                                '.$stickyMenuActivate.'
                                '.$logoSmallWidth.'
                                '.$logoSmallHeight.'
                                $logo.animate({ width: logoSmallWidth, height: logoSmallHeight, top: logoPaddingTop + \'px\' }, 180, function() { $.event.trigger({ type: "stickyMenu.active" }); });
                                }
                                self.stickyMenuDeactivate = function() {
                                if ($body.hasClass(\'sticky-menu-active\')) {
                                $body.removeClass(\'sticky-menu-active\').addClass(\'sticky-menu-deactive\').css(\'padding-top\', 0);
                                if ($header.hasClass(\'flat-menu\')) { $headerNavItems.removeClass(\'sticky-menu-active\'); }
                                $logoWrapper.removeClass(\'logo-sticky-active\');
                                '.$stickyMenuDeactivate.'
                                $logo.animate({ width: logoWidth, height: logoHeight, top: \'0px\' }, 180, function() { $.event.trigger({type: "stickyMenu.deactive"}); });
                                }
                                }
                                self.stickyMenuShow = function() {
                                $(\'body\').addClass(\'sticky-menu-active\').removeClass(\'sticky-menu-deactive\').css(\'padding-top\', 78);
                                '.$stickyMenuActivate.'
                                '.(($stickyMenuActivate!='')?' $(\'#header\').find(\'.logo\').find(\'img\').css(\'width\', '.(int)$portoSetup['second_stickymenu_gfx_x'].')':'$(\'#header\').find(\'.logo\').find(\'img\').css(\'width\', '.(int)$portoSetup['page_logo_x'].') ').'
                                '.(($stickyMenuActivate!='')?'$(\'#header\').find(\'.logo\').find(\'img\').css(\'height\', '.(int)$portoSetup['second_stickymenu_gfx_y'].')':'$(\'#header\').find(\'.logo\').find(\'img\').css(\'height\', '.(int)$portoSetup['page_logo_y'].')').'
                                stickyHeaderHeight = parseInt($(\'#header\').attr(\'data-sticky-header-margin-top\'));
                                if(stickyHeaderHeight != 0)
                                {
                                $(\'#header\').css(\'top\', stickyHeaderHeight);
                                }
                                logoTop = parseInt($(\'#header\').find(\'.logo\').find(\'img\').attr(\'data-sticky-top\'));
                                if(logoTop != 0)
                                {
                                $(\'#header\').find(\'.logo\').find(\'img\').css(\'top\', logoTop);
                                }
                                if ($(\'#header\').hasClass(\'flat-menu\')) {
                                $(\'#header\').find(\'ul.nav-main > li > a\').addClass(\'sticky-menu-active\');
                                }
                                $(\'#header\').find(\'.logo\').addClass(\'logo-sticky-active\');
                                }
                                self.stickySetTop = function()
                                {
                                logoTop = parseInt($(\'#header\').find(\'.logo\').find(\'img\').attr(\'data-sticky-top\'));
                                if(logoTop != 0)
                                {
                                $(\'#header\').find(\'.logo\').find(\'img\').css(\'top\', logoTop);
                                }
                                }
                                $body.addClass(\'sticky-menu-deactive\');
                                self.checkStickyMenu();
                                return this;
                                },
                                events: function() {
                                var self = this;
                                '.(($portoSetup['stickymenu_active']==1 && !$cp->canViewToolbar())? ' self.stickyMenuShow();':'').'
                                '.(($portoSetup['stickymenu_active']==2 )? ' $(window).on(\'scroll resize\', function() { self.checkStickyMenu(); }); ':'').'
                                } } }); }).apply(this, [window.theme, jQuery]);';
			        }
			        if($portoSetup['scrolltotop_active']==1)
			        {
			            echo '
                            (function(theme, $) {
                                theme = theme || {};
                                $.extend(theme, {
                                    PluginScrollToTop: {
                                        defaults: { wrapper: $(\'body\'), offset: 150, buttonClass: \'scroll-to-top\', iconClass: \'fa fa-chevron-up\', delay: 500, visibleMobile: false, label: false },
                                        initialize: function(opts) { initialized = true; this.setOptions(opts).build().events(); return this; },
                                        setOptions: function(opts) { this.options = $.extend(true, {}, this.defaults, opts); return this; },
                                        build: function() {
                                            var self = this, $el;
                                            $el = $(\'<a />\').addClass(self.options.buttonClass).attr({ \'href\': \'#\' }).append($(\'<i />\').addClass(self.options.iconClass));
                                            if (!self.options.visibleMobile) { $el.addClass(\'hidden-mobile\'); }
                                            if (self.options.label) { $el.append($(\'<span />\').html(self.options.label) ); }
                                            this.options.wrapper.append($el);
                                            this.$el = $el;
                                            return this;
                                        },
                                        events: function() {
                                            var self = this, _isScrolling = false;
                                            self.$el.on(\'click\', function(e) {
                                                e.preventDefault();
                                                $(\'body, html\').animate({ scrollTop: 0 }, self.options.delay);
                                                return false;
                                            });
                                            $(window).scroll(function() {
                                                if (!_isScrolling) {
                                                    _isScrolling = true;
                                                    if ($(window).scrollTop() > self.options.offset) {
                                                        self.$el.stop(true, true).addClass(\'visible\');
                                                        _isScrolling = false;
                                                    } else {
                                                        self.$el.stop(true, true).removeClass(\'visible\');
                                                        _isScrolling = false;
                                                    }
                                                }
                                            });
                                            return this;
                                        }
                                    }
                                });
                            }).apply(this, [window.theme, jQuery]);';
			        }
			        echo '(function($) {
			            \'use strict\';
                        '.(( $portoSetup['stickymenu_active']==1  )?'if ($.isFunction(theme.StickyMenu.initialize)) { theme.StickyMenu.initialize(); }':'').'
                        '.(( $portoSetup['stickymenu_active']==2 )?'if ($.isFunction(theme.StickyMenu.initialize)) { theme.StickyMenu.initialize(); }':'').'
			            if ($.isFunction(theme.Nav.initialize)) { theme.Nav.initialize(); }
			            '.(($portoSetup['scrolltotop_active']==1)?'if ($.isFunction(theme.PluginScrollToTop.initialize)) { theme.PluginScrollToTop.initialize(); }':'').'
			            '.(($portoSetup['tooltip_active']==1)?'if ($.isFunction($.tooltip)) { $(\'a[rel=tooltip]\').tooltip(); }':'').'
			            //  ??? WTF ????
			            '.(($portoSetup['show_login']==1 && !$u->isLoggedIn())?'if ($.isFunction(theme.Account.initialize)) { theme.Account.initialize(); }':'').'
			            if ($.isFunction(theme.PluginParallax.initialize)) { theme.PluginParallax.initialize(); }
			            if ($.isFunction(theme.Search.initialize)) { theme.Search.initialize(); }
			            }).apply(this, [jQuery]);
			            </script>';
		        }
		    }

            View::element('footer_required', array(), 'porto');
		    ?>
	    </div>
	</body>
</html>