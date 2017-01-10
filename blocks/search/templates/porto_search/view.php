<?php defined('C5_EXECUTE') or die("Access Denied.");
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
if (isset($error))
{
    echo '
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>'. t('Error').':</strong>
        <p>'. $error .'</p>
    </div>';
}
?>


<form action="<?php echo $view->url( $resultTargetURL )?>" method="get" id="searchForm">
    <?php
    if(strlen($query)==0)
    {
        echo '<input name="search_paths[]" type="hidden" value="'. htmlentities($baseSearchPath, ENT_COMPAT, APP_CHARSET) .'" />';
    }
    else if (is_array($_REQUEST['search_paths']))
    {
        foreach($_REQUEST['search_paths'] as $search_path)
        {
            echo '<input name="search_paths[]" type="hidden" value="'. htmlentities($search_path, ENT_COMPAT, APP_CHARSET).'" />';
        }
    }
    ?>
    <div class="form-group">
        <div class="input-group input-group-lg">
            <span class="input-group-addon hidden-xs">
                <?php echo (strlen($title)>0) ? $title : t('Search'); ?>
            </span>
            <input name="query" id="query" type="text" value="<?php echo htmlentities($query, ENT_COMPAT, APP_CHARSET)?>" class="form-control" autocomplete="off" required />
            <span class="input-group-addon">
                 <i class="fa fa-search" style="cursor: pointer;" onclick="$('#searchForm').submit();" title="<?php if($buttonText) {  echo $buttonText; } else { echo t('Search'); }?>"></i>
            </span>
        </div>
    </div>

    <?php if ($do_search) { ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="2">
                            <?php
                            echo t('Results');
                            if (is_object($pagination) && method_exists($pagination, 'getCurrentPage'))
                            {
                                if ($pagination->getTotalPages() > 1)
                                {
                                    echo '&nbsp;('.t('Page'). '&nbsp;'.$pagination->getCurrentPage().'&nbsp;'.t('of').'&nbsp;'.$pagination->getTotalPages().')';
                                }
                            }
                            ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(count($results)==0)
                    {
                        echo '<tr class="danger text-center"><td colspan="2">'.t('There were no results found. Please try another keyword or phrase.').'</td></tr>';
                    }
                    else
                    {
                        $tt = Core::make('helper/text');
                        if (is_object($pagination) && method_exists($pagination, 'getCurrentPage'))
                        {
                            $count = (($pagination->getCurrentPage() * 10) - 10) + 1;
                        }
                        else
                        {
                            $count = 1;
                        }
                        foreach($results as $r)
                        {
                            ?>
                            <tr>
                                <td>
                                    <div style="float:left;">
                                        <a href="<?php echo $r->getCollectionLink()?>">#<?php echo $count?></a>
                                    </div>
                                    <div style="float:left; margin-left: 10px;">
                                        <div id="accordion<?php echo $count?>">
                                            <div class="panel-default">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?php echo $count?>" href="#collapse<?php echo $count?>">
                                                        <?php echo $r->getCollectionName()?>
                                                    </a>
                                                </h4>
                                                <div id="collapse<?php echo $count?>" class="accordion-body collapse">
                                                    <div class="panel-body">
                                                        <?php
                                                        if ($r->getCollectionDescription())
                                                        {
                                                            echo $this->controller->highlightedMarkup($tt->shortText($r->getCollectionDescription()), $query).'<br />';
                                                        }
                                                        echo '<a href="'.$r->getCollectionLink().'">'.$this->controller->highlightedMarkup($r->getCollectionLink(), $query).'</a>';
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear:left;"></div>
                                </td>
                                <td class="text-right"><a href="<?php echo $r->getCollectionLink()?>"><i class="fa fa-mail-forward"></i></a></td>
                            </tr>
                            <?php
                            $count++;
                        }
                    }
                    ?>
                </tbody>
                <?php
                $pages = $pagination->getCurrentPageResults();
                if ($pagination->getTotalPages() > 1 && $pagination->haveToPaginate())
                {
                    $showPagination = true;
                    echo '<tfoot><tr><td colspan="2" class="text-center">'.$pagination->renderDefaultView().'</td></tr></tfoot>';
                }
                ?>
            </table>
        </div>
    <?php } ?>
</form>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#query').keypress(function (e)
        {
            if (e.which == 13)
            {
                $('form#searchForm').submit();
            }
        });
        var SearchInput = $('#query');
        var strLength = SearchInput.val().length * 2;
        SearchInput.focus();
        SearchInput[0].setSelectionRange(strLength, strLength);
    });
</script>