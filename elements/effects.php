<?php
namespace Concrete\Package\Porto\Elements;

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
=>  (c) ............... 2005-2016 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Coder:    $ Blade83
*/


# $effects = View::element($file, $args, $_pkgHandle);


class Effects
{

    public  function Effects($args)
    {
        #$a = $this->get('a');
        #echo 'route test fuer ajax anfragen'.$a;


        return $this;


    }


    public function checkHeaderDescriptionH1($input){
        return  $this;
    }

}


class effectloader
{
    private static $class = null;



    public static function getInstance()
    {
        if (null === self::$class)
        {
            self::$class = new self();
        }

        return self::$class;
    }

    public static function changeLocale($locale)
    {
        $class = self::getInstance();
        $class->setLocale($locale);
    }

    private function setLocale($locale)
    {
        // ...
    }
}








?>