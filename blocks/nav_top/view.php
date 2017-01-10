<?php defined('C5_EXECUTE') or die(_("Access Denied."));
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
?>
<nav>
    <ul class="nav nav-pills nav-top">
        <?php
        if (is_object($link1=Page::getByID($link1_page_id)) && $link1_text!='')
        {
            ?>
            <li>
                <a href="<?php echo DIR_REL.$link1->getCollectionPath()?>"><i class="fa fa-angle-right"></i><?php echo $link1_text?></a>
            </li>
            <?php
        }
        if (is_object($link2=Page::getByID($link2_page_id)) && $link2_text!='')
        {
            ?>
            <li>
                <a href="<?php echo DIR_REL.$link2->getCollectionPath()?>"><i class="fa fa-angle-right"></i><?php echo $link2_text?></a>
            </li>
        <?php
        }
        if (isset($tel) && $tel!='')
        {
            ?>
            <li class="phone">
                <span><i class="fa fa-phone"></i><?php echo $tel?></span>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>