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
if (count($navItems=$controller->getNavItems()) > 0)
{
    echo '<ul class="sitemap list icons">';
    foreach ($navItems as $ni)
    {
        echo '<li>';
        echo '<i class="fa fa-caret-right"></i>';
        echo '<a href="' . $ni->url . '" target="' . $ni->target . '">' . t($ni->name) . '</a>';
        if ($ni->hasSubmenu)
        {
            echo '<ul class="list icons">';
        }
        else
        {
            echo '</li>';
            echo str_repeat('</ul></li>', $ni->subDepth);
        }
    }
    echo '</ul>';
}
?>