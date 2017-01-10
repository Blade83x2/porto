<?php
namespace Concrete\Package\Porto\Block\ContactUs;
use
    Core,
    Loader,
    \Concrete\Core\Block\BlockController;

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
	    $btTable                                  = 'PortoPackageContactUs',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "700",
	    $btInterfaceHeight                        = "610",
        $btCacheBlockRecord                       = true,
        $btCacheBlockOutput                       = true,
        $btCacheBlockOutputOnPost                 = true,
        $btCacheBlockOutputForRegisteredUsers     = true;

    private $elements = 'name,address,zipcodelocation,phone,fax,mobile,email,web';

    public function getBlockTypeDescription()
    {
        return t("Contact Us");
    }

    public function getBlockTypeName()
    {
        return t("Sortable Contact information");
    }

    public function getBlockTypeHelp()
    {
        $help = t("<b>Add Information about your Person/Business.</b><p>Value sorting with drag &amp; drop!</p>");
        return $help;
    }

    public function getSearchableContent()
    {
        return $this->textHeading.' '.$this->name.' '.$this->address.' '.$this->zipcodelocation.' '.$this->phone.' '.$this->mobile.' '.$this->fax.' '.$this->email.' '.$this->web;
    }

    public function on_start()
    {

    }

    public function add()
    {
        $this->set('displayOrder', $this->elements);
    }

    public function edit()
    {
        $this->view();
    }

    public function view()
    {
        $this->set('bID', $this->bID);
        $this->set('textHeading', $this->textHeading);
        $this->set('displayOrder', $this->displayOrder);
        $this->set('name', $this->name);
        $this->set('address', $this->address);
        $this->set('zipcodelocation', $this->zipcodelocation);
        $this->set('phone', $this->phone);
        $this->set('mobile', $this->mobile);
        $this->set('fax', $this->fax);
        $this->set('email', $this->email);
        $this->set('web', $this->web);
    }

    public function save($args)
    {
        if(!empty($args['textHeading']))
        {
            $args['textHeading'] = htmlspecialchars(trim($args['textHeading']), ENT_QUOTES);
        }
        $args['displayOrder'] = trim($args['displayOrder']);
        if(!empty($args['name']))
        {
            $args['name'] = trim($args['name']);
        }
        if(!empty($args['address']))
        {
            $args['address'] = trim($args['address']);
        }


        if(!empty($args['zipcodelocation']))
        {
            $args['zipcodelocation'] = trim($args['zipcodelocation']);
        }


        $args['phone'] = trim($args['phone']);
        $args['mobile'] = trim($args['mobile']);
        $args['fax'] = trim($args['fax']);
        $args['email'] = trim($args['email']);
        $args['web'] = trim($args['web']);
        parent::save($args);
    }

    public function validate($args)
    {
        $error = Core::make('helper/validation/error');
        if(!preg_match('/^[a-z,]+$/', $args['displayOrder']))
        {
            $error->add(t('Error').' '.t('in').' displayOrder '.t('Variable').'!');
        }
        if(!empty($args['name']) && !preg_match('/^[a-zA-Z0-9,.\-öäüßÖÄÜ ]+$/', $args['name']))
        {
            $error->add(t('Error').' '.t('in').' '.t('Name').' '.t('Variable. Allowed: a-zA-Z0-9öäüßÖÄÜ,.-'));
        }
        if(!empty($args['address']) && !preg_match('/^[a-zA-Z0-9,.\-öäüßÖÄÜ ]+$/', $args['address']))
        {
            $error->add(t('Error').' '.t('in').' '.t('Address').' '.t('Variable. Allowed: a-zA-Z0-9öäüßÖÄÜ,.-'));
        }
        if(!empty($args['zipcodelocation']) && !preg_match('/^[a-zA-Z0-9,.\-öäüßÖÄÜ ]+$/', $args['zipcodelocation']))
        {
            $error->add(t('Error').' '.t('in').' '.t('Zipcode & Location').' '.t('Variable. Allowed: a-zA-Z0-9öäüßÖÄÜ,.-'));
        }
        if(!empty($args['phone']) && !preg_match('/^[0-9\-\/\+ ]+$/', $args['phone']))
        {
            $error->add(t('Error').' '.t('in').' '.t('Phone').' '.t('Variable. Allowed: 0-9 -/+'));
        }
        if(!empty($args['mobile']) && !preg_match('/^[0-9\-\/\+ ]+$/', $args['mobile']))
        {
            $error->add(t('Error').' '.t('in').' '.t('Mobile').' '.t('Variable. Allowed: 0-9 -/+'));
        }
        if(!empty($args['fax']) && !preg_match('/^[0-9\-\/\+ ]+$/', $args['fax']))
        {
            $error->add(t('Error').' '.t('in').' '.t('Fax').' '.t('Variable. Allowed: 0-9 -/+'));
        }
        if (!empty($args['email']) && filter_var($args['email'], FILTER_VALIDATE_EMAIL) === false)
        {
            $error->add(t('Error').' '.t('in').' '.t('Email').'!');
        }
        if (!empty($args['web']) && filter_var($args['web'], FILTER_VALIDATE_URL) === false)
        {
            $error->add(t('Error').' '.t('in').' '.t('Web').'!');
        }
        $oneInUse = false;
        foreach(explode(',', $this->elements) as $element)
        {
            if (!empty($args[$element]))
            {
                $oneInUse = true;
                break;
            }
        }
        if($oneInUse === false && !$error->has())
        {
            $error->add(t('There is no field in use!'));
        }
        return $error;
    }
}
?>
