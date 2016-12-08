<?php defined('C5_EXECUTE') or die("Access Denied.")?>
<header id="header" class="flat-menu single-menu" data-sticky-header-margin-top="0">
    <div class="container">
        <?php
        if($portoSetup['stickymenu_active']==1)
        {
            if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['second_stickymenu_gfx']) ))
            {
                echo '<div class="logo">';
                echo '  <a href="'.BASE_URL.'">';
                echo '    <img alt="" class="img-responsive" data-sticky-top="'.$portoSetup['second_stickymenu_gfx_top'].'" width="'.$portoSetup['second_stickymenu_gfx_x'].'" height="'.$portoSetup['second_stickymenu_gfx_y'].'" data-sticky-width="'.$portoSetup['second_stickymenu_gfx_x'].'" data-sticky-height="'.$portoSetup['second_stickymenu_gfx_y'].'" src="'. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['second_stickymenu_gfx']).'">';
                echo '  </a>';
                echo '</div>';
            }
        }
        elseif ($portoSetup['stickymenu_active']==0)
        {
            if (is_object( \Concrete\Core\File\File::getByID((int)$portoSetup['page_logo']) ))
            {
                echo '<div class="logo">';
                echo '  <a href="'.BASE_URL.'">';
                echo '    <img alt="" class="img-responsive" data-sticky-top="'.$portoSetup['second_stickymenu_gfx_top'].'" width="'.$portoSetup['page_logo_x'].'" height="'.$portoSetup['page_logo_y'].'" data-sticky-width="'.$portoSetup['second_stickymenu_gfx_x'].'" data-sticky-height="'.$portoSetup['second_stickymenu_gfx_y'].'" src="'. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['page_logo']).'">';
                echo '  </a>';
                echo '</div>';
            }
        }
        elseif ($portoSetup['stickymenu_active']==2)
        {
            if (is_object($f1=\Concrete\Core\File\File::getByID((int)$portoSetup['page_logo'])) && is_object($f2=\Concrete\Core\File\File::getByID((int)$portoSetup['second_stickymenu_gfx'])))
            {
                echo '<div class="logo">';
                echo '  <a href="'.BASE_URL.'">';
                echo '    <img alt="" class="img-responsive" data-sticky-top="'.$portoSetup['second_stickymenu_gfx_top'].'" width="'.$portoSetup['page_logo_x'].'" height="'.$portoSetup['page_logo_y'].'" data-sticky-width="'.$portoSetup['second_stickymenu_gfx_x'].'" data-sticky-height="'.$portoSetup['second_stickymenu_gfx_y'].'" src="'. \Concrete\Core\File\File::getRelativePathFromID((int)$portoSetup['page_logo']).'">';
                echo '  </a>';
                echo '</div>';
            }
        }
        ?>
        <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="navbar-collapse nav-main-collapse collapse">
        <div class="container">
            <?php
            $a = new \Concrete\Core\Area\GlobalArea('Header Social');
            $a->display();
            ?>
            <?php
            $a = new \Concrete\Core\Area\GlobalArea('Header Navigation');
            $a->display();
            ?>
        </div>
    </div>
</header>