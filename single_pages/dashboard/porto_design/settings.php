<?php
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
echo Core::make('helper/concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Porto Package Setup'));
Core::make('help')->display(t('Theme-Design and loading functions'));
?>
<div class="ccm-dashboard-inner">
    <form method="post" action="<?php echo $this->action('save')?>">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(!$this->controller->hasPermissionToWrite())
                {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">'.t('Close').'</span></button><strong>'.t('Error!').'</strong><p>'.t('You do not have permission to edit this page!').'</p></div>';
                }
                if (is_object($config = \Core::make('config/database')))
                {
                    $obj = unserialize($config->get('porto.datamodel'));
                    if(is_object($obj))
                    {
                        $vt = Core::make('helper/validation/token');
                        echo $form->hidden('ccm_token', $vt->generate($obj->security->formToken));
                    }
                }
                if (isset($info))
                    echo $info;
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><strong><?php echo t('Theme settings')?></strong></h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label><?php echo $form->checkbox('load_from_cdn', 1, $load_from_cdn) . ' ' . t('Load Javascript &amp; CSS Files over CDN')?></label>
                <br />
                <small>
                    <?php echo t('This option accelerated the Server load')?>
                </small>
                <br /><br />
            </div>
            <div class="col-md-6">
                <label><?php echo $form->checkbox('show_login', 1, $show_login).' '.t('Show login in Navigation')?></label>
                <br />
                <small>
                    <?php echo t('Displays a login function in the Autonav Porto- Navigation')?>
                </small>
                <br /><br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label><?php echo $form->checkbox('boxed_design', 1, $boxed_design).' '.t('Activate Boxed Mode')?></label>
                <br />
                <small>
                    <?php echo t('Display the Page as a Boxed Version')?>
                </small>
                <br /><br />
            </div>
            <div class="col-md-6">
                <label><?php echo $form->checkbox('breadcrump_banner_active', 1, $breadcrump_banner_active).' '.t('Enable Breadcrump Navigation')?></label>
                <br />
                <small>
                    <?php echo t('Display the Breadcrump Navigation in every Pagetemplate with the exception of the "%s" Pagetemplate!', t('Home'))?>
                    <?php
                    $current = PageTheme::getSiteTheme();
                    if($current->getThemeHandle() == 'onepage')
                    {
                        ?>
                            <br />
                            <span style="color: #ff0e2c"><?php echo t('This function does not work with the OnePage Theme!')?></span>
                    <?php
                    }
                    ?>
                </small>
                <br /><br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label><?php echo $form->checkbox('scrolltotop_active', 1, $scrolltotop_active).' '.t('Enable Scroll to top')?></label>
                <br />
                <small>
                    <?php echo t('Enable a Scroll to top function in the bottom of the page')?>
                </small>
                <br /><br />
            </div>
            <div class="col-md-6">
                <label><?php echo $form->checkbox('load_footerinfotext_from_metadescription', 1, $load_footerinfotext_from_metadescription).' '.t('Load Footer- Infotext from Meta-Description')?></label>
                <br />
                <small>
                    <?php echo t('Get the Meta Description from the Site and put it to the footer')?>
                </small>
                <br /><br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br />
                <h3><strong><?php echo t('Search settings')?></strong></h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label><?php echo t('Link User defined search querys to target search page')?></label>
            </div>
            <div class="col-md-6">
                <?php echo $pageselect->selectPage('searchpage_id', $searchpage_id);?>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="searchpage_text"><?php echo t('Searchbox placeholder text')?></label>
            </div>
            <div class="col-md-6">
                <?php echo $form->text('searchpage_text', $searchpage_text, array('placeholder'=>t('Search...')));?>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="searchpage_empty_query"><?php echo t('Error Message by sending an empty query')?></label>
            </div>
            <div class="col-md-6">
                <?php echo $form->textarea('searchpage_empty_query', $searchpage_empty_query, array('placeholder'=>t('Searchquery is empty!')));?>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo $form->submit('submit', t('Save'), array('class'=>'btn btn-primary'))?>
            </div>
        </div>
    </form>
</div>
<style type="text/css"> label { cursor:pointer; } </style>
<?php echo Core::make('helper/concrete/dashboard')->getDashboardPaneFooterWrapper();?>