<?php
namespace Concrete\Package\Porto\Block\CalculateRoute;
use
    Core,
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
=>  Project:  Porto
=>  Coder:    $ Blade83
*/

/**
 * Class Controller
 * @package Concrete\Package\Porto\Block\CalculateRoute
 */
class Controller extends BlockController
{
	protected
	    $btTable                                  = 'PortoPackageCalculateRoute',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "700",
	    $btInterfaceHeight                        = "360",
        $btCacheBlockRecord                       = true,
        $btCacheBlockOutput                       = true,
        $btCacheBlockOutputOnPost                 = true,
        $btCacheBlockOutputForRegisteredUsers     = true;

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t("Calculate a Route");
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t("Calculate Route");
    }

    /**
     * @return string
     */
    public function getSearchableContent()
    {
        return $this->buttonText.' - '.$this->textHeading;
    }

    /**
     * @return string
     */
    public function getBlockTypeHelp()
    {
        $help = t("<b>Add a route planner.</b><p>Select a Service Provider and set a target Address and your Visitors can type in an Address and get a Route to you!</p>");
        return $help;
    }


    /**
     * @param void
     */
    public function on_start()
    {

    }

    /**
     * @param void
     */
    public function view()
    {
        $this->set('bID', $this->bID);
        $this->set('textHeading', $this->textHeading);
        $this->set('startPlaceholder', $this->startPlaceholder);
        $this->set('buttonWidth', $this->buttonWidth);
        $this->set('serviceProvider', $this->serviceProvider);
        $this->set('target', $this->target);
        $this->set('buttonText', $this->buttonText);

    }

    /**
     * @param array $args
     */
    public function save($args)
    {
        $args['textHeading'] = trim($args['textHeading']);
        $args['startPlaceholder'] = trim($args['startPlaceholder']);
        $args['buttonWidth'] = $args['buttonWidth'];
        $args['serviceProvider'] = trim($args['serviceProvider']);
        $args['target'] = trim($args['target']);
        $args['buttonText'] = trim($args['buttonText']);
        parent::save($args);
    }

    /**
     * @param $args
     * @return bool|\Concrete\Core\Error\Error
     */
    public function validate($args)
    {
        $error = Core::make('helper/validation/error');
        if($args['serviceProvider']=='none')
        {
            $error->add(t('Error').' '.t('in').' '.t('Service Provider').'!');
        }
        if(trim($args['target'])=='')
        {
            $error->add(t('Empty').' '.t('field in').' '.t('Target Address').'!');
        }
        else{
            $target = explode(",", $args['target']);
            if (count($target)!=3)
            {
                $error->add(t('Wrong').' '.t('Target Address').'!'.' '.t('Example').': Augustiner&nbsp;Str.&nbsp;6,&nbsp;54576,&nbsp;Hillesheim');
            }
        }
        if(trim($args['buttonText'])=='')
        {
            $error->add(t('Error').' '.t('in').' '.t('Button Text').'!');
        }
        return $error;
    }
}
?>
