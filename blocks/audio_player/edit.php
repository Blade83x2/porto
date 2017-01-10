<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
use Concrete\Core\File\Set;
use Concrete\Core\File\Type\Type as FileType;
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
?>
<div class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-md-3 col-sm-12 control-label"><?php echo t('Album Name')?></label>
        <div class="col-md-9 col-sm-12">
            <?php
            echo $form->text('name', $name, array('class' => 'form-control', 'placeholder'=>t('Name for Album Name')));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-md-3 col-sm-12 control-label"><?php echo t('Album description')?></label>
        <div class="col-md-9 col-sm-12">
            <?php
	        echo $editor->outputStandardEditor('description', $description);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-md-3 col-sm-12 control-label"><?php echo t('Album Image')?></label>
        <div class="col-md-9 col-sm-12">
            <?php echo $al->image('picture', 'picture', t('Select Album Image'), $picture); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="filesetid" class="col-md-3 col-sm-12 control-label"><?php echo t('MP3 File Set')?></label>
        <div class="col-md-9 col-sm-12">
            <select name="filesetid" id="filesetid" class="form-control">
                <option value="">&nbsp;</option>
                <?php
                $filesets = FileSet::getMySets();
                foreach ($filesets as $fset)
                {
                    $fileList = new FileList();
                    $fileList->filterBySet(FileSet::getByID($fset->getFileSetId()));
                    $fileList->filterByType(FileType::T_AUDIO);
                    $fileList->filterByExtension('mp3');
                    if ($controller->getFileSetID() == $fset->getFileSetId())
                    {
                        $select = 'selected="selected"';
                    }
                    else
                    {
                        $select = '';
                    }
                    echo "<option ".$select." value=\"" . $fset->getFileSetId() . "\">" . $fset->getFileSetName()." (".count($fileList->get())." ". ( (count($fileList->get())==1 ) ? t('File') : t('Files') ).")</option>";
                }
                ?>
            </select>
        </div>
    </div>
</div>