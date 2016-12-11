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
$formPageSelector = Core::make('helper/form/page_selector');
?>

<div class="form-group">
	<?php  echo $form->label('link1_text', t("Link 1 Name"));?>
	<?php  echo $form->text('link1_text', $link1_text);?>
</div>
<div class="form-group">
    <?php  echo $form->label('link1_page_id', t('Link 1 Page'));?>
    <?php  echo $formPageSelector->selectPage('link1_page_id',$link1_page_id); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('link2_text', t("Link 2 Name"));?>
    <?php  echo $form->text('link2_text', $link2_text);?>
</div>
<div class="form-group">
    <?php  echo $form->label('link2_page_id', t('Link 2 Page'));?>
    <?php  echo $formPageSelector->selectPage('link2_page_id',$link2_page_id); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('tel', t("Tel"));?>
    <?php  echo $form->text('tel', $tel);?>
</div>