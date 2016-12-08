<?php
defined('C5_EXECUTE') or die("Access Denied.");
/**>         ____  _           _       ___ _____
 *>          | __ )| | __ _  __| | ___ ( _ )___ /
 *>         |  _ \| |/ _` |/ _` |/ _ \/ _ \ |_ \
 *>        | |_) | | (_| | (_| |  __/ (_) |__) |
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
?>
<div class="container">
    <?php if(!empty($name)){?>
        <div class="row">
            <div class="col-md-12">
                <h4><?php echo $name?></h4>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <?php
        if (is_object($f = File::getByID($pictureID)))
        {
            echo '<div class="col-md-2">';
            $imgaeThumb = $ih->getThumbnail($f, 140, 0);
            echo '<img src="'.$imgaeThumb->src.'" alt="'.$f->getTitle().'" class="center-block img-responsive img-thumbnail img-rounded">';
            echo '</div>';
        }
        if(!empty($proTextDescription)) { ?>
            <div class="col-md-3">
                <b><i class="glyphicon glyphicon-thumbs-up"></i>
                    &nbsp;<?php echo $proTextDescription?> </b><br />
                <?php
                if($proText!='')
                {
                    $array = explode("\n", $proText);
                    echo "<ul>";
                    foreach($array as $row){
                        echo "<li>$row</li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        <?php } ?>
        <?php if(!empty($contraTextDescription)) { ?>
            <div class="col-md-3">
                <b><i class="glyphicon glyphicon-thumbs-down"></i>
                    &nbsp; <?php echo $contraTextDescription?> </b><br />
                <?php
                if($contraText!='')
                {
                    $array = explode("\n", $contraText);
                    echo "<ul>";
                    foreach($array as $row){
                        echo "<li>$row</li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php if(!empty($herkunft)) { ?>
            <div class="col-md-6">
                <blockquote>
                    <p>
                        <strong><?php echo t('Origin')?>:</strong> <?php echo $herkunft?>
                    </p>
                </blockquote>
            </div>
        <?php } ?>
        <?php if(!empty($zubereitung)) { ?>
            <div class="col-md-6">
                <blockquote>
                    <p>
                        <strong><?php echo t('Preparation')?>:</strong> <?php echo $zubereitung?>
                    </p>
                </blockquote>
            </div>
        <?php } ?>
        <?php if(!empty($anwendung)) { ?>
            <div class="col-md-6">
                <blockquote>
                    <p>
                        <strong><?php echo t('Practical use')?>:</strong> <?php echo $anwendung?>
                    </p>
                </blockquote>
            </div>
        <?php } ?>
        <?php if(!empty($anmerkung)) { ?>
            <div class="col-md-6">
                <blockquote>
                    <p>
                        <strong><?php echo t('Note')?>:</strong> <?php echo $anmerkung?>
                    </p>
                </blockquote>
            </div>
        <?php } ?>
    </div>
</div>