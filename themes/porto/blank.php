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
$db = \Database::connection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
?>
<div class="container">
    <?php
    $a = new \Concrete\Core\Area\Area('Main');
    $a->setAreaGridMaximumColumns(12);
    $a->display($c);
    ?>
</div>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>