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
$currentPage = \Concrete\Core\Page\Page::getCurrentPage();
$effectNameArray = array(
    0  => 'fadeIn',
    1  => 'fadeInUp',
    2  => 'fadeInDown',
    3  => 'fadeInLeft',
    4  => 'fadeInRight',
    5  => 'fadeInUpBig',
    6  => 'fadeInDownBig',
    7  => 'fadeInLeftBig',
    8  => 'fadeInRightBig',
    9  => 'bounceIn',
    10 => 'bounceInUp',
    11 => 'bounceInDown',
    12 => 'bounceInLeft',
    13 => 'bounceInRight',
    14 => 'rotateIn',
    15 => 'rotateInUpLeft',
    16 => 'rotateInDownLeft',
    17 => 'rotateInUpRight',
    18 => 'rotateInDownRight',
    19 => 'shake',
    20 => 'bounce',
    21 => 'flash',
    22 => 'tada',
    23 => 'swing',
    24 => 'wobble',
    25 => 'wiggle'
);
$randomNumber = rand(0, count($effectNameArray)-1);
if (isset($createFromSubPages) && $createFromSubPages!=0)
{
    if (($page=\Concrete\Core\Page\Page::getByID($createFromSubPages)) instanceof \Concrete\Core\Page\Page)
    {
        $output = '';
        $liCount = 0;
        $childArray = $page->getCollectionChildrenArray(1);
        if (count($childArray))
        {
            foreach ($childArray as $childPageID)
            {
                if(is_object($childPage=\Concrete\Core\Page\Page::getByID($childPageID)) )
                {
                    $errors = 0;
                    if(strlen($text=$childPage->getCollectionDescription())==0)
                    {
                        if(strlen($text=$childPage->getCollectionAttributeValue('meta_description'))==0)
                        {
                            $errors++;
                        }
                    }
                    if((!$date=date("Y", strtotime($childPage->getCollectionDatePublic()))) == 1970)
                    {
                        $errors++;
                    }
                    if(!$link=$childPage->getCollectionLink())
                    {
                        $errors++;
                    }
                    else
                    {
                        $linkStart = '<a href="'.$childPage->getCollectionLink().'">';
                        $linkEnd = '</a>';
                    }
                    if(is_object($image=$childPage->getAttribute('detailimage')))
                    {
                        $maxWidth = 200;
                        $maxHeight = 150;
                        $crop = false; // verhältnis ?
                        if (is_object($thumbnail=$ih->getThumbnail($image, $maxWidth, $maxHeight, $crop)))
                        {
                            $image = '<img src="' . $thumbnail->src . '" width="' . $thumbnail->width . '" height="' . $thumbnail->height . '" alt="'.t('Picture of').' '.$date.'" />';
                        }
                    }
                    elseif(is_object($image=$childPage->getAttribute('thumbnail')))
                    {
                        $maxWidth = 200;
                        $maxHeight = 150;
                        $crop = false; // verhältnis ?
                        if (is_object($thumbnail=$ih->getThumbnail($image, $maxWidth, $maxHeight, $crop)))
                        {
                            #$image = '<img src="' . $thumbnail->src . '" width="' . $thumbnail->width . '" height="' . $thumbnail->height . '" alt="'.t('Picture of').' '.$date.'" />';
                            $image = '<img src="' . $thumbnail->src . '" alt="'.t('Picture of').' '.$date.'" />';
                        }
                    }
                    else
                    {
                        $errors++;
                    }
                    if($errors==0)
                    {
                        $liCount++;
                        if ($effect!='none' && $effect!='random' && !$currentPage->isEditMode())
                        {
                            $output .= '<li class="appear-animation appear-animation-visible" data-appear-animation="'.$effect.'">';
                        }
                        elseif($effect=='random' && !$currentPage->isEditMode())
                        {
                            $output .= '<li class="appear-animation appear-animation-visible" data-appear-animation="'.$effectNameArray[$randomNumber].'">';
                        }
                        else
                        {
                            $output .= '<li>';
                        }
                        $output .= '<div class="thumb">';
                        $output .= $linkStart.$image.$linkEnd;
                        $output .= '</div>';
                        $output .= '<div class="featured-box">';
                        $output .= '<div class="box-content">';
                        $output .= '<h4><strong>'.$linkStart.$date.$linkEnd.'</strong></h4>';
                        $output .= '<p>'.$text.'</p>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</li>';
                    }
                }
            }
            if ($liCount>0)
            {
                echo '<ul class="history">';
                echo $output;
                echo '</ul>';
            }
            else
            {
                if($currentPage->isEditMode())
                {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. t('Subpages have not entire data to display').':</strong></div>';
                }
            }
        }
        else
        {
            if($currentPage->isEditMode())
            {
                echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. t('Source Page has no Subpages').':</strong></div>';
            }
        }
    }
    else
    {
        if($currentPage->isEditMode())
        {
            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. t('Source Page not found').':</strong></div>';
        }
    }
}
else
{
    if (is_object($file=\Concrete\Core\File\File::getByID($picture)) && $file instanceof \Concrete\Core\File\File)
    {
        if($redirectToPage!=0 && (($page=\Concrete\Core\Page\Page::getByID($redirectToPage)) instanceof \Concrete\Core\Page\Page))
        {
            $linkStart = '<a href="'.$page->getCollectionLink().'">';
            $linkEnd = '</a>';
        }
        else
        {
            $linkStart = $linkEnd = '';
        }
        ?>
        <ul class="history">
            <?php if ($effect!='none' && $effect!='random' && !$currentPage->isEditMode()){?>
                <li class="appear-animation appear-animation-visible" data-appear-animation="<?php echo $effect?>">
            <?php } elseif($effect=='random' && !$currentPage->isEditMode()) { ?>
                <li class="appear-animation appear-animation-visible" data-appear-animation="<?php echo $effectNameArray[$randomNumber]?>">
            <?php } else { ?>
                <li>
            <?php } ?>
                <div class="thumb">
                    <?php
                    $maxWidth = 200;
                    $maxHeight = 150;
                    $crop = false; // verhältnis ?
                    if (is_object($thumbnail=$ih->getThumbnail($file, $maxWidth, $maxHeight, $crop)))
                    {
                        echo $linkStart.'<img src="' . $thumbnail->src . '"  alt="'.t('Picture of').' '.$year.'" />'.$linkEnd;
                    }
                    ?>
                </div>
                <div class="featured-box">
                    <div class="box-content">
                        <?php if ($year!=0) { ?><h4><strong><?php echo $linkStart.$year.$linkEnd?></strong></h4><?php } ?>
                        <?php echo $text?>
                    </div>
                </div>
            </li>
        </ul>
        <?php
    }
    else
    {
        if($currentPage->isEditMode())
        {
            echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. t('Image not found').'</strong></div>';
        }
    }
}
unset($currentPage, $effectNameArray, $randomNumber);
?>