<?php defined('C5_EXECUTE') or die("Access Denied.");
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
$c = Page::getCurrentPage();
if ($c->isEditMode()) {
    $texteffect = 'none';
}

if($texteffect=='none')
{
    echo '<'.$textsize.'>';
    if($textstrong==1){
        echo '<strong>';
    }
    echo $headingtext;
    if($textstrong==1){
        echo '</strong>';
    }
    echo '</'.$textsize.'>';
}
elseif($texteffect=='random')
{
    $effects = array(
        'fadeIn',
        'fadeInUp',
        'fadeInDown',
        'fadeInLeft',
        'fadeInRight',
        'fadeInUpBig',
        'fadeInDownBig',
        'fadeInLeftBig',
        'fadeInRightBig',
        'bounceIn',
        'bounceInUp',
        'bounceInDown',
        'bounceInLeft',
        'bounceInRight',
        'rotateIn',
        'rotateInUpLeft',
        'rotateInDownLeft',
        'rotateInUpRight',
        'rotateInDownRight',
        'flash',
        'shake',
        'bounce',
        'tada',
        'swing',
        'wobble',
        'wiggle'
    );
    $randomEffect = $effects[rand(0, count($effects)-1)];
    echo '<'.$textsize.' class="appear-animation '.$randomEffect.' appear-animation-visible" data-appear-animation="'.$randomEffect.'">';
    if($textstrong==1){
        echo '<strong>';
    }
    echo $headingtext;
    if($textstrong==1){
        echo '</strong>';
    }
    echo '</'.$textsize.'>';
}
else
{
    echo '<'.$textsize.' class="appear-animation '.$texteffect.' appear-animation-visible" data-appear-animation="'.$texteffect.'">';
    if($textstrong==1){
        echo '<strong>';
    }
    echo $headingtext;
    if($textstrong==1){
        echo '</strong>';
    }
    echo '</'.$textsize.'>';
}
?>