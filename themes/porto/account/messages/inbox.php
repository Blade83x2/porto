<?php
defined('C5_EXECUTE') or die("Access Denied.");
$db = Database::getActiveConnection();
$portoSetup = $db->getRow('SELECT * FROM PortoPackage WHERE cID=?', array(1));
$this->inc('inc/header.php', array('portoSetup' => $portoSetup));
$this->inc('inc/headerTypes/'.$portoSetup['header_type'].'.php', array('portoSetup' => $portoSetup));
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $a = new \Concrete\Core\Area\Area('Main');
            $a->display($c);
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-10 col-md-offset-1">
            <?php switch($this->controller->getTask()) {
                case 'view_message': ?>

                    <?php echo Core::make('helper/concrete/ui')->tabs(array(
                        array($view->action('view_mailbox', 'inbox'), t('Inbox'), $box == 'inbox'),
                        array($view->action('view_mailbox', 'sent'), t('Sent'), $box == 'sent')
                    ), false)?>

                    <div id="ccm-private-message-detail">
                        <div id="ccm-private-message-actions">
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <a href="<?php echo $backURL?>" class="btn btn-small"><i class="icon-arrow-left"></i> <?php echo t('Back')?></a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="icon-cog"></i> <?php echo t('Action')?>
                                        &nbsp;
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php $u = new User(); ?>
                                        <?php if ($msg->getMessageAuthorID() != $u->getUserID()) { ?>
                                            <?php
                                            $mui = $msg->getMessageRelevantUserObject();
                                            if (is_object($mui)) {
                                                if ($mui->getUserProfilePrivateMessagesEnabled()) { ?>
                                                    <li><a href="<?php echo $view->action('reply', $box, $msg->getMessageID())?>"><?php echo t('Reply')?></a>
                                                    <li class="divider"></li>
                                                <?php }
                                            }?>
                                        <?php } ?>
                                        <li><a href="javascript:void(0)" onclick="if(confirm('<?php echo t('Delete this message?')?>')) { window.location.href='<?php echo $deleteURL?>'}; return false"><?php echo t('Delete')?></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="media">
                            <a class="pull-left" href="<?php echo URL::to('/members/profile/view/'.$msg->uID)?>">
                                <?php
                                $ui = UserInfo::getByID($msg->uID);
                                if ($ui->hasAvatar() == true) {
                                    $av = '<img class="media-object" style="width:20px;" src="'.BASE_URL.DIR_REL.'/application/files/avatars/'.$ui->getUserID().'.jpg'.'" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                    echo $av;
                                }
                                else
                                {
                                    switch($ui->getAttribute('gender')){
                                        case 'male':
                                            echo '<img class="media-object" style="width:20px;" src="'.$view->getThemePath().'/img/avatar_male.png" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                            break;
                                        case 'female':
                                            echo '<img class="media-object" style="width:20px;" src="'.$view->getThemePath().'/img/avatar_female.png" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                            break;
                                        default:
                                            echo '<img class="media-object" style="width:20px;" src="'.$view->getThemePath().'/img/avatar_none.jpg" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                            break;
                                    }
                                }
                                ?>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <strong><?php echo $subject?></strong>
                                    <time><?php echo $dateAdded?></time>
                                </h4>
                                <?php echo $msg->getFormattedMessageBody()?>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
                case 'view_mailbox': ?>

                    <a href="<?php echo URL::to('/account')?>" class="btn btn-default pull-right" /><?php echo t('Back to Account')?></a>
                    <?php echo Core::make('helper/concrete/ui')->tabs(array(
                        array($view->action('view_mailbox', 'inbox'), t('Inbox'), $mailbox == 'inbox'),
                        array($view->action('view_mailbox', 'sent'), t('Sent'), $mailbox == 'sent')
                    ), false)?>
                    <fieldset>

                    <div class="row hidden-xs" style="margin-top: 10px;">
                        <div class="col-md-1">
                            <strong>
                                <?php
                                if ($mailbox == 'sent') {
                                    echo t('To');
                                }
                                else
                                {
                                    echo t('From');
                                }
                                ?>
                            </strong>
                        </div>
                        <div class="col-md-8">
                            <strong><?php echo t('Subject')?></strong>
                        </div>
                        <div class="col-md-2">
                            <strong><?php echo t('Sent At')?></strong>
                        </div>
                        <div class="col-md-1">
                            <strong><?php echo t('Status')?></strong>
                        </div>
                    </div>
                    </fieldset>



                    <?php
                    if (is_array($messages)) {
                        foreach($messages as $msg)
                        { ?>
                            <div class="row">
                                <div class="col-md-1">
                                    <a class="pull-left" href="<?php echo URL::to('/members/profile/view/'.$msg->uID)?>">
                                        <?php
                                        $ui = UserInfo::getByID($msg->uID);
                                        if ($ui->hasAvatar() == true) {
                                            $av = '<img class="media-object" style="width:20px;" src="'.BASE_URL.DIR_REL.'/application/files/avatars/'.$ui->getUserID().'.jpg'.'" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                            echo $av;
                                        }
                                        else
                                        {
                                            switch($ui->getAttribute('gender')){
                                                case 'male':
                                                    echo '<img class="media-object" style="width:20px;" src="'.$view->getThemePath().'/img/avatar_male.png" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                                    break;
                                                case 'female':
                                                    echo '<img class="media-object" style="width:20px;" src="'.$view->getThemePath().'/img/avatar_female.png" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                                    break;
                                                default:
                                                    echo '<img class="media-object" style="width:20px;" src="'.$view->getThemePath().'/img/avatar_none.jpg" alt="'.$ui->getUserName().'" title="'.$ui->getUserName().'" />';
                                                    break;
                                            }
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <a title="<?php echo $msg->getMessageRelevantUserName()?>" href="<?php echo $view->url('/account/messages/inbox', 'view_message', $mailbox, $msg->getMessageID())?>"><?php echo $msg->getFormattedMessageSubject()?></a>
                                </div>
                                <div class="col-md-2">
                                    <?php echo $dh->formatDateTime($msg->getMessageDateAdded(), true)?>
                                </div>
                                <div class="col-md-1">
                                    <?php echo $msg->getMessageStatus()?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo t('No messages found.')?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php $messageList->displayPaging(); ?>
                        </div>
                    </div>
                    <?php





                    break;
                case 'reply_complete': ?>

                    <div class="alert alert-success"><?php echo t('Reply Sent.')?></div>
                    <a href="<?php echo $view->url('/account/messages/inbox', 'view_message', $box, $msgID)?>" class="btn btn-default"><?php echo t('Back to Message')?></a>

                    <?php
                    break;
                case 'send_complete': ?>

                    <div class="alert alert-success"><?php echo t('Message Sent.')?></div>
                    <a href="<?php echo $view->url('/members/profile', 'view', $recipient->getUserID())?>" class="btn btn-default"><?php echo t('Back to Profile')?></a>

                    <?php
                    break;
                case 'over_limit': ?>
                    <h2><?php echo t('Woops!')?></h2>
                    <p><?php echo t("You've sent more messages than we can handle just now, that last one didn't go out.
                            We've notified an administrator to check into this.
                            Please wait a few minutes before sending a new message."); ?></p>
                    <?php break;
                case 'send':
                case 'reply':
                case 'write': ?>

                    <div id="ccm-profile-message-compose">
                        <form method="post" action="<?php echo $view->action('send')?>">

                            <?php echo $form->hidden("uID", $recipient->getUserID())?>
                            <?php if ($this->controller->getTask() == 'reply') { ?>
                                <?php echo $form->hidden("msgID", $msgID)?>
                                <?php echo $form->hidden("box", $box)?>
                                <?php
                                $subject = t('Re: %s', $text->entities($msgSubject));
                            } else {
                                $subject = $text->entities($msgSubject);
                            }
                            ?>

                            

                            <div class="form-group">
                                <label class="control-label"><?php echo t("To")?></label>
                                <input disabled="disabled" class="form-control" type="text" value="<?php echo $recipient->getUserName()?>" />
                            </div>

                            <div class="form-group">
                                <?php echo $form->label('subject', t('Subject'))?>
                                <?php echo $form->text('msgSubject', $subject, array('class' => 'span5'))?>
                            </div>

                            <div class="form-group">
                                <?php echo $form->label('body', t('Message'))?>
                                <?php echo $form->textarea('msgBody', $msgBody, array('rows'=>8, 'class' => 'span5'))?>
                            </div>
                            <?php echo $form->submit('button_submit', t('Send Message'), array('class' => 'pull-right btn btn-primary'))?>
                            <?php echo $form->submit('button_cancel', t('Cancel'), array('class' => 'btn-default', 'onclick' => 'window.location.href=\'' . $backURL . '\'; return false'))?>
                            <?php echo $valt->output('validate_send_message');?>
                        </form>
                    </div>
                    <?php break;

                default:
                    ?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="row" style="margin-top: 30px;">
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title text-center"><a href="<?php echo $view->action('view_mailbox', 'inbox')?>"><?php echo t('Inbox')?> </a><span class="badge"><?php echo $inbox->getTotalMessages()?></span></h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php
                                                $msg = $inbox->getLastMessageObject();
                                                if (is_object($msg)) {
                                                    print t('<strong>%s</strong>, sent by %s on %s', $msg->getFormattedMessageSubject(), $msg->getMessageAuthorName(), $dh->formatDateTime($msg->getMessageDateAdded(), true));
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title text-center"><a href="<?php echo $view->action('view_mailbox', 'sent')?>"><?php echo t('Sent Messages')?></a> </a><span class="badge"><?php echo $sent->getTotalMessages()?></span></h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php
                                                $msg = $sent->getLastMessageObject();
                                                if (is_object($msg)) {
                                                    print t('<strong>%s</strong>, sent by %s on %s', $msg->getFormattedMessageSubject(), $msg->getMessageAuthorName(), $dh->formatDateTime($msg->getMessageDateAdded(), true));
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                break;
            } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $a = new \Concrete\Core\Area\Area('Main 2');
            $a->display($c);
            ?>
        </div>
    </div>
</div>
<?php $this->inc('inc/footerTypes/'.$portoSetup['footer_type'].'.php', array('portoSetup' => $portoSetup))?>
<?php $this->inc('inc/footer.php', array('portoSetup' => $portoSetup))?>