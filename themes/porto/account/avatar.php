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
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
$db = Database::getActiveConnection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
$this->inc('inc/headerTypes/'.$portoSetup['header_type'].'.php', array('portoSetup' => $portoSetup));


$save_url = \Concrete\Core\Url\Url::createFromUrl($view->action('save_thumb'));
$save_url = $save_url->setQuery(array(
    'ccm_token' => \Core::make('token')->generate('avatar/save_thumb')
));


?>
<br /><br /><br />
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $a = new \Concrete\Core\Area\Area('Main');
            $a->display($c);
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            

                    <div id="profile-avatar">
                        <?php echo t('You need the Adobe Flash plugin installed on your computer to upload and crop your user profile picture.')?>
                        <br /><br />
                        <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">Download the Flash Player here</a>.
                    </div>


                    <script type="text/javascript">
                    ThumbnailBuilder_onSaveCompleted = function() {
                        window.location.href="<?php echo $view->url('/account/avatar', 'saved')?>";
                    };

                    /* <?php /* flashvars - options for the avatar/thumb picker
                    upload -- whether to enable or disable the upload button (default is "true")
                    webcam -- whether to enable or disable the webcam button (default is "true")
                    format -- whether to use "jpg", "png" or "auto" when encoding (default is "auto")
                    imagePath -- which image should be preloaded into the editor
                    overlayPath -- an optional image to provide chrome over the top of thumbnails
                    redirectPath -- an optional path to redirect to once an image has been saved
                    savePath -- an optional path for saving images ($_POST["thumbnail"], base64) instead of saving locally
                    rounding -- an optional amount of pixel rounding on thumbnail edges (will output transparent corners)
                    width -- the width of the thumbnail
                    quality -- the quality of the output image when using the JPEG encoder (default is 80)
                    height -- the height of the thumbnail
                    backgroundColor -- the color to use when tinting the background of the editor (default is 0xFFFFFF)
                    tint -- the amount of strength to apply when tinting the background of the editor (default is 0)
                    */ ?> */
                    $(function(){
                        var params = {
                            bgcolor: "#ffffff",
                            wmode:  "transparent",
                            quality:  "high"
                        };
                        var flashvars = {
                            width: '<?php echo Config::get('concrete.icons.user_avatar.width') ?>',
                            height: '<?php echo Config::get('concrete.icons.user_avatar.height') ?>',
                            image: '<?php echo $av->getImagePath($profile)?>',
                            save: "<?php echo $view->action('save_thumb')?>"
                        };
                        swfobject.embedSWF ("<?php echo ASSETS_URL_JAVASCRIPT?>/thumbnail-editor-3.swf", "profile-avatar", "500", "400", "10,0,0,0", "includes/expressInstall.swf", flashvars, params);
                   });
                    </script>
                <br/>
                <br/>
		<div class="form-group">
		    <div class="col-md-4">
			<div class="form-actions">
			    <a href="<?php echo URL::to('/account')?>" class="btn btn-default control-label" /><?php echo t('Back to Account')?></a>
			</div>
		    </div>
		    <div class="col-md-4">
			<?php if ($profile->hasAvatar()) { ?>
			    
			    <a href="<?php echo $view->action('delete')?>" class="btn btn-danger control-label"><?php echo t('Remove your user avatar')?> <i class="icon-trash icon-white"></i></a>
			<?php } ?>
		    </div>
		</div>
                


        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $a = new \Concrete\Core\Area\Area('Main 2');
            $a->display($c);
            ?>
        </div>
    </div>
</div>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>