<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
/*----------------------------------------------------------------------------------
** File:                ipfilter.class.php
** Description:         PHP class for test matching an IP with a spezified filter
** Version:             1.0
** Author:              $ Blade83
** Email:               johannes_kraemer@gmx.de
** Date:                01.06.2014
**----------------------------------------------------------------------------------
** COPYRIGHT (c) 2008-2014 JOHANNES KRÄMER
** The source code included in this file is free software; you can
** redistribute it and/or modify it under the terms of the GNU General Public
** License as published by the Free Software Foundation. This license can be
** read at:  http://www.opensource.org/licenses/gpl-license.php
*/

class IPFilter
{
    /*
     * Define IP Filter types
    */
    private static
        $_IP_TYPE_SINGLE        = 'single',
        $_IP_TYPE_WILDCARD      = 'wildcard',
        $_IP_TYPE_MASK          = 'mask',
        $_IP_TYPE_RANGE         = 'range';

    private
        $_allowed_ips           = array(),
        $_ip_type               = null,
        $_ip                    = null;

    /*
     * Constructor of IPFilter class
     * @RETURN void
    */
    public function __construct()
    {
        if(!function_exists('ip2long'))           die('Function ip2long() not found!');
        if(!function_exists('filter_var'))        die('Function filter_var() not found!');
        if(!function_exists('call_user_func'))    die('Function call_user_func() not found!');
    }

    /*
     * Set an IP Filter (single|wildcard|mask|range)
     * @PARAM1 array $allowed_ips
     * @RETURN void
    */
    public function setFilter($allowed_ips)
    {
        $this->_allowed_ips = $allowed_ips;
    }

    /*
     * Validate an IP
     * @PARAM1 string $ip
     * @RETURN bool
    */
    public function checkIP($ip)
    {
        if (count($this->_allowed_ips)==0)
        {
            die("IPFilter: No Filter available!");
        }
        $this->_ip = $ip;
        if(filter_var($this->_ip, FILTER_VALIDATE_IP))
        {
            foreach($this->_allowed_ips as $allowed_ip)
            {
                if (@call_user_func(array($this,'_sub_checker_'.$this->_judge_ip_type($allowed_ip)), $allowed_ip, $this->_ip))
                {
                    return true;
                }
            }
            return false;
        }
        else
        {
            die('IP('.$this->_ip.') Syntax error');
        }
    }

    /*
     * Getter Method for checked IP
     * @RETURN string ip
    */
    public function getCheckedIP()
    {
        return $this->_ip;
    }

    /*
     * Getter Method for matching Filter Type of the checked IP
     * @RETURN string ip
    */
    public function getFilterTypeFromCheckedIP()
    {
        return $this->_ip_type;
    }

    /*
     * @PARAM1 string $ip
     * @RETURN mixed [bool or string] IP Type (single|wildcard|mask|range)
    */
    private function _judge_ip_type($ip)
    {
        if (strpos($ip, '*'))
        {
            $this->_ip_type = 'wildard';
            return self::$_IP_TYPE_WILDCARD;
        }
        if (strpos($ip, '/'))
        {
            $this->_ip_type = 'mask';
            return self::$_IP_TYPE_MASK;
        }
        if (strpos($ip, '-'))
        {
            $this->_ip_type = 'range';
            return self::$_IP_TYPE_RANGE;
        }
        if (ip2long($ip))
        {
            $this->_ip_type = 'single';
            return self::$_IP_TYPE_SINGLE;
        }
        $this->_ip_type = null;
        return false;
    }

    /*
     * @PARAM1 string $allowed_ip
     * @PARAM2 string $ip
     * @RETURN bool
    */
    private function _sub_checker_single($allowed_ip, $ip)
    {
        return (ip2long($allowed_ip) == ip2long($ip));
    }

    /*
     * Checks if is an IP in a Wildcard range
     * @PARAM1 string $allowed_ip
     * @PARAM2 string $ip
     * @RETURN bool
    */
    private function _sub_checker_wildcard($allowed_ip, $ip)
    {
        $allowed_ip_arr = explode('.', $allowed_ip);
        $ip_arr = explode('.', $ip);
        for($i=0; $i<count($allowed_ip_arr); $i++)
        {
            if ($allowed_ip_arr[$i]=='*')
            {
                return true;
            }
            else
            {
                if (false==($allowed_ip_arr[$i]==$ip_arr[$i]))
                {
                    return false;
                }
            }
        }
    }

