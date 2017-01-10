<?php
defined('C5_EXECUTE') or die("Access Denied.");
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
$data = explode(',', $displayOrder);
$li = [];
$first = true;
for($k=0; $k<count($data); $k++)
{
    if(strlen(${$data[$k]}) < 1)
    {
        continue;
    }
    switch ( $data[$k] )
    {
        case 'name':
            $li[] = '<li><i class="fa fa-user'.(($first)?' fa-2x':'').'"></i> '.(($first)?'<span class="lead"><strong>':'').''.${$data[$k]}.''.(($first)?'</strong></span>':'').'</li>';
            break;

        case 'web':
            $li[] = '<li><i class="fa fa-home'.(($first)?' fa-2x':'').'"></i> <a href="'.${$data[$k]}.'" target="_blank">'.(($first)?'<span class="lead">':'').${$data[$k]}.''.(($first)?' </span>':'').'</a></li>';
            break;

        case 'phone':
            $li[] = '<li><i class="fa fa-phone'.(($first)?' fa-2x':'').'"></i> '.(($first)?' <span class="lead">':'').''.${$data[$k]}.''.(($first)?' </span>':'').'</li>';
            break;

        case 'mobile':
            $li[] = '<li><i class="fa fa-tablet'.(($first)?' fa-2x':'').'"></i>&nbsp;&nbsp;'.(($first)?' <span class="lead">':'').''.${$data[$k]}.''.(($first)?' </span>':'').'</li>';
            break;

        case 'fax':
            $li[] = '<li><i class="fa fa-fax'.(($first)?' fa-2x':'').'"></i> '.(($first)?' <span class="lead">':'').''.${$data[$k]}.''.(($first)?' </span>':'').'</li>';
            break;

        case 'address':
            $li[] = '<li><i class="fa fa-map-marker'.(($first)?' fa-2x':'').'"></i>&nbsp;&nbsp;'.(($first)?' <span class="lead">':'').''.${$data[$k]}.''.(($first)?' </span>':'').'</li>';
            break;

        case 'zipcodelocation':
            $li[] = '<li><i class="fa fa-globe'.(($first)?' fa-2x':'').'"></i> <a href="https://www.google.de/maps/dir/'.${$data[$k]}.'" target="_blank">'.(($first)?'<span class="lead">':'').''.${$data[$k]}.''.(($first)?'</span>':'').'</a></li>';
            break;

        case 'email':
            $li[] = '<li><i class="fa fa-envelope'.(($first)?' fa-2x':'').'"></i> <a href="mailto:'.${$data[$k]}.'" target="_blank">'.(($first)?'<span class="lead">':'').''.${$data[$k]}.''.(($first)?'</span>':'').'</a></li>';
            break;

    }
    $first = false;
}
?>
<div class="contact-details">
    <?php
    if(isset($textHeading))
    {
        echo '<h3>'.$textHeading.'</h3>';
    }
    ?>
    <ul class="contact list-unstyled">
        <?php
        foreach($li as $l)
        {
           echo $l."\n";
        }
        ?>
    </ul>
</div>