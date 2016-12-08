<?php defined('C5_EXECUTE') or die("Access Denied.")?>
<header id="header" class="clean-top" data-sticky-header-margin-top="-110">
    <div class="header-top">
        <div class="container">
            <p><?php
                $output = array();
                if ($portoSetup['footer_ribbon'] != '')
                {
                    array_push($output, htmlentities($portoSetup['footer_ribbon'], ENT_QUOTES, APP_CHARSET));
                }
                if ($portoSetup['email'] != '')
                {
                    $em = explode('@', $portoSetup['email']);
                    array_push($output, '<span><i class="fa fa-envelope"></i> <a onclick="this.href=\'mai\'+\'lto:'.$em[0].'\'+\'@\'+\''.$em[1].'\';" href="" style="unicode-bidi:bidi-override; direction: rtl;">'.strrev(htmlentities($portoSetup['email'], ENT_QUOTES, APP_CHARSET)).'</a></span>');
                }
                if(count($output) > 0)
                {
                    echo implode(' | ', $output);
                }
                ?>
            </p>
            <?php
            if (!is_object($c)) $c = \Concrete\Core\Page\Page::getCurrentPage();
            if ($portoSetup['searchpage_id'] > 0 && $c->cID != $portoSetup['searchpage_id'])
            {
                if (is_object($searchPage=\Concrete\Core\Page\Page::getByID($portoSetup['searchpage_id'])))
                {
                    ?>
                    <div class="search">
                        <form id="searchForm" action="<?php echo DIR_REL.$searchPage->getCollectionPath()?>" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control search" name="query" id="query" value="<?php if($controller->get('query')!='') echo $controller->get('query')?>" placeholder="<?php if(isset($portoSetup['searchpage_text'])) echo $portoSetup['searchpage_text']?>" autocomplete="off" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <?php
                    unset ($searchPage);
                }
            }
            ?>
        </div>
    </div>
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
            $a = new \Concrete\Core\Area\GlobalArea('Header Navigation');
            $a->display();
            ?>
        </div>
    </div>
</header>
<?php if($portoSetup['searchpage_empty_query']!='' && $portoSetup['searchpage_id'] > 0){ ?>
    <script>
        $(document).ready(function()
        {
            $('#query').keypress(function (e)
            {
                if (e.which == 13)
                {
                    if($("#query").val()=='')
                    {
                        $('#modalBoxSmallLabel').text('<?php echo t($portoSetup['searchpage_text'])?>');
                        $('#modalBoxSmallBody').text('<?php echo t($portoSetup['searchpage_empty_query'])?>');
                        $('#modalBoxSmall').modal({ show: true, keyboard: true });
                    }
                }
            });
        });
    </script>
<?php } ?>