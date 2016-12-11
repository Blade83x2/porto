<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
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
?>
<script>
    $(document).ready(function()
    {
        var fixHelperModified = function(e, tr)
        {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };
        $("#diagnosis_list tbody").sortable({
            helper: fixHelperModified,
            stop: function(event,ui) {
                renumber_table('#diagnosis_list');
                reload_display_order('#diagnosis_list', '.fieldname')
            }
        }).disableSelection();
    });

    function renumber_table(tableID)
    {
        $(tableID + " tr").each(function()
        {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').html('<i class="fa fa-arrows"></i> '+count);
        });
    }

    function reload_display_order(tableID, fieldname)
    {
        var newDisplayOrder = [];
        $(tableID + " tr").each(function()
        {
            newDisplayOrder.push($(this).find(fieldname).text().toLowerCase());
        });
        newDisplayOrder.splice(0, 1);
        $("#displayOrder").val(newDisplayOrder.join(","));
        delete newDisplayOrder;
    }
</script>
<style>
td .priority { cursor:pointer; }
.ui-sortable tr:hover { background:rgba(244,251,17,0.08); }
</style>
<input type="hidden" name="displayOrder" id="displayOrder" value="<?php echo $displayOrder ?>" />
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <td class='col-md-4'><label for="textHeading" class="control-label"><?php echo t('Block heading Text')?></label></td>
                <td class='col-md-8'><input type="text" class="form-control" id="textHeading" name="textHeading" value="<?php if(isset($textHeading)){ echo $textHeading; } ?>" /></td>
            </tr>
        </thead>
    </table>
</div>
<?php
function getTr($nameId, $sort, $tText, $val)
{
    $tr = '<tr>';
    $tr .= '    <td class="priority col-md-1"><i class="fa fa-arrows"></i> '.$sort.'</td>';
    $tr .= '    <td class="col-md-3"><label for="'.$nameId.'" class="control-label">'.t(preg_replace('/Zipcodelocation/', 'Zipcode, Location', $tText)).'</label><span class="fieldname" style="display: none;">'.$tText.'</span></td>';
    $tr .= '    <td class="col-md-8"><input type="text" class="form-control" id="'.$nameId.'" name="'.$nameId.'" value="'.(($val=='0')?'':$val).'" /></td>';
    $tr .= '</tr>';
    return $tr;
}
?>
<div class="table-responsive">
    <table class="table table-striped" id="diagnosis_list">
        <thead>
            <tr>
                <th><?php echo t('#ID')?></th>
                <th><?php echo t('Field Name')?></th>
                <th><?php echo t('Field Value')?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $displayOrder = explode(',', $displayOrder);
            for($k=0; $k<count($displayOrder); $k++)
            {
                echo getTr($displayOrder[$k], ($k+1), ucfirst($displayOrder[$k]), ${$displayOrder[$k]});
            }
            ?>
        </tbody>
    </table>
</div>