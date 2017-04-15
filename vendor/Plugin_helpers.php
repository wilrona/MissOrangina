<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 14:01
 */

class Plugin_Helpers{

    public function url_site($var){
        $url = get_site_url()."/".$var;
        return $url;

    }

    public function date_naiss($date){
        list($annee, $mois, $jour) = preg_split('[-.]', $date);
        $today['mois'] = date('n');
        $today['jour'] = date('j');
        $today['annee'] = date('Y');
        $annees = $today['annee'] - $annee;
        if ($today['mois'] <= $mois) {
            if ($mois == $today['mois']) {
                if ($jour > $today['jour'])
                    $annees--;
            }
            else
                $annees--;
        }
        echo $annees;
    }
}