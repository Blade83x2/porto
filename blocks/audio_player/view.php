<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Core\File\Type\Type as FileType,
    \Concrete\Core\File\Set,
    \View;
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
?>
<div class="row">
    <?php if (is_object($picture)) { ?>
    <div class="col-md-2">
        <div class="thumb">
            <?php
            $thumbnail = $ih->getThumbnail($picture, $maxWidth=310, $maxHeight=310, $crop=TRUE);
            if (is_object($thumbnail))
            {
                $albumImage = $thumbnail->src;
                echo '<img class="center-block img-thumbnail img-responsive img-rounded" src="'.$albumImage.'" alt="'.$name.'" />';
            }
            ?>
            <br />
        </div>
    </div>
    <?php } ?>
    <div class="col-md-<?php if (is_object($picture)) { ?>10<?php } else { ?>12<?php } ?>">
        <?php if(!empty($name))
        { ?>
            <h2><?php echo $name?></h2>
        <?php } ?>
        <?php if(!empty($description))
        {
            echo $description;
        }
        $c = Page::getCurrentPage();
        if(is_object($selectedSet = FileSet::getByID($filesetid)))
        {
            $fileList = new FileList();
            $fileList->filterBySet($selectedSet);
            $fileList->filterByType(FileType::T_AUDIO);
            $fileList->filterByExtension('mp3');
            if ($c->isEditMode())
            {
                if(count($fileList->get())==0)
                {
                    echo '<div class="ccm-edit-mode-disabled-item">';
                    echo '<div>'.t('FileSet has no MP3 Files!').'</div>';
                    echo '</div>';
                }
                else
                {
                    echo '<div class="ccm-edit-mode-disabled-item">';
                    echo '<div>'.t('Player in edit Mode disabled!').'</div>';
                    echo '</div>';
                }
            }
            if (!$c->isEditMode())
            {
                ?>
                <div class="amazingaudioplayer-10" style="display:block;position:relative;width:100%;height:auto;margin:0px auto 0px;">
                    <ul class="amazingaudioplayer-audios" style="display:none;">
                        <?php
                        $titles = '';
                        foreach($fileList->get() as $f)
                        {
                            $titles .= '<li data-artist="'.substr($f->getTitle(), 0, -4).'" data-title="'.substr($f->getTitle(), 0, -4).'" data-album="'.$name.'" data-info="" data-image="'.$albumImage.'" data-duration="">';
                            $titles .= '<div class="amazingaudioplayer-source" data-src="'.$f->getRelativePath().'" data-type="audio/mpeg"></div>';
                            $titles .= '</li>';
                        }
                        echo $titles;
                        ?>
                    </ul>
                </div>
		    <?php
            }
        }
        else
        {
            if ($c->isEditMode())
            {
                echo '<div class="ccm-edit-mode-disabled-item">';
                echo '<div>'.t('FileSet has removed!').'</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>