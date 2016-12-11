<?php
namespace Concrete\Package\Porto\Block\OnepageNavMarker;
use
    Concrete\Core\Page\Page,

    Core,
    PageList,
    \Concrete\Core\Support\Facade\Database,
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
class Controller extends BlockController
{
	protected
	    $btTable                                  = 'PortoPackageOnePageNavMarker',
        $btDefaultSet                             = 'porto',
	    $btInterfaceWidth                         = "700",
	    $btInterfaceHeight                        = "250",
        $btCacheBlockRecord                       = false,
        $btCacheBlockOutput                       = false,
        $btCacheBlockOutputOnPost                 = false,
        $btCacheBlockOutputForRegisteredUsers     = false;
        


    public function getBlockTypeDescription()
    {
        return t("Navigation Mapping for the OnePage Theme");
    }

    public function getBlockTypeName()
    {
        return t("OnePage Nav Marker");
    }

    public function getBlockTypeHelp()
    {
        $help = t("<b>Creates OnePage Navigation Links</b><p>1.) Create your Sitestructure with content in the Sitemap.<br><br>2.) Create a new Page and change the Page Theme to Porto OnePage on that Page.<br><br>3.) Add any instances from this Block into the new Page.</p>");
        return $help;
    }

    public function getJavaScriptStrings()
    {
        // in javascriptcode alert( ccm_t('image-required') );
        return array(
            // 'image-required' => t('You must select an image.'),
        );
    }

    public function getSearchableContent()
    {
        return $this->bID. ' '. $this->onPageID;

    }

    public function on_start()
    {
      #  $db = Database::getActiveConnection();
      #  $db->executeQuery("DELETE FROM PortoPackageOnePageNavMarker WHERE pID=? AND onPageID=?", array(0, $this->onPageID));
    }

    public function getUsedIDs()
    {

        $db = Database::getActiveConnection();
        $current = Page::getCurrentPage();
        $all = $db->fetchAll("SELECT
                              PortoPackageOnePageNavMarker.pID AS pID
                            FROM PortoPackageOnePageNavMarker  JOIN Blocks
                            ON (PortoPackageOnePageNavMarker.bID = Blocks.bID)
                            WHERE PortoPackageOnePageNavMarker.onPageID = ?
                            AND Blocks.bIsActive = 0", array($current->getCollectionID()));

        return $all;
    }

    public function isInUse($pageID)
    {
        foreach( $this->getUsedIDs() as $entry)
        {
            if ($entry['pID'] == $pageID)
            {
                return true;
            }
        }
        return false;
    }


    public function delete()
    {
	    #if ($this->bID > 0) {
        #     if ($this->btTable) {
        #      $ni = new BlockRecord($this->btTable);
        #      $ni->bID = $this->bID;
        #      $ni->Load('bID=' . $this->bID);
        #      $ni->delete();
        #      }
	    #}
	    parent::delete();
    }



    public function view()
    {
        $this->set('bID', $this->bID);
	    $this->set('pID', $this->pID);
    }

    public function edit()
    {
        $areas = unserialize($this->areas);
        if(count($areas)>0)
        {
            foreach($areas as $key => $val)
            {
                $this->set($key, $val);
            }
        }
    }

    public function add()
    {


    }

    public function save($args)
    {
        $args["areas"] = $args;
        unset($args["areas"]['submit'], $args["areas"]['ccm-edit-block-submit'], $args["areas"]['onPageID']);
        $args["areas"] = serialize($args["areas"]);
        parent::save($args);
    }

    public function validate($args)
    {
        $error = \Core::make('error');
        $newID = Page::getByID((int)$args['pID']);
        if(!is_object($newID))
        {
            $error->add(t('There is a Problem with the new Page'));
        }
        return $error;
    }
}
?>