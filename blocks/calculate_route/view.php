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
=>  (c) ............... 2005-2015 Johannes Krämer |
**  - - - - - - - - - - - - - - - - - - - - - - - +
**
=>  Project:  Porto
=>  Coder:    $ Blade83
*/
?>
<script>
function calculateRouteAction<?php if(isset($bID)) { echo $bID; }?>(service, start, end){
    var
        startescaped    = escape(start),
        endescaped      = escape(end),
        startescaped1   = encodeURI(start),
        endescaped1     = encodeURI(end),
        url             = "";

    if(service == "userchoice")
    {
        service = $("#serviceProvider2").val();
    }


    if(service == "falk")
    {
        url = "http://www.falk.de/?start="+startescaped1+"&dest="+endescaped1;
    }
    else if(service == "bahn")
    {
        url = "http://reiseauskunft.bahn.de/bin/query.exe/dn?dbkanal_004=L01_S01_D001_KPK0001_reiseauskunft_LZ03&S="+start+"&SADR=1&Z="+end+"&ZADR=1&timeSel=depart&start=1";
    }
    else if(service == "google")
    {
        url = "http://maps.google.de/maps?f=d&source=s_d&saddr="+start+"&daddr="+end+"&hl=de&ocode=&mra=ls&sll=&sspn=";
    }
    else if(service == "bing")
    {
        url = "http://www.bing.com/maps/default.aspx?v=2&rtp=adr."+start+"~adr."+end;
    }
    else if(service == "map24")
    {
        url = "http://link2.map24.com/search?s="+start+"&d="+end+"&m=1";
    }
    else if(service == "klicktel")
    {
        url = "http://www.klicktel.de/routenplaner/?lng=&lat=&zoom=&s0="+start+"&s1=&s2=&s3=&s4="+end+"&s=1";
    }
    else if(service == "viamichelin")
    {
        url = "http://www.viamichelin.de/web/ItiWGPerformPage?strStartAddress="+startescaped+"&strDestAddress="+endescaped+"&strDestCP=&strDestCity=&strDestCityCountry=&strVehicle=0&ItineraryType=1&from=";
    }
    routeWin<?php if(isset($bID)) { echo $bID; }?> = window.open(url, "calculateRoute<?php if(isset($bID)) { echo $bID; }?>", "status=no,scrollbars=yes,resizable=yes,location=no,directories=no");
    routeWin<?php if(isset($bID)) { echo $bID; }?>.focus();
    return false;
}
</script>
 <div>
     <form class="form-inline" id='calculateRoute<?php if(isset($bID)) { echo $bID; }?>' onSubmit="return calculateRouteAction<?php if(isset($bID)) { echo $bID; }?>('<?php echo $serviceProvider?>',$('#calculateRouteStart<?php if(isset($bID)) { echo $bID; }?>').val(), '<?php echo $target?>')" method='get' target="_blank" accept-charset='utf-8'>
         <strong><?php if(isset($textHeading)) { echo $textHeading; }?></strong><br />
         <?php if($serviceProvider=='userchoice') { ?>
             <select class="input-sm col-md-2" style="margin-bottom: 5px;" id="serviceProvider2" name="serviceProvider2" required='required'>
                 <option value=""><?php echo t('Service Provider')?></option>
                 <option value="google">google</option>
                 <option value="falk">falk</option>
                 <option value="bahn">bahn</option>
                 <option value="bing">bing</option>
                 <option value="map24">map24</option>
                 <option value="klicktel">klicktel</option>
                 <option value="viamichelin">viamichelin</option>
             </select>
         <?php } ?>  
         
         <input type='text' style="margin-bottom: 5px;" class="input-sm col-md-<?php if($serviceProvider=='userchoice') { echo '8';} else { echo '10';}?>" id='calculateRouteStart<?php if(isset($bID)) { echo $bID; }?>' required='required' placeholder="<?php if(isset($startPlaceholder)) { echo $startPlaceholder; }?>"/>

         <input type='submit' style="margin-bottom: 15px;" class="btn btn-primary btn-sm col-md-2" value='<?php if(isset($buttonText)) { echo $buttonText; }?>' />
     </form>
 </div>
