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


$apiCallUrl = $qrCodeServerUrl.'?datatype='.$datatype.'&data='.urlencode($data).'&title='.urlencode($title).'&errorCorrectionLevel='.$errorCorrectionLevel.'&size='.(int)$size.'&margin='.(int)$margin.'&getReturnType='.$getReturnType;

if (function_exists('file_get_contents'))
{
    try
    {


        if ($content = file_get_contents($apiCallUrl)) {
            echo '<img class="img-responsive img-rounded" alt="'.$title.'" title="'.$title.'" src="'.$content.'" />';
        }

    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
elseif (function_exists('curl'))
{

}


?>
