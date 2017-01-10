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
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
$this->inc('inc/headerTypes/'.$portoSetup['header_type'].'.php', array('portoSetup' => $portoSetup));
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>
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
<br /><br />
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div style="float:left">
            <h3><?php if(is_object($profile)) { echo $profile->getUserName(); }?></h3>
        </div>
     <div style="float:right">
	    
		<?php
        if(is_object($profile)){
		if(is_object($ui = \Concrete\Core\User\UserInfo::getByID($profile->getUserID()))){
            if(!$ui->hasAvatar()){
                switch($ui->getAttribute('gender')){
                case 'male':
                    echo '<img class="img-responsive img-thumbnail" src="'.$view->getThemePath().'/img/avatar_male.png" alt="'.(is_object($u)?$u->getUserName():'').'" />';
                    break;
                case 'female':
                    echo '<img class="img-responsive img-thumbnail" src="'.$view->getThemePath().'/img/avatar_female.png" alt="'.(is_object($u)?$u->getUserName():'').'" />';
                    break;
                default:
                    echo '<img class="img-responsive img-thumbnail" src="'.$view->getThemePath().'/img/avatar_none.jpg" alt="'.(is_object($u)?$u->getUserName():'').'" />';
                    break;
                }
            }
            else {
                  echo '<div class="img-thumbnail">';
                  print \Core::make('helper/concrete/avatar')->outputUserAvatar($profile);
                  echo '</div>';
            }
        }
        }
		?>
	    </div> 
	    <div style="clear:both"></div>
        </div>
    </div>
    
    <br />

    <div class="row">
        <div class="col-md-12">
            <i class="icon-time"></i> <?php if(is_object($profile)) { echo t(/*i18n: %s is a date */'Joined on %s', $dh->formatDate($profile->getUserDateAdded(), true)); } ?>
|
            <i class="icon icon-fire"></i> <?php if(is_object($profile)) { echo number_format(\Concrete\Core\User\Point\Entry::getTotal($profile)); } ?> <?php echo t('Community Points')?>
|
            <i class="icon-bookmark"></i> <a href="#badges"><?php echo number_format(count($badges))?> <?php echo t2('Badge', 'Badges', count($badges))?></a>
        </div>
    </div>
    <br />
    <?php
    $uaks = UserAttributeKey::getPublicProfileList();
    foreach($uaks as $ua) {
        if(is_object($profile))
        {
            $value = $profile->getAttribute($ua, 'displaySanitized', 'display');
            if($value)
            {
                echo '<div class="row">';
                ?>
                <div class="col-md-5">
                <strong><?php echo t($ua->getKeyName())?></strong>
                </div>
                <div class="col-md-5">
                <?php
                print $value;
                ?>
                </div>
                <?php
                echo "</div>";
            }
        }
    }
    ?>
    <div class="row">
        <div class="col-md-12">
	      <?php if (count($badges) > 0) { ?>
		  <ul class="thumbnails">
		      <?php foreach($badges as $ub) {
			  $uf = $ub->getGroupBadgeImageObject();
			  if (is_object($uf)) { ?>
			      <li class="col-md-2">
				  <div class="thumbnail launch-tooltip ccm-profile-badge-image" title="<?php echo $ub->getGroupBadgeDescription()?>">
				      <div><img src="<?php echo $uf->getRelativePath()?>" /></div>
				      <div><?php echo t("Awarded %s", $dh->formatDate($ub->getGroupDateTimeEntered($profile)))?></div>
				  </div>
			      </li>
			  <?php } ?>
		      <?php } ?>
		  </ul>
	      <?php
	      }
	      ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"> 
	    <?php if ($canEdit) { ?>
		<div class="btn-group">
		    <a href="<?php echo $view->url('/account/edit_profile')?>" class="btn btn-sm btn-default"><i class="fa fa-cog"></i> <?php echo t('Edit')?></a>
		</div>
	    <?php } else { ?>
		<?php if (is_object($profile) && $profile->getAttribute('profile_private_messages_enabled')) { ?>
		    <a href="<?php echo $view->url('/account/messages/inbox', 'write', $profile->getUserID())?>" class="btn btn-sm btn-default"><i class="fa-user fa"></i> <?php echo t('Send Message')?></a>
		<?php } ?>
	    <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"> 
	      <?php
	      $a = new Area('Main 2');
	      $a->display($c);
	      ?>
        </div>
    </div>
    
    
    
    
    
</div>
<script type="text/javascript">
    $(function() {
	$(".launch-tooltip").tooltip({
	    placement: 'bottom'
	});
    });
</script>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>