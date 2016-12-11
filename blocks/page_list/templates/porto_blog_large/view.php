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
$th = Core::make('helper/text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date');
$ih = Core::make('helper/image');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="blog-posts">
                <?php if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
                    <div class="ccm-edit-mode-disabled-item">
                        <?php echo t('Empty Page List Block.')?>
                    </div>
                <?php
                }
                else
                {
                    if(count($pages)>0){
                        foreach($pages as $page)
                        {
                            $title = $th->entities($page->getCollectionName());
                            $url = $nh->getLinkToCollection($page);
                            $target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
                            $target = empty($target) ? '_self' : $target;
                            $description = $page->getCollectionDescription();
                            $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
                            $description = $th->entities($description);
                            $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);
                            $original_author = Page::getByID($page->getCollectionID(), 1)->getVersionObject()->getVersionAuthorUserName();
                            $tags = $page->getAttribute('tags');
                            ?>
                            <article class="post post-large">
                                <?php if ($displayThumbnail ) { ?>
                                    <div class="post-image">
                                        <?php
                                        if(!$c->isEditMode())
                                        {
                                            $blocks = $page->getBlocks('Blog Post Header');
                                            foreach($blocks as $b)
                                            {
                                                if(is_object($block = Block::getByID($b->bID)))
                                                {
                                                    if ($block->btHandle == 'image' && $block->instance->fID > 0)
                                                    {
							                            if($picture = \Concrete\Core\File\File::getByID($block->instance->fID))
                                                        {
							                                $picture = $ih->getThumbnail($picture, 840, 840, false);
                                                            echo '<div><div class="img-thumbnail"><img class="img-responsive" src="'.$picture->src.'" alt=""></div></div>';
                                                            break;
                                                        }
                                                    }
                                                    elseif($block->btHandle == 'image_slider')
                                                    {
                                                        $db = Database::getActiveConnection();
                                                        $r = $db->fetchAll('SELECT * from btImageSliderEntries WHERE bID = ? ORDER BY sortOrder', array($block->bID));
                                                        $imageFilePaths = array();
                                                        foreach($r as $q)
                                                        {
                                                            if (!$q['linkURL'] && $q['internalLinkCID']) {
                                                                $c = Page::getByID($q['internalLinkCID'], 'ACTIVE');
                                                                $q['linkURL'] = $c->getCollectionLink();
                                                            }
                                                            $imageFilePaths[] = $q;
                                                        }
                                                        echo '<div class="owl-carousel" data-plugin-options=\'{"items":1}\'>';
                                                        foreach($imageFilePaths as $key => $image)
                                                        {
							                                $picture = \Concrete\Core\File\File::getByID($image['fID']);
							                                $picture = $ih->getThumbnail($picture, 840, 840, false);
                                                            echo '<div><div class="img-thumbnail">';
                                                            echo '<img class="img-responsive" src="'.$picture->src.'" alt="">';
                                                            echo '</div></div>';
                                                        }
                                                        echo '</div>';
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        else
                                        {
                                            echo t('Image in Edit Mode disabled!');
                                        }
                                        ?>
                                    </div>
                                <?php } ?>

                                <div class="post-date">
                                    <span class="day"><span><i class="fa fa-calendar"></i> <?php echo date("d",strtotime($date)); ?></span></span>
                                    <span class="month"><?php echo date("M",strtotime($date)); ?></span>
                                </div>

                                <div class="post-content">
                                    <h2><a href="<?php echo $url; ?>" target="<?php echo $target; ?>"><?php echo $title; ?></a></h2>
                                    <p><?php echo $description; ?> [...]</p>
                                    <div class="post-meta">
                                         <span><i class="fa fa-user"></i>
                                             <?php if (Config::get('concrete.user.profiles_enabled')) {
                                                 $ui = \Concrete\Core\User\UserInfo::getByUserName($original_author);
                                                 echo '<a href="'.URL::to('/members/profile/view/').'/'.$ui->getUserID().'">';
                                             }
                                             echo $original_author;
                                             if (Config::get('concrete.user.profiles_enabled')) {
                                                 echo '</a>';
                                             }?>
                                            </span>
                                        <?php
                                        $tags = explode(' ', trim($tags));
                                        if (count($tags)>1){
                                            echo '<span><i class="fa fa-tag"></i>';
                                            for($k=0; $k<count($tags); $k++)
                                            {
                                                echo $tags[$k].' ';
                                            }
                                            echo '</span>';
                                        }
                                        ?>
                                        <!--<span><i class="fa fa-comments"></i> <a href="#">12 Comments</a></span>-->
                                        <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="btn btn-xs btn-primary pull-right"><?php echo t('More')?>...</a>
                                    </div>
                                </div>
                            </article>
                        <?php
                        }
                    }
                }
                if ($showPagination):
                    echo '<div class="center">'.$pagination.'</div>';
                endif; ?>
            </div>
        </div>
    </div>
</div>