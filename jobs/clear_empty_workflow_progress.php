<?php
namespace Concrete\Package\Porto\Job;
defined('C5_EXECUTE') or die(_("Access Denied."));
use
    Job,
    Concrete\Core\Workflow\Progress\PageProgress,
    Concrete\Core\Workflow\EmptyWorkflow;

/*>       ____  _           _       ___ _____
*>       | __ )| | __ _  __| | ___ ( _ )___ /
*>       |  _ \| |/ _` |/ _` |/ _ \/ _ \ |_ \
*>       | |_) | | (_| | (_| |  __/ (_) |__) |
*>       |____/|_|\__,_|\__,_|\___|\___/____/
*>
**  - - - - - - - - - - - - - - - - - - - - - - - +
=>  Web ......... http://cplusplus-development.de |
=>  Mail ........................ mail@blade83.de |
=>  (c) ............... 2005-2015 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Filename: controller.php
=>  Filetime: 00:08 - 16.12.14
=>  Coder:    $ Blade83
*/

class ClearEmptyWorkflowProgress extends Job
{

    public function getJobName()
    {
        return t("Clear Empty Workflow Progress");
    }

    public function getJobDescription()
    {
        return t("Deletes empty \"Compare Versions\" alert.");
    }

    public function run()
    {
        // retrieve all pending page workflow progresses
        $list = PageProgress::getPendingWorkflowProgressList();
        $r = $list->get();
        foreach ($r as $w) {
            $wp = $w->getWorkflowProgressObject();
            $wo = $wp->getWorkflowObject();
            if ($wo instanceof EmptyWorkflow) {
                $wp->delete();
            }
        }
    }
}