<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/09/2015
 * Time: 22:38
 */

namespace Controller\page;
use HTML2PDF;
use Plugin_Controller;


class pageController extends Plugin_Controller{

    function __construct(){
        parent::__construct();

    }

    public function indexAction(){
        header("location:/");
    }

//    public function policyAction(){
//        $this->view->render_view('page/policy');
//    }
//
//    public function reglementAction(){
//        $this->view->render_view('page/reglement');
//    }
//
//    public function proposAction(){
//        global $wpdb;
//        $table_lieu = $wpdb->prefix. 'miss_lieu';
//        $this->view->lieu = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE %d", 1), ARRAY_A);
//
//        $this->view->render_view('page/propos');
//    }

    public function formulaireAction($codein = null){

        if($codein == null){
            header('location:/');
        }

        ob_start();

        global $wpdb;
        $table_candidat = $wpdb->prefix. 'miss_inscrit';
        $this->view->candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_candidat WHERE codeins = '".$codein."'",1), ARRAY_A);


        $this->view->render_view('page/formulaire2', true);
        $content = ob_get_clean();
        require_once(ABSPATH . 'wp-content/plugins/MissOrangina/vendor/html2pdf/html2pdf.class.php');
        try{
            $pdf = new HTML2PDF('P', 'A4', 'fr');
            $pdf->writeHTML($content);
            $pdf->Output('MonFormulaire.pdf');
        }catch (\HTML2PDF_exception $e){
            die($e);
        }

    }



}