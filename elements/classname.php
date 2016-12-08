<?php
namespace Concrete\Package\Porto\Elements;
use PageTemplate;
use
    Concrete\Core\Page\Page,
    Controller,
    Redirect;

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
=>  (c) ............... 2005-2015 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Coder:    $ Blade83
*/





class Classname extends Controller
{
    public function method()
    {
        #$a = $this->get('a');
        #echo 'route test fuer ajax anfragen'.$a;

        $page = \Concrete\Core\Page\Page::getByID(1);
        echo '<pre>';
        print_r($page);
        echo '</pre>';


        # nach der installation
        $pt = PageTemplate::getByID($page->getPageTemplateID());
        echo '<pre>';
        print_r($pt);
        echo '</pre>';





        echo '<pre>';
        print_r($page->getCollectionThemeObject());
        echo '</pre>';







# $page = Page::getByID(HOME_CID);
       # Redirect::page($page)->send();


    }
}



?>