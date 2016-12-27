<?php defined('C5_EXECUTE') or die("Access Denied.");?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage()?>">
    <head>
        <?php
        View::element('header_required', array('pageTitle' => $pageTitle), 'porto');
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $view->getStyleSheet('default.less')?>" type='text/css'>
        <!--[if IE]><link rel="stylesheet" href="<?php echo $view->getThemePath()?>/css/ie.css"><![endif]-->
        <!--[if lte IE 8]>
            <script src="<?php echo $view->getThemePath()?>/vendor/respond/respond.js"></script>
            <script src="<?php echo $view->getThemePath()?>/vendor/excanvas/excanvas.js"></script>
        <![endif]-->
        <?php
        if ((isset($portoSetup['boxed_design']) && $portoSetup['boxed_design']==1) && (isset($portoSetup['background_image']) && (int)$portoSetup['background_image'] > 0))
        {
            if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['background_image']) ))
            {
                ?>
                <style>
                    body {
                        background-image: url("<?php echo \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['background_image'])?>");
                        <?php if (isset($portoSetup['background_fix']) && $portoSetup['background_fix']==1) echo 'background-attachment:fixed;';  ?>
                    }
                </style>
                <?php
            }
        }
        if ($c->isEditMode())
        {
            if(is_object($portoPackage = Package::getByHandle('porto')))
            {
                echo "<script type=\"text/javascript\"> var PORTO_VER = \"".$portoPackage->getPackageVersion()."\", COOKIE_NAME = \"".Config::get('concrete.session.name')."\"; </script>";
                unset($portoPackage);
            }
        }
        ?>
    </head>
    <body class="<?php if (isset($portoSetup['boxed_design']) && $portoSetup['boxed_design']==1) echo 'boxed'?><?php if ($c->isEditMode()) { ?> editmode<?php } ?>">
        <div class="<?php echo $c->getPageWrapperClass()?>">
            <div class="body">