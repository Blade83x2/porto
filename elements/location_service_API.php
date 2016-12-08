<?php
/*>       ____  _           _       ___ _____
*>       | __ )| | __ _  __| | ___ ( _ )___ /
*>       |  _ \| |/ _` |/ _` |/ _ \/ _ \ |_ \
*>       | |_) | | (_| | (_| |  __/ (_) |__) |
*>       |____/|_|\__,_|\__,_|\___|\___/____/
*>
**  - - - - - - - - - - - - - - - - - - - - - - - +
=>  Web ......... http://cplusplus-development.de |
=>  Mail ........................ mail@blade83.de |
=>  (c) ............... 2005-2014 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Filename: location_service_API.php
*/
namespace cplusplus_development\api;
{
    class location_service
    {
        private
            // Start API Tooken config
            $token          = 'bhLIiWHdY7iuFnocDZ2P5dZOfubMXmit', // <-- anpassen!!!
            // End API Tooken config
            $webserviceUrl  = 'http://cplusplus-development.de/webservice/location',
            $handle         = NULL,
            $data           = NULL;

        private function __construct(){}
        private function __clone(){}
        static private $instance = null;
        static public function getInstance()
        {
            if (null === self::$instance)
            {
                self::$instance = new self();
            }
            return self::$instance;
        }
        private function curl($service)
        {
            $this->handle = curl_init();
            curl_setopt($this->handle, CURLOPT_URL, $service);
            curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);
            if(substr($service, 4, 1) == 's')
            {
                curl_setopt($this->handle, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($this->handle, CURLOPT_SSL_VERIFYHOST, false);
            }
            $this->data = curl_exec($this->handle);
            curl_close($this->handle);
            return $this->data;
        }
        public function getDistanceBetweenPlz($plz1, $plz2, $numberFormat)
        {
            return $this->curl($this->webserviceUrl.'/getDistanceBetweenPlz?token='.$this->token
                .'&plz1='.$plz1.'&plz2='.$plz2.'&numberFormat='.$numberFormat);
        }
        public function typeaheadPlz($plz)
        {
            return $this->curl($this->webserviceUrl.'/getTypeaheadPlz?token='.$this->token.'&plz='.$plz);
        }
        public function typeaheadName($name)
        {
            return $this->curl($this->webserviceUrl.'/getTypeaheadName?token='.$this->token.'&name='.base64_encode($name));
        }
        public function getNameFromPlz($plz)
        {
            return $this->curl($this->webserviceUrl.'/getNameFromPlz?token='.$this->token.'&plz='.$plz);
        }
        public function getRadiusFromPlz($plz, $radius)
        {
            return $this->curl($this->webserviceUrl.'/getRadiusFromPlz?token='.$this->token.'&plz='.$plz.'&radius='.$radius);
        }
        public function getListByName($name)
        {
            return $this->curl($this->webserviceUrl.'/getListByName?token='.$this->token.'&name='.base64_encode($name));
        }
        public function getBundeslandArray()
        {
            return $this->curl($this->webserviceUrl.'/getBundeslandArray?token='.$this->token);
        }
        public function getNextFromPos($lat, $lon)
        {
            return $this->curl($this->webserviceUrl.'/getNextFromPos?token='.$this->token.'&lat='.$lat.'&lon='.$lon);
        }
    }
}
$location = \cplusplus_development\api\location_service::getInstance();
if (isset($_POST['type']))
{
    switch($_POST['type'])
    {
        case 'getDistanceBetweenPlz':
            echo $location->getDistanceBetweenPlz((string)$_POST['plz1'], (string)$_POST['plz2'], (string)$_POST['numberFormat']);
            break;
        case 'typeaheadPlz':
            echo $location->typeaheadPlz((string)$_POST['plz']);
            break;
        case 'typeaheadName':
            echo $location->typeaheadName((string)$_POST['name']);
            break;
        case 'getNameFromPlz':
            echo $location->getNameFromPlz((string)$_POST['plz']);
            break;
        case 'getRadiusFromPlz':
            echo $location->getRadiusFromPlz((string)$_POST['plz'], (string)$_POST['radius']);
            break;
        case 'getListByName':
            echo $location->getListByName((string)$_POST['name']);
            break;
        case 'getBundeslandArray':
            echo $location->getBundeslandArray();
            break;
        case 'getNextFromPos':
            echo $location->getNextFromPos((string)$_POST['lat'], (string)$_POST['lon']);
            break;
        default:
            exit(0);
            break;
    }
}
?>