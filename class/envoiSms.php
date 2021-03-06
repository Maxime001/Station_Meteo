<?php
/**
 * Classe gérant l'envoi des SMS
 */
class envoiSms{

    const OUVERTURE_TOIT = "début d'ouverture du toit de l'observatoire !";
    const FERMETURE_TOIT = "début de fermeture du toit de l'observatoire !";
    const ALARME_ACTIVE = "l'alarme est activée";
    const ALARME_DESACTIVE = "l'alarme est désactivée";
    const ALARME_SONNE = "l'alarme est en train de sonner";
    const PLUIE = "Il pleut, il faut fermer l'observatoire";
    const JOUR = "Il fait jour, on peux fermer l'observatoire";
    const INTRUSION_SITE = "Quelqu'un à tenté une intrusion sur le site, l'IP à été bloquée";   

    /**
     * Fonction qui gère l'encodage et l'envoi de SMS
     * @param type $message message à envoyer
     * @return type string retourne un string si erreur d'envoi du sms
     */
    public function sms($message){
        include("config.php");
        
        $message = urlencode($message);
        $smsPass = urlencode($smsPass);
        $smsUser = urlencode($smsUser);
	$link = "https://smsapi.free-mobile.fr/sendmsg?user=$smsUser&pass=$smsPass&msg=$message";
	$result = file_get_contents($link);
        return $result;
    } 
}
