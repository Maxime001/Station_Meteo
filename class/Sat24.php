<?php
    /**
     * Classe gérant toutes les API externes
     */
    class Sat24{ 
        
        public static function Date(){
            $MeteoJour = "<a href='http://fr.sat24.com/fr' target='sat24'><image src='http://api.sat24.com/animated/FR/visual/2/Central%20European%20Sta            ndard%20Time/2860258' width=600 height=437></a>";
            $MeteoNuit = "<a href='http://fr.sat24.com/fr' target='sat24'><image src='http://api.sat24.com/animated/FR/infraPolair/2/Central%20European%            20Standard%20Time/2565260' width=600 height=437></a>";
            
            $heure  = date("H");
            
            
            if($heure<6 OR $heure>16){
                return $MeteoNuit;
            }
            else{
                return $MeteoJour;
            }
        }
        
        public static function afficheLune(){
            $lune = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"142\"><tr><td><div style=\"width:142px\"><div style=\"padding:2px;background-color:#000000;border: 1px solid #000000\"><div style=\"padding:15px;padding-bottom:5px;padding-top:11px;border: 1px solid #AFB2D8\" align=\"center\"><div style=\"padding-bottom:6px;color:#FFFFFF;font-family:arial,helvetica,sans-serif;font-size:11.4px;font-weight:bold\">CURRENT MOON</div><embed allowScriptAccess=\"never\" src=\"http://www.moonmodule.com/cs/ccm_v1.swf\" FlashVars=\"lg=en&hs=1&tf=24hr&scs=0&tc=FFFFFF&df=dmy&dfd=1&bgc=000000&mc=000000&js=0&msp=1&u=mc\" quality=\"high\" width=\"104\" height=\"153\" bgcolor=\"#000000\" name=\"ccm_mph_mod\" align=\"middle\" wmode=\"opaque\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /><div style=\"padding-top:5px\" align=\"center\"><a href=\"http://www.moonconnection.com/moon_cycle.phtml\" target=\"mc_moon_ph\" style=\"font-size:10px;font-family:arial,verdana,sans-serif;color:#7F7F7F;text-decoration:underline;background:#000000;border:none;\"><span style=\"color:#7F7F7F\">moon cycles</span></a></div></div></div></div></td></tr></table>";   
            return $lune;
        }
        
    }