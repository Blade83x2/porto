<?php defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Core\File\Type\Type as FileType,
    \Concrete\Core\File\Set,
    \Page;
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
?>
<div class="row">
    <div class="col-md-12">
        <div class="nivo-slider">
            <div class="slider-wrapper theme-default">
                <div id="nivoSlider<?php echo $bID?>" class="nivoSlider">
                    <?php
                    $selectedSet = FileSet::getByID($filesetid);
                    $fileList = new FileList();
                    $fileList->filterBySet($selectedSet);
                    $fileList->filterByType(FileType::T_IMAGE);
                    $ih = Core::make('helper/image');
                    $maxWidth = 120;
                    $maxHeight = 26;
                    foreach($fileList->get() as $f)
                    {
                        $crop = false;
                        $thumbnail = $ih->getThumbnail($f, $maxWidth, $maxHeight, $crop);
                        $thumbnail =  $thumbnail->src;
                        echo '<img src="'.$f->getRelativePath().'" data-thumb="'.$thumbnail.'" alt="'.$f->getTitle().'" />';
                    }
                    ?>
                </div>
                <div id="htmlcaption<?php echo $bID?>" class="nivo-html-caption"></div>
            </div>
            <?php
            if(count($fileList->get())==0){
                $c = Page::getCurrentPage();
                if ($c->isEditMode())
                {
                    ?>
                    <div class="ccm-edit-mode-disabled-item">
                        <div><?php echo t('FileSet has no Images'); ?></div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<script>
(function($) {
    'use strict';
    if ($.isFunction($.fn.nivoSlider)) {
        $('#nivoSlider<?php echo $bID?>').nivoSlider({
                effect: '<?php echo $effect?>',
                slices: 15,
                boxCols: 8,
                boxRows: 4,
                animSpeed: <?php echo $animateSpeed?>,
                pauseTime: <?php echo $animateInterval?>,
                startSlide: 0,
                directionNav: <?php echo (($directionNavArrows==1)?'true':'false')?>,
                controlNav: <?php echo (($bulseyeArrows==1)?'true':'false')?>,
                controlNavThumbs: <?php echo (($generateNavThumbs==1)?'true':'false')?>,
                pauseOnHover: <?php echo (($pauseOnMouseOver==1)?'true':'false')?>,
                manualAdvance: <?php echo (($autoStart==1)?'false':'true')?>,
                prevText: '<?php echo t('prev')?>',
                nextText: '<?php echo t('next')?>',
                randomStart: <?php echo (($randomStart==1)?'false':'true')?>
            });
        }
}).apply(this, [jQuery]);
</script>