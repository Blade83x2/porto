<?php
namespace Concrete\Package\Porto\Block\QrCode;
use
    \Concrete\Core\Block\BlockController,
    \FileSet,
    \UserInfo,
    \Core,
    \File;
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

=>  Coder:    $ Blade83
*/
class Controller extends BlockController
{
	protected
	    $btTable                                  = 'PortoPackageQrCode',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "850",
	    $btInterfaceHeight                        = "485",
        $btCacheBlockRecord                       = true, // Should be safe in most cases, this will lighten the load on your database.
        $btCacheBlockOutput                       = true, // Basically, when this option is set, the block will always load whatever was entered after the last "save". This is also generally safe to use. However, in situations where you are relying on visitor contribution or other dynamic content, the cached output will be wrong.
        $btCacheBlockOutputOnPost                 = true, // This option will cache a block, even when the page it is on is recieving a post request. So you would want this disabled for something that needs input to change, but you can set this to true for something that does not.
        $btCacheBlockOutputForRegisteredUsers     = true; // Unregistered users will never have complicated permissions that might influence what they can or can not see, so some things are cacheable for them, but not registered users. If your block has nothing to do with permissions, this can be true.

    private
        $qrCodeServerUrl                          = 'http://blade83.de/qrcode/';



    public
        $al = NULL,
        $ih = NULL;

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t("QR Code Image Generator");
    }

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t("QR Code Generator for Images");
    }

    /**
     * @return string
    */
    public function getBlockTypeHelp()
    {
        $help = '<p>'.t("Convert your Information to a QR Code Image. Change the Datatype value and you can see some examples.").'</p>'
            .'<p><b>'.t('QR Code content').':</b> '.t('Store your Information here! The QR Code scanner app will read this.').'</p>'
            .'<p><b>'.t('QR Code alt text').':</b> '.t('Alternative alt & title text for image. [optional]').'</p>'
            .'<p><b>'.t('Error Correction Level').':</b> '.t('This means the quality of the image.').'</p>'
            .'<p><b>'.t('Size').':</b> '.t('This change the image size.').'</p>'
            .'<p><b>'.t('Margin').':</b> '.t('This change the image margin.').'</p>';
        return $help;
    }

    /**
     * @return array
    */
    public function getJavaScriptStrings()
    {
        $ui = UserInfo::getByID(USER_SUPER_ID);
        return array(
            'datatext'          => t('Type your text message here'),
            'emailtext'         => 'mailto:'.(is_object($ui) ? (string)$ui->getUserEmail() : 'email@host.com'),
            'urltext'           => BASE_URL,
            'teltext'           => 'tel:+00491661234567',
            'smstext'           => 'smsto:+00491601234567:'.t('SMS Text'),
            'mmstext'           => 'mmsto:+00491601234567:'.t('MMS Text'),
            'contacttext'       => 'BEGIN:VCARD'."\n".'FN:'.t('Firstname').' '.t('Lastname')."\n".'TEL;HOME;VOICE: 06593123456'."\n".'TEL;WORK;VOICE: 0190666666'."\n".'EMAIL: '.(is_object($ui) ? (string)$ui->getUserEmail() : 'email@host.com')."\n".'ORG: My Company name'."\n".'END:VCARD'."\n"

        );
        // in javascriptcode alert( ccm_t('datatext') );
    }

    /**
     * @param string $outputContent
    */
    public function registerViewAssets($outputContent = '')
    {
        #$this->requireAsset('javascript','formigoSlider');
    }

    /**
     * @return string
    */
    public function getSearchableContent()
    {
        return $this->data.' - '.$this->title;
    }

    /**
     * @param void
     * @return void
    */
    public function on_start()
    {
        $this->set('qrCodeServerUrl', $this->qrCodeServerUrl);

        $this->form = Core::make('helper/form');
        $this->set('form', $this->form);

    }

    /**
     * @param void
     * @return void
    */
    public function add()
    {
        $this->set('getReturnType', 'imgpath');
    }

    /**
     * @param void
     * @return void
    */
    public function edit()
    {
	    $this->set('datatype', $this->datatype);
	    $this->set('data', $this->data);
	    $this->set('title', $this->title);
	    $this->set('errorCorrectionLevel', $this->errorCorrectionLevel);
	    $this->set('size', $this->size);
	    $this->set('margin', $this->margin);
	    $this->set('getReturnType', $this->getReturnType);
    }

    /**
     * @param void
     * @return void
    */
    public function view()
    {
        $this->set('datatype', $this->datatype);
        $this->set('data', $this->data);
        $this->set('title', $this->title);
        $this->set('errorCorrectionLevel', $this->errorCorrectionLevel);
        $this->set('size', $this->size);
        $this->set('margin', $this->margin);
        $this->set('getReturnType', $this->getReturnType);
    }

    /**
     * @param array $args
    */
    public function save($args)
    {
        $args['datatype']               = trim($args['datatype']);
        $args['text']                   = trim($args['text']);
        $args['data']                   = trim($args['data']);
        $args['title']                  = trim($args['title']);
        $args['errorCorrectionLevel']   = trim($args['errorCorrectionLevel']);
        $args['size']                   = (int)$args['size'];
        $args['margin']                 = (int)$args['margin'];
        $args['getReturnType']          = trim($args['getReturnType']);
        parent::save($args);
    }

    /**
     * @param $args
     * @return bool|\Concrete\Core\Error\Error
    */
    public function validate($args)
    {
        $error = Core::make('helper/validation/error');
        if($args['datatype'] != 'url' && $args['datatype'] != 'text' && $args['datatype'] != 'email' && $args['datatype'] != 'contact' && $args['datatype'] != 'sms' && $args['datatype'] != 'mms' && $args['datatype'] != 'map' && $args['datatype'] != 'tel')
        {
            $error->add(t('Datatype error!'));
        }

        if ($args['datatype'] == 'text') {
            if(empty($args['text']))
            {
                $error->add(t('QR Code text empty!'));
            }
        }



       # if(empty($args['data']))
       # {
       #     $error->add(t('QR Code content empty!'));
       # }
        if(!in_array($args['errorCorrectionLevel'], array('L','M','Q','H')))
        {
            $error->add(t('Error Correction Level fail!'));
        }
        if($args['size'] < 1 || $args['size'] > 10)
        {
            $error->add(t('Size only allowed between 1 and 10!'));
        }
        if($args['margin'] < 0 || $args['margin'] > 50)
        {
            $error->add(t('Margin only allowed between 0 and 50!'));
        }
        if(!in_array($args['getReturnType'], array('imgpath')))
        {
            $error->add(t('getReturnType fail!'));
        }
        return $error;
    }
}
?>