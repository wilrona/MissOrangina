<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/09/2015
 * Time: 06:28
 */

namespace Controller\etat;

require_once(plugin_dir_path(PLUGINS_DIR_CURRENT).'vendor/html2pdf/html2pdf.class.php');

use HTML2PDF;
use Plugin_Controller;

class etatController extends Plugin_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function statistiqueAction(){
        ob_start();

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';

        $table_ville = $wpdb->prefix. 'miss_ville';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        $this->view->inscrit_complet = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE inscrit = TRUE ");
        $this->view->inscrit_attente = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE inscrit = FALSE ");


        $this->view->inscrit_par_ville = $wpdb->get_results($wpdb->prepare("SELECT ville, COUNT(id) as nbr  FROM $table_name WHERE inscrit = %d GROUP BY ville", 1), ARRAY_A);
        $this->view->inscrit_par_age = $wpdb->get_results($wpdb->prepare("SELECT YEAR(CURDATE())-YEAR(dateNais) as Age, COUNT(id) as nbr FROM $table_name WHERE inscrit = %d GROUP BY Age ", 1), ARRAY_A);

        $this->view->render_view('etat/statistique', true);

        $content = ob_get_clean();
        http_response_code(200);
        try{
            $pdf = new HTML2PDF('P', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('statistique.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }

    public function votes_statAction(){
        ob_start();

        global $wpdb;
        $table_vote = $wpdb->prefix. 'miss_vote';
        $table_inscrit = $wpdb->prefix. 'miss_inscrit';

        $table_ville = $wpdb->prefix. 'miss_ville';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        $this->view->votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) as nbr FROM $table_vote WHERE etape = %d", $_REQUEST['phase']));

        $this->view->vote_par_ville = $wpdb->get_results($wpdb->prepare("SELECT COUNT(v.id) as nbr, c.ville  FROM $table_vote as v, $table_inscrit as c  WHERE v.idcandidat = c.id and v.etape = %d GROUP BY ville", $_REQUEST['phase']));

        if($_REQUEST['phase'] == 2){
            $this->view->phase = "1/4 Finale";
        }elseif($_REQUEST['phase'] == 3){
            $this->view->phase = "1/2 Final";
        }elseif($_REQUEST['phase'] == 4){
            $this->view->phase = "Final";
        }

        $this->view->render_view('etat/stat_vote', true);

        $content = ob_get_clean();
        http_response_code(200);
        try{
            $pdf = new HTML2PDF('P', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('stat_vote_'.$_REQUEST['phase'].'.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }

    public function listeinscritAction(){
        ob_start();

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_ville = $wpdb->prefix. 'miss_ville';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        if(!isset($_REQUEST['phase']) || empty($_REQUEST['phase'])){

            $this->view->inscrit = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE %d", 1), ARRAY_A);
        }else{
            $this->view->inscrit = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE etape >= %d", $_REQUEST['phase']), ARRAY_A);
        }

        $this->view->render_view('etat/liste_inscrit', true);

        $content = ob_get_clean();
        http_response_code(200);
        try{
            $pdf = new HTML2PDF('L', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('statistique.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }

    public function classementAction(){
        ob_start();

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_ville = $wpdb->prefix. 'miss_ville';
        $table_vote = $wpdb->prefix. 'miss_vote';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        $this->view->inscrit = $wpdb->get_results($wpdb->prepare("SELECT COUNT(v.id) as nbr, c.* FROM $table_vote as v, $table_name as c  WHERE v.idcandidat = c.id and v.etape = %d ORDER BY nbr DESC ", $_REQUEST['phase']), ARRAY_A);

        if($_REQUEST['phase'] == 2){
            $this->view->phase = "1/4 Finale";
        }elseif($_REQUEST['phase'] == 3){
            $this->view->phase = "1/2 Final";
        }elseif($_REQUEST['phase'] == 4){
            $this->view->phase = "Final";
        }

        $this->view->render_view('etat/classement', true);

        $content = ob_get_clean();
        http_response_code(200);
        try{
            $pdf = new HTML2PDF('L', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('classement.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }

    public function classementvilleAction($ville=null){

        if($ville == null){
            return false;
        }

        ob_start();

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_ville = $wpdb->prefix. 'miss_ville';
        $table_vote = $wpdb->prefix. 'miss_vote';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);
        $this->view->inscrit = $wpdb->get_results(
                $wpdb->prepare("SELECT COUNT(v.id) as nbr, c.* FROM $table_vote as v, $table_name as c  WHERE v.idcandidat = c.id and c.ville = %d AND v.etape = %d ORDER BY nbr DESC ", $ville, $_REQUEST['phase']),
                ARRAY_A
        );

        $this->view->enattente = 'PAR VILLE';

        if($_REQUEST['phase'] == 2){
            $this->view->phase = "1/4 Finale";
        }elseif($_REQUEST['phase'] == 3){
            $this->view->phase = "1/2 Final";
        }elseif($_REQUEST['phase'] == 4){
            $this->view->phase = "Final";
        }

        $this->view->render_view('etat/classement', true);

        $content = ob_get_clean();
        http_response_code(200);
        try{
            $pdf = new HTML2PDF('L', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('classement_par_ville_'.$ville.'.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }

    public function parvilleAction($ville=null){

        if($ville == null){
            return false;
        }
        
        ob_start();

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_ville = $wpdb->prefix. 'miss_ville';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);
        if(!isset($_REQUEST['phase']) && empty($_REQUEST['phase'])) {
            $this->view->inscrit = $wpdb->get_results(
                $wpdb->prepare("SELECT * FROM $table_name WHERE  ville = %s", $ville),
                ARRAY_A
            );
        }else{
            $this->view->inscrit = $wpdb->get_results(
                $wpdb->prepare("SELECT * FROM $table_name WHERE  ville = %s AND etape >= %d", $ville, $_REQUEST['phase']),
                ARRAY_A
            );

            if($_REQUEST['phase'] == 2){
                $this->view->phase = "1/4 Finale";
            }elseif($_REQUEST['phase'] == 3){
                $this->view->phase = "1/2 Final";
            }elseif($_REQUEST['phase'] == 4){
                $this->view->phase = "Final";
            }
        }
        $this->view->enattente = 'PAR VILLE';



        $this->view->render_view('etat/liste_inscrit', true);

        $content = ob_get_clean();
        http_response_code(200);
        try{
            $pdf = new HTML2PDF('L', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('inscrit_par_ville_'.$ville.'.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }

    public function parageAction($age=null){

        if($age == null){
            return false;
        }

        ob_start();

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_ville = $wpdb->prefix. 'miss_ville';
        $this->view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        if(!isset($_REQUEST['phase']) || empty($_REQUEST['phase'])) {
            $this->view->inscrit = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *,  YEAR(CURDATE())-YEAR(dateNais) as age FROM $table_name HAVING age = %d",
                    $age
                ),
                ARRAY_A
            );
        }else{
            $this->view->inscrit = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *,  YEAR(CURDATE())-YEAR(dateNais) as age FROM $table_name HAVING age = %d AND etape >= %d",
                    $age, $_REQUEST['phase']
                ),
                ARRAY_A
            );

            if($_REQUEST['phase'] == 2){
                $this->view->phase = "1/4 Finale";
            }elseif($_REQUEST['phase'] == 3){
                $this->view->phase = "1/2 Final";
            }elseif($_REQUEST['phase'] == 4){
                $this->view->phase = "Final";
            }
        }
        $age = explode('?', $age);
        $this->view->enattente = 'PAR AGE ( '.$age[0].' ans )';



        $this->view->render_view('etat/liste_inscrit', true);

        $content = ob_get_clean();
        http_response_code(200);
        try{
            $pdf = new HTML2PDF('L', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('inscrit_par_age_'.$age.'.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }

    static function suppr_accents($str, $encoding='utf-8')
    {
        // transformer les caractères accentués en entités HTML
        $str = htmlentities($str, ENT_NOQUOTES, $encoding);
    
        // remplacer les entités HTML pour avoir juste le premier caractères non accentués
        // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
        $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    
        // Remplacer les ligatures tel que : Œ, Æ ...
        // Exemple "Å“" => "oe"
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        // Supprimer tout le reste
        $str = preg_replace('#&[^;]+;#', '', $str);
    
        return $str;
    }

} 