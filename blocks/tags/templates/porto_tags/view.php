<?php
use Concrete\Attribute\Select\OptionList;
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
if ($options instanceof OptionList && $options->count() > 0): ?>
    <p>
        <?php if ($title): ?>
            <h5><?php echo $title?></h5>
        <?php endif; ?>
        <?php foreach($options as $option) { ?>
            <?php if ($target) { ?>
                <a href="<?php echo $controller->getTagLink($option) ?>"><span class="label label-dark"><?php echo $option->getSelectAttributeOptionValue()?></span></a>
            <?php } else { ?>
                <a href="#" style="text-decoration: none"><span class="label label-dark"><?php echo $option->getSelectAttributeOptionValue()?></span></a>
            <?php } ?>
        <?php } ?>
    </p>
<?php endif; ?>