    /*
     * Checks if is an IP in a Subnetmask
     * @PARAM1 string $allowed_ip
     * @PARAM2 string $ip
     * @RETURN bool
    */
    private function _sub_checker_mask($allowed_ip, $ip)
    {
        list($allowed_ip_ip, $allowed_ip_mask) = explode('/', $allowed_ip);
        $begin = (ip2long($allowed_ip_ip) & ip2long($allowed_ip_mask)) + 1;
        $end = (ip2long($allowed_ip_ip) | (~ip2long($allowed_ip_mask))) + 1;
        $ip = ip2long($ip);
        return ($ip>=$begin && $ip<=$end);
    }

    /*
     * Checks if is an IP in a IP Range
     * @PARAM1 string $allowed_ip
     * @PARAM2 string $ip
     * @RETURN bool
    */
    private function _sub_checker_range($allowed_ip, $ip)
    {
        list($begin, $end) = explode('-', $allowed_ip);
        $ip = ip2long($ip);
        return ($ip>=ip2long(trim($begin)) && $ip<=ip2long(trim($end)));
    }
}


/////////////
// EXAMPLE //
/////////////
/*
$IPFilter = new IPFilter();
$IPFilter->setFilter(
    array(
        '127.0.0.1',                        # single IP
        '127.0.0.2',                        # single IP
        '171.0.0.*',                        # Wildcard
        '172.0.*.*',                        # Wildcard
        '173.*.*.*',                        # Wildcard
        #'255.255.255.0/255.255.255.255',    # Subnet Mask
        '192.0.0.1 - 192.188.0.1',          # IP Range
    )
);


if ( $IPFilter->checkIP('127.0.0.1')===true )
{
    echo 'IP('.$IPFilter->getCheckedIP().') is valid with Filter. Filtertype: '.$IPFilter->getFilterTypeFromCheckedIP().'<br>';
}
else
{
    echo 'IP('.$IPFilter->getCheckedIP().') is not valid with Filter<br>';
}

if ( $IPFilter->checkIP('127.0.0.2')===true )
{
    echo 'IP('.$IPFilter->getCheckedIP().') is valid with Filter. Filtertype: '.$IPFilter->getFilterTypeFromCheckedIP().'<br>';
}
else
{
    echo 'IP('.$IPFilter->getCheckedIP().') is not valid with Filter<br>';
}

if ( $IPFilter->checkIP('171.0.0.125')===true )
{
    echo 'IP('.$IPFilter->getCheckedIP().') is valid with Filter. Filtertype: '.$IPFilter->getFilterTypeFromCheckedIP().'<br>';
}
else
{
    echo 'IP('.$IPFilter->getCheckedIP().') is not valid with Filter<br>';
}

if ( $IPFilter->checkIP('172.0.55.11')===true )
{
    echo 'IP('.$IPFilter->getCheckedIP().') is valid with Filter. Filtertype: '.$IPFilter->getFilterTypeFromCheckedIP().'<br>';
}
else
{
    echo 'IP('.$IPFilter->getCheckedIP().') is not valid with Filter<br>';
}

if ( $IPFilter->checkIP('173.77.99.88')===true )
{
    echo 'IP('.$IPFilter->getCheckedIP().') is valid with Filter. Filtertype: '.$IPFilter->getFilterTypeFromCheckedIP().'<br>';
}
else
{
    echo 'IP('.$IPFilter->getCheckedIP().') is not valid with Filter<br>';
}

if ( $IPFilter->checkIP('192.168.1.1')===true )
{
    echo 'IP('.$IPFilter->getCheckedIP().') is valid with Filter. Filtertype: '.$IPFilter->getFilterTypeFromCheckedIP().'<br>';
}
else
{
    echo 'IP('.$IPFilter->getCheckedIP().') is not valid with Filter<br>';
}

if ( $IPFilter->checkIP('192.168.1.260')===true )
{
    echo 'IP('.$IPFilter->getCheckedIP().') is valid with Filter. Filtertype: '.$IPFilter->getFilterTypeFromCheckedIP().'<br>';
}
else
{
    echo 'IP('.$IPFilter->getCheckedIP().') is not valid with Filter<br>';
}
*/
?>