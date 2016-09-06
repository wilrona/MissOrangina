<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 08:54
 */



class IndexController extends Plugin_Controller {

    function __construct(){
        parent::__construct();
    }

    public function indexAction()
    {
        global $wpdb;


        $table_name = $wpdb->prefix . 'miss_phase';
        $table_candidat = $wpdb->prefix . 'miss_inscrit';
        $list_phase_active = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE active = %d", 1));
        $list_phase = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE %d", 1));

        $inscription = false;
        $casting = false;
        $quart = false;
        $demi = false;
        $final = false;
        $gagnant = false;

        foreach ($list_phase_active as $phase) {
            if ($phase->etape == 0) {
                $inscription = true;
            }
            if ($phase->etape == 1) {
                $casting = true;
            }
            if ($phase->etape == 2) {
                $quart = true;
            }
            if ($phase->etape == 3) {
                $demi = true;
            }
            if ($phase->etape == 4) {
                $final = true;
            }
            if ($phase->etape == 5) {
                $gagnant = true;
            }
        }

        $table_ville = $wpdb->prefix.'miss_ville';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE 1", 1), ARRAY_A);

        $table_lieu = $wpdb->prefix. 'miss_lieu';

        // Afficher la vue pour la phase d'inscription
        if($inscription == true && $casting == false){
            $this->view->lieu = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d ", 1), ARRAY_A);
            $this->view->render_view('index/index');
        }

        if($casting == true && $quart == false){
            $this->view->lieu = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d ", 1), ARRAY_A);
            $this->view->render_view('index/casting');
        }

        if($casting == true && $quart == true){
            $this->view->phase = $list_phase; // liste des phases

            // construction du tableau pour la suppression des candidats d'une selection definit comme passe
            $lieu_id = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_lieu WHERE etape = %d AND passe = 1", 2), ARRAY_A);
            $this_lieu_id = array();
            foreach ($lieu_id as $lieu) {
                $this_lieu_id[] = $lieu['ville'];
            }
            $this->view->lieu_id = $this_lieu_id;
            $this->view->etape = 2;
            $this->view->one = true;

            // Liste des lieux de la phase de casting
            $this->view->lieu_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d ", 1), ARRAY_A);

            // Liste des lieux de la phase de 1/4 de finale
            $this->view->lieu_2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d ", 2), ARRAY_A);

            $table_vote = $wpdb->prefix.'miss_vote';
            $this->view->candidat = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d ", 2), ARRAY_A);
            $this->view->candidat_ville = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", 2), ARRAY_A);
            $this->view->candidat_vote = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", 2), ARRAY_A);
            
            $this->view->render_view('index/casting_quart');
        }

        if($casting == false && $quart == true && $demi == false ){

            // construction du tableau pour la suppression des candidats d'une selection definit comme passe
            $lieu_id = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_lieu WHERE etape = %d AND passe = 1", 2), ARRAY_A);
            $this_lieu_id = array();
            foreach ($lieu_id as $lieu) {
                $this_lieu_id[] = $lieu['ville'];
            }
            $this->view->lieu_id = $this_lieu_id;
            $this->view->etape = 2;

            // Liste des lieux de la phase de 1/4 de finale
            $this->view->lieu_2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d ", 2), ARRAY_A);

            $table_vote = $wpdb->prefix.'miss_vote';
            $this->view->candidat = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d ", 2), ARRAY_A);
            $this->view->candidat_ville = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", 2), ARRAY_A);
            $this->view->candidat_vote = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", 2), ARRAY_A);
            $this->view->render_view('index/after_casting');
        }

        if($casting == false && $quart == true && $demi == true){
            $table_vote = $wpdb->prefix.'miss_vote';

            $this->view->phase = $list_phase; // liste des phases

            $lieu_id = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_lieu WHERE etape = %d AND passe = 1", 2), ARRAY_A);
            $this_lieu_id = array();
            foreach ($lieu_id as $lieu) {
                $this_lieu_id[] = $lieu['ville'];
            }
            $this->view->lieu_id = $this_lieu_id;

            // Liste des lieux de la phase de 1/4 de finale
            $this->view->lieu_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d AND passe = 0", 2), ARRAY_A);
            $this->view->candidat_1 = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d ", 2), ARRAY_A);
            $this->view->candidat_ville_1 = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", 2), ARRAY_A);
            $this->view->candidat_vote_1 = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", 2), ARRAY_A);


            // Liste des lieux de la phase de 1/2 de finale
            $this->view->lieu_2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d", 3), ARRAY_A);
            $this->view->candidat_2 = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d ", 3), ARRAY_A);
            $this->view->candidat_ville_2 = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", 3), ARRAY_A);
            $this->view->candidat_vote_2 = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", 3), ARRAY_A);


            $this->view->render_view('index/quart_demi');
        }

        if($quart == false && $demi == true && $final == false){

            // construction du tableau pour la suppression des candidats d'une selection definit comme passe
            $lieu_id = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_lieu WHERE etape = %d AND passe = 1", 3), ARRAY_A);
            $this_lieu_id = array();
            foreach ($lieu_id as $lieu) {
                $this_lieu_id[] = $lieu['ville'];
            }
            $this->view->lieu_id = $this_lieu_id;
            $this->view->etape = 3;

            // Liste des lieux de la phase de 1/2 de finale
            $this->view->lieu_2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d ", 3), ARRAY_A);

            $table_vote = $wpdb->prefix.'miss_vote';
            $this->view->candidat = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d ", 3), ARRAY_A);
            $this->view->candidat_ville = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", 3), ARRAY_A);
            $this->view->candidat_vote = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", 3), ARRAY_A);
            $this->view->render_view('index/after_casting');
        }

        if($quart == false && $demi == true && $final == true){

            $table_vote = $wpdb->prefix.'miss_vote';

            $this->view->phase = $list_phase; // liste des phases

            $lieu_id = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_lieu WHERE etape = %d AND passe = 1", 3), ARRAY_A);
            $this_lieu_id = array();
            foreach ($lieu_id as $lieu) {
                $this_lieu_id[] = $lieu['ville'];
            }
            $this->view->lieu_id = $this_lieu_id;

            // Liste des lieux de la phase de 1/2 de finale
            $this->view->lieu_1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d AND passe = 0", 3), ARRAY_A);
            $this->view->candidat_1 = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d ", 3), ARRAY_A);
            $this->view->candidat_ville_1 = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", 3), ARRAY_A);
            $this->view->candidat_vote_1 = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", 3), ARRAY_A);


            // Liste des lieux de la phase de finale
            $this->view->lieu_2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d", 4), ARRAY_A);
            $this->view->candidat_2 = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d ", 4), ARRAY_A);
            $this->view->candidat_vote_2 = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", 4), ARRAY_A);

            $this->view->render_view('index/demi_final');

        }

        if($demi == false && ($final == true || $gagnant == true)){
            $etape = 4;

            $order = 'ORDER BY RAND()';
            if ($gagnant == true){
                $etape = 5;
                $order = 'ORDER BY c.gagnant';
            }
            $this->view->etape = $etape;
            $table_vote = $wpdb->prefix.'miss_vote';
            $this->view->candidat = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d $order", $etape), ARRAY_A);
            $this->view->candidat_ville = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", $etape), ARRAY_A);
            $this->view->candidat_vote = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", $etape), ARRAY_A);
            $this->view->render_view('index/final');
        }

//
//
//
//        if($count_items){
//            $current_items = $wpdb->get_row("SELECT active, etape, used FROM $table_name WHERE active = 1");
//
//            $table_lieu = $wpdb->prefix. 'miss_lieu';
//            // construction du tableau pour la suppression des candidats d'une selection definit comme passe
//            $lieu_id = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_lieu WHERE etape = %d AND passe = 1", $current_items->etape), ARRAY_A);
//            $this_lieu_id = array();
//            foreach ($lieu_id as $lieu) {
//                $this_lieu_id[] = $lieu['ville'];
//            }
//            $this->view->lieu_id = $this_lieu_id;
//
//            $this->view->lieu = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d AND passe = 0", $current_items->etape), ARRAY_A);
//
//            $this->view->phase = $wpdb->get_results($wpdb->prepare("SELECT l.etape, p.valeur FROM $table_lieu as l, $table_name as p WHERE l.etape = p.etape AND l.passe = 0 AND l.etape = %d GROUP BY l.etape", $current_items->etape), ARRAY_A);
//
//
//            $this->view->current_etape = $current_items;
//            if($current_items->etape == 0){
//                $this->view->lieu = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d ", 1), ARRAY_A);
//                $this->view->render_view('index/index');
//            }elseif($current_items->etape == 1) {
//                $this->view->render_view('index/casting');
//            }else{
//
//                $table_candidat = $wpdb->prefix.'miss_inscrit';
//                $table_vote = $wpdb->prefix.'miss_vote';
//
//                $order = '';
//                if($current_items->etape == 5){
//                    $order = 'ORDER BY c.gagnant';
//                }
//                $this->view->candidat = $wpdb->get_results($wpdb->prepare("SELECT c.*, YEAR(CURDATE())-YEAR(c.dateNais) as Age FROM $table_candidat as c WHERE c.etape = %d $order", $current_items->etape), ARRAY_A);
//                $this->view->candidat_ville = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_candidat WHERE etape = %d GROUP BY ville", $current_items->etape), ARRAY_A);
//                $this->view->candidat_vote = $wpdb->get_results($wpdb->prepare("SELECT COUNT(id) as nbr, idcandidat FROM $table_vote WHERE etape = %d GROUP BY idcandidat", $current_items->etape), ARRAY_A);
//
////
//
//                if($current_items->etape == 2 || $current_items->etape == 3){
//                    $this->view->render_view('index/after_casting');
//                }elseif($current_items->etape == 4 || $current_items->etape == 5){
//                    $this->view->render_view('index/final');
//                }
//            }
//
//        }else {
//            $current_items = $wpdb->get_row("SELECT * FROM $table_name WHERE used = 1");
//            $this->view->current = $current_items;
//            $this->view->render_view('index/intermediaire');
//
//        }
//
//    }
    }


} 