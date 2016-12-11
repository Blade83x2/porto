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
?>
<ul class="social-icons">
    <?php
    foreach($links as $link)
    {
        $service = $link->getServiceObject();
        # TODO ausgeschlossene haben noch keine grafik
        if($link->getServiceHandle()!='vine' &&  $link->getServiceHandle()!='steam' && $link->getServiceHandle()!='soundcloud' && $link->getServiceHandle()!='personal_website')
        {
            echo '<li class="'.$link->getServiceHandle().'"><a href="'.$link->getURL().'" target="_blank" title="'.$link->getServiceHandle().'">'.$link->getServiceHandle().'</a></li>';
        }
    }
    ?>
</ul>