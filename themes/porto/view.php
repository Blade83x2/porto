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
$db = Database::getActiveConnection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
if($error) { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                View::element('system_errors', array('error' => $error), 'porto');
                ?>
            </div>
        </div>
    </div>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo $innerContent?>
        </div>
    </div>
</div>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>