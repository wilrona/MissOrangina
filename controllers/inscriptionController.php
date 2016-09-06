<?php

namespace Controller\inscription;

use Controller\facebook\facebookController;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Plugin_Controller;

/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 15:32
 */


require "facebookController.php";

class inscriptionController extends Plugin_Controller {

    public static $fbs;
    function __construct(){
        parent::__construct();
        $fbs = new facebookController();
        self::$fbs = $fbs->get_fb();
    }


    function indexAction(){

        global $wpdb;
        $table_lieu = $wpdb->prefix. 'miss_lieu';
        $this->view->lieu = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_lieu WHERE etape = %d", 1), ARRAY_A);

        $this->view->render_view('inscription/index');

    }

    function likeAction(){

        if(isset($_SESSION) && isset($_SESSION['token_fb'])){

            $this->view->render_view('inscription/like');

        }else{
            session_destroy();
            header("location:/");
        }
    }

    function formAction(){

        global $wpdb;

        if(isset($_SESSION) && isset($_SESSION['token_fb'])){

            self::$fbs->setDefaultAccessToken($_SESSION['token_fb']);
            try {
                $response = self::$fbs->get('/me?locale=en_US&fields=id,first_name,last_name,email,gender');
                $userNode = $response->getGraphUser();

                if($userNode->getField('gender') == "male"){
                    $this->view->render_view("inscription/error");
                    exit;
                }

            } catch(FacebookResponseException $e) {
//                // When Graph returns an error
//                echo 'Graph returned an error: ' . $e->getMessage();
//                exit;
                session_destroy();
                header("location:/");
            } catch(FacebookSDKException $e) {
                // When validation fails or other local issues
//                echo 'Facebook SDK returned an error: ' . $e->getMessage();
//                exit;
                session_destroy();
                header("location:/");
            }

            $table_candidat = $wpdb->prefix. 'miss_inscrit';
            $table_lieu = $wpdb->prefix. 'miss_lieu';
            $table_ville = $wpdb->prefix. 'miss_ville';
            $table_parrain = $wpdb->prefix. 'miss_parrain';


            # SELECT v.* FROM miss_lieu as l, miss_ville as v WHERE l.ville = v.id AND l.passe = 0 AND l.etape = 1
            $this->view->ville = $wpdb->get_results($wpdb->prepare("SELECT v.* FROM $table_ville as v, $table_lieu as l WHERE l.ville = v.id AND l.passe = 0 AND l.etape = 1 GROUP  BY  v.ville", 1), ARRAY_A);

            if(wp_verify_nonce($_POST['nonce'], "inscription") && isset($_POST)) {

                $data = array(
                    'id' => null,
                    'codeins' => null,
                    'nom' => null,
                    'prenom' => null,
                    'dateNais' => null,
                    'lieuNais' => null,
                    'email' => null,
                    'nationalite' => null,
                    'adresse' => null,
                    'ville' => null,
                    'phone' => null,
                    'profession' => null,
                    'diplome' => null,
                    'dream' => null,
                    'ambition' => null,
                    'loisir' => null,
                    'taille' => null,
                    'qualite' => null,
                    'enfant' => null,
                    'concours' => null,
                    'idfacebook' => null,
                    'etape' => null,
                    'presentation' => null,
                    'inscrit' => false,
                    'datecreate' => null,

                );

                $data = shortcode_atts($data, $_POST);
                $messages = array();
                if(empty($data['nom']))$messages['nom']="le nom est obligatoire";
                if(empty($data['prenom']))$messages['prenom']="le prenom est obligatoire";
                if(empty($data['dateNais'])){
                    $messages['dateNais']="la date de naissance est obligatoire";
                }else{
                    list($jour, $mois, $annee) = split('[/.]', $data['dateNais']);
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
                    if($annees < 18 || $annees > 25)$messages['dateNais_Age']= "Age compris entre 18 et 25 ans pour participer à ce concours";

                }

                if(empty($data['lieuNais']))$messages['lieuNais']="le lieu de naissance est obligatoire";
                if(empty($data['email']))$messages['email']="l'email est obligatoire pour recevoir votre formulaire d'inscription";
                if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))$messages['email']="la syntaxe de l'email n'est pas respectée";
                if(empty($data['nationalite']))$messages['nationalite']="la nationalité est obligatoire";
                if(empty($data['adresse']))$messages['adresse']="une adresse est obligatoire";
                if(empty($data['ville']))$messages['ville']="la selection de la ville est obligatoire";
                if(empty($data['phone']))$messages['phone']="le numéro de téléphone est obligatoire";
                if(empty($data['profession']))$messages['profession']="la profession est obligatoire";
                if(empty($data['diplome']))$messages['diplome']="l'information du diplome est obligatoire";
                if(empty($data['dream']))$messages['dream']="Information obligatoire";
                if(empty($data['ambition']))$messages['ambition']="Information obligatoire";
                if(empty($data['loisir']))$messages['loisir']="Information obligatoire";
                if(empty($data['taille']))$messages['taille']="Information obligatoire";
                if(empty($data['qualite']))$messages['qualite']="Information obligatoire";
                if(empty($data['enfant']) && $data['enfant'] != 0)$messages['enfant']="Information obligatoire";
                if(empty($data['concours']))$messages['concours']="Information obligatoire";

                $no_message = false;
                if(empty($messages)) $no_message = true;

                if($no_message === true){
                    $ville_candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_ville WHERE id = %d", $data["ville"]), ARRAY_A);
                    $data['codeins'] = $ville_candidat['abreviation']."".self::random(4);
                    list($jour, $mois, $annee ) = sscanf($data['dateNais'], "%d/%d/%d");
                    $strconvert =  strtotime($annee .'-'. $mois .'-'. $jour .'');
                    $data['dateNais'] = date("Y-m-d", $strconvert);

                    $data["datecreate"] = current_time('mysql');

                    $exist = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_candidat WHERE idfacebook = %d", $data["idfacebook"]));

                    if($exist){
                        $result = true;
                        $exist_candidat = $wpdb->get_var($wpdb->prepare("SELECT * FROM $table_candidat WHERE idfacebook = %d", $data["idfacebook"]), ARRAY_A);
                        $data["id"] = $exist_candidat['id'];

                        $exist_email = $wpdb->get_var("SELECT COUNT(*) FROM $table_parrain WHERE email = '".$exist_candidat['email']."'");
                        if($exist_email == 0){
                            $wpdb->insert($table_parrain, array('email' => $exist_candidat['email'], 'parrain' => false));
                        }
                    }else{
                        $result = $wpdb->insert($table_candidat, $data);

                        $exist_email = $wpdb->get_var("SELECT COUNT(*) FROM $table_parrain WHERE email = '".$data['email']."'");
                        if($exist_email == 0){
                            $wpdb->insert($table_parrain, array('email' => $data['email'], 'parrain' => false));
                        }

                        $data["id"] = $wpdb->insert_id;
                    }

                    if($result){

                        $candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_candidat WHERE id = %d", $data["id"]), ARRAY_A);

                        $table_lieu = $wpdb->prefix. 'miss_lieu';
                        $lieu = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_lieu WHERE ville = '".$data['ville']."'",1), ARRAY_A);


                        $msg = "<html><body>";
                        $msg .= "Bonjour, ".$candidat['nom']." ".$candidat['prenom']."<br/>";
                        $msg .= "Nous vous remercions pour votre inscription à notre concours Miss Orangina 2015.";
                        $msg .= " Nous vous invitons à imprimer votre formulaire d’inscription en cliquant sur le lien ci-dessous et à vous présenter au casting qui aura lieu <strong>";
                        $msg .= " à ".$lieu['lieu']." ".$lieu['ville']." le ".$lieu['datelieu']. " à partir de ".$lieu['heure']. " </strong> munie de votre carte nationale d’identité ou de votre carte d'identité scolaire. <br>";
                        $msg .= "Si vous êtes âgée de moins de 21 ans, veuillez aussi imprimer, faire signer l'autorisation parentale par votre père ou tuteur légal et joindre les photocopies de la CNI. <br>";
                        $msg .= "Si vous avez une carte scolaire, venez avec la photocopie de votre acte de naissance. Surtout faites vous accompagner de votre père ou tuteur légal au casting.<br>";
                        $msg .= "Cliquez sur ce lien : <br> <a href='".plugins_url('assets/doc/AUTORISATION_PARENTALE_MO_2015.doc', PLUGINS_DIR_CURRENT )."'> Télécharger l'autorisation parentale</a> / ";
                        $msg .= " <a href='".get_site_url()."/page/formulaire/".$candidat['codeins']."'>télécharger mon formulaire d'inscription </a> <br>";
                        $msg .= "Infoline: 695 95 95 70 <br>";
                        $msg .= "L’équipe Orangina";
                        $msg .= "</html></body>";

                        $header = "From: no-reply@missorangina-cm.com\r\n";
                        add_filter('wp_mail_content_type',array(__CLASS__, 'set_html_content_type'));
                        add_filter( 'wp_mail_from_name', array(__CLASS__,'custom_wp_mail_from_name') );

                        wp_mail($candidat['email'], 'Inscription Reussie', $msg, $header);

                        remove_filter ('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));

                        wp_redirect(get_site_url()."/inscription/parrain");


                    }
                }else{
                    $this->view->messages = $messages;
                    $this->view->data = $data;
                }


            }

            $candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_candidat WHERE idfacebook = '%d'", $userNode->getField('id')), ARRAY_A);

            if($candidat){


                    if($candidat['email'] != Null or !empty($candidat['email'])){

                        if($candidat['inscrit'] === false){
                            header("location:/inscription/parrain");
                        }else {
                            $this->view->render_view('inscription/exist');
                        }

                    }else{
                        $data = array(
                            'id' => null,
                            'codeins' => null,
                            'nom' => null,
                            'prenom' => null,
                            'dateNais' => null,
                            'lieuNais' => null,
                            'email' => null,
                            'nationalite' => null,
                            'adresse' => null,
                            'ville' => null,
                            'phone' => null,
                            'profession' => null,
                            'diplome' => null,
                            'dream' => null,
                            'ambition' => null,
                            'loisir' => null,
                            'taille' => null,
                            'qualite' => null,
                            'enfant' => null,
                            'concours' => null,
                            'idfacebook' => null,
                            'etape' => null,
                            'presentation' => null,
                            'inscrit' => false,
                            'datecreate' => null,

                        );

                        $data = shortcode_atts($data, $candidat);
                        $this->view->id = $userNode->getField('id');
                        $this->view->email = $userNode->getField('email');
                        $this->view->data = $data;
                        $this->view->render_view('inscription/form');
                    }


            }else{
                $this->view->email = $userNode->getField('email');
                $this->view->id = $userNode->getField('id');
                $this->view->first_name = $userNode->getField('first_name');
                $this->view->last_name = $userNode->getField('last_name');
                $this->view->render_view('inscription/form');
            }

        }else{
            header("location:/");

        }
    }


//    public function submitAction(){
//
//        global $wpdb;
//        $table_name = $wpdb->prefix. 'miss_inscrit';
//
//        $data = array(
//              'id' => null ,
//			  'codeins' => null,
//			  'nom' => null,
//			  'prenom' => null,
//			  'dateNais' => null,
//			  'lieuNais' => null,
//			  'email' => null,
//              'nationalite' => null,
//			  'adresse' => null ,
//			  'ville' => null ,
//			  'phone' => null ,
//			  'profession' => null ,
//              'diplome' => null,
//              'dream' => null,
//              'ambition' => null,
//              'loisir' => null,
//			  'taille' => null ,
//              'qualite' => null,
//			  'enfant' => null ,
//			  'concours' => null ,
//              'idfacebook' => null ,
//              'etape' => null ,
//              'presentation' => null ,
//              'inscrit' => false,
//              'datecreate' => null ,
//
//        );
//
//        if (wp_verify_nonce($_POST['nonce'], "inscription") && isset($_POST)){
//
//            $data = shortcode_atts($data, $_POST);
//
//            $data['codeins'] = $data['ville']."".self::random(4);
//
//            // convertion d'un string date en Date
//
//            list($annee, $mois, $jour) = split('[-.]', $data['dateNais']);
//            $today['mois'] = date('n');
//            $today['jour'] = date('j');
//            $today['annee'] = date('Y');
//            $annees = $today['annee'] - $annee;
//            if ($today['mois'] <= $mois) {
//                if ($mois == $today['mois']) {
//                    if ($jour > $today['jour'])
//                        $annees--;
//                }
//                else
//                    $annees--;
//            }
//
//            if($annees >= 18 && $annees <= 25){
//                list($jour, $mois, $annee ) = sscanf($data['dateNais'], "%d/%d/%d");
//                $strconvert =  strtotime($annee .'-'. $mois .'-'. $jour .'');
//                $data['dateNais'] = date("Y-m-d", $strconvert);
//
//                $data["datecreate"] = current_time('mysql');
//
//                $result = $wpdb->insert($table_name, $data);
//                $data["id"] = $wpdb->insert_id;
//                if($result){
//
//                    $candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $data["id"]), ARRAY_A);
//
//                    $table_lieu = $wpdb->prefix. 'miss_lieu';
//                    $lieu = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_lieu WHERE ville = %d", $candidat['ville']), ARRAY_A);
//
//
//                    $msg = "<html><body>";
//                    $msg .= "Bonjour<br/>";
//                    $msg .= "Nous vous remercions pour votre inscription à notre concours Miss Orangina 2015.";
//                    $msg .= " Nous vous invitons à imprimer votre formulaire d’inscription en cliquant sur le lien ci-dessous et à vous présenter au casting qui aura lieu";
//                    $msg .= " à ".$lieu['lieu']." ".$lieu['ville']." le ".$lieu['datelieu']. " à partir de ".$lieu['heure']. " munie de votre carte nationale d’identité ou de votre carte d'identité scolaire. <br>";
//                    $msg .= "Si vous êtes âgée de moins de 21 ans, veuillez aussi imprimer, faire signer l'autorisation parentale par l'un de vos parents et joindre les photocopies de la CNI et de l'acte de naissance du parent. Si vous avez une carte scolaire, venez avec la photocopie de votre acte de naissance <br>";
//                    $msg .= "Cliquez sur ce lien : <br> <a href='". get_template_directory_uri()."/doc/AUTORISATION_PARENTALE_MO_2015.doc'> télécharger l'autorisation parentale</a> / ";
//                    $msg .= " <a href='".get_site_url()."/page/formulaire/".$candidat['codeins']."'>télécharger mon formulaire d'inscription </a> <br>";
//                    $msg .= "Infoline: 695 95 95 70 <br>";
//                    $msg .= "L’équipe Orangina";
//                    $msg .= "</html></body>";
//
//                    $header = "From: no-reply@missorangina-cm.com\r\n";
//                    add_filter('wp_mail_content_type',array(__CLASS__, 'set_html_content_type'));
//                    add_filter( 'wp_mail_from_name', array(__CLASS__,'custom_wp_mail_from_name') );
//
//                    wp_mail($candidat['email'], 'Inscription Reussie', $msg, $header);
//
//                    remove_filter ('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
//
//
//                    header('location:/inscription/parrain');
//            }else{
//                    header('location:/inscription/form');
//                }
//
//
//            }
//        }else{
//            header("location:/");
//        }
//    }

    private function random($car) {
        $string = "";
        $chaine = "1234567890";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

    public function parrainAction(){

        if(isset($_SESSION) && isset($_SESSION['token_fb'])) {

            self::$fbs->setDefaultAccessToken($_SESSION['token_fb']);
            try {
                $response = self::$fbs->get('/me?locale=en_US&fields=id,gender');
                $userNode = $response->getGraphUser();

                if($userNode->getField('gender') == "male"){
                    $this->view->render_view("inscription/error");
                    exit;
                }

            } catch(FacebookResponseException $e) {
//                // When Graph returns an error
//                echo 'Graph returned an error: ' . $e->getMessage();
//                exit;
                session_destroy();
                header("location:/");
            } catch(FacebookSDKException $e) {
                // When validation fails or other local issues
//                echo 'Facebook SDK returned an error: ' . $e->getMessage();
//                exit;
                session_destroy();
                header("location:/");
            }

            global $wpdb;
            $table_name = $wpdb->prefix. 'miss_parrain';

            $table_candidat = $wpdb->prefix. 'miss_inscrit';
            $candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_candidat WHERE idfacebook = %d", $userNode->getField('id')), ARRAY_A);



            if (wp_verify_nonce($_POST['nonce'], "parrain") && isset($_POST)){

                $parrains = $_POST['parrain'];
                foreach($parrains as $parrain){
                    $data = array(
                        'email'=> $parrain,
                        'idcandidat' => $candidat['id'],
                        'parrain' => true
                    );

                    $email_exist = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE email = ".$parrain." AND parrain = 1");
                    if($email_exist >= 1){ # voir son utilise dans la seconde version

                        $this->view->notice = 'L\'ami(e) avec l\'email '.$parrain." est deja utilise(e)";
                        break;

                    }else{
                        $msg = "<html><body>";
                        $msg .= "Bonjour,<br>";
                        $msg .= "Votre ami(e) <b>".$candidat['nom']." ".$candidat['prenom']."</b> vous invite à la soutenir pour le concours Miss Orangina 2015. <br>";
                        $msg .= 'Cliquez sur ce lien pour accéder au site <a href="http://www.missorangina-cm.com">missorangina-cm.com</a><br>';
                        $msg .= "L’équipe Orangina";
                        $msg .= "</html></body>";

                        $header = "From: no-reply@missorangina-cm.com\r\n";
                        add_filter('wp_mail_content_type',array(__CLASS__, 'set_html_content_type'));
                        add_filter( 'wp_mail_from_name', array(__CLASS__,'custom_wp_mail_from_name') );

                        $email = wp_mail($parrain, 'Demande de parrainage', $msg, $header);

                        remove_filter ('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));

                        if($email){
                            $wpdb->insert($table_name, $data);
                        }
                    }


                }

                if (!isset($this->view->notice)){
                        $item = array(
                            'inscrit' => true
                        );
                        $wpdb->update($table_candidat, $item, array('id' => $candidat["id"]));
                        header('location:/inscription/confirmation');

                }

            }

            if($candidat){
                $emails = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE 1 idcandidat = %d", $candidat['id']), ARRAY_A);
                $set_email = array();
                foreach($emails as $i => $item){
                    $set_email[$i] = $item['email'];
                }
                $this->view->email = $set_email;
            }else{
                $this->view->email = null;
            }

            $this->view->id = $userNode->getField('id');
            $this->view->render_view('inscription/parrain');
        }
    }

    public function resendAction($codeins=null){

        global $wpdb;

        $table_name = $wpdb->prefix. 'miss_inscrit';
        if($codeins == null):
            $candidats = $wpdb->get_results($wpdb->prepare("SELECT *, YEAR(CURDATE())-YEAR(dateNais) as Age FROM $table_name WHERE email IS NOT NULL HAVING Age >= 17 AND Age <= 25", 1), ARRAY_A);

            foreach ($candidats as $candidat) {

                $table_lieu = $wpdb->prefix. 'miss_lieu';
                $lieu = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_lieu WHERE ville = '".$candidat['ville']."'",1), ARRAY_A);


                $msg = "<html><body>";
                $msg .= "Bonjour, ".$candidat['nom']." ".$candidat['prenom']."<br/>";
                $msg .= "Nous vous remercions pour votre inscription à notre concours Miss Orangina 2015.";
                $msg .= " Nous vous invitons à imprimer votre formulaire d’inscription en cliquant sur le lien ci-dessous et à vous présenter au casting qui aura lieu <strong>";
                $msg .= " à ".$lieu['lieu']." ".$lieu['ville']." le ".$lieu['datelieu']. " à partir de ".$lieu['heure']. " </strong> munie de votre carte nationale d’identité ou de votre carte d'identité scolaire. <br>";
                $msg .= "Si vous êtes âgée de moins de 21 ans, veuillez aussi imprimer, faire signer l'autorisation parentale par votre père ou tuteur légal et joindre les photocopies de la CNI. <br>";
                $msg .= "Si vous avez une carte scolaire, venez avec la photocopie de votre acte de naissance. Surtout faites vous accompagner de votre père ou tuteur légal au casting.<br>";
                $msg .= "Cliquez sur ce lien : <br> <a href='". plugins_url('assets/doc/AUTORISATION_PARENTALE_MO_2015.doc', PLUGINS_DIR_CURRENT )."'> télécharger l'autorisation parentale</a> / ";
                $msg .= " <a href='".get_site_url()."/page/formulaire/".$candidat['codeins']."'>télécharger mon formulaire d'inscription </a> <br>";
                $msg .= "Infoline: 695 95 95 70 <br>";
                $msg .= "L’équipe Orangina";
                $msg .= "</html></body>";

                $header = "From: no-reply@missorangina-cm.com\r\n";
                add_filter('wp_mail_content_type',array(__CLASS__, 'set_html_content_type'));
                add_filter( 'wp_mail_from_name', array(__CLASS__,'custom_wp_mail_from_name') );

                wp_mail($candidat['email'], 'Reconfirmation du lieu de casting et de votre formulaire d\'inscription', $msg, $header);

                remove_filter ('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));

                echo "success <br>";
            }
        else:

            $candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE codeins = '".$codeins."'", 1), ARRAY_A);

            $table_lieu = $wpdb->prefix. 'miss_lieu';
            $lieu = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_lieu WHERE ville = '".$candidat['ville']."'",1), ARRAY_A);


            $msg = "<html><body>";
            $msg .= "Bonjour, ".$candidat['nom']." ".$candidat['prenom']."<br/>";
            $msg .= "Nous vous remercions pour votre inscription à notre concours Miss Orangina 2015.";
            $msg .= " Nous vous invitons à imprimer votre formulaire d’inscription en cliquant sur le lien ci-dessous et à vous présenter au casting qui aura lieu <strong>";
            $msg .= " à ".$lieu['lieu']." ".$lieu['ville']." le ".$lieu['datelieu']. " à partir de ".$lieu['heure']. " </strong> munie de votre carte nationale d’identité ou de votre carte d'identité scolaire. <br>";
            $msg .= "Si vous êtes âgée de moins de 21 ans, veuillez aussi imprimer, faire signer l'autorisation parentale par votre père ou tuteur légal et joindre les photocopies de la CNI. <br>";
            $msg .= "Si vous avez une carte scolaire, venez avec la photocopie de votre acte de naissance. Surtout faites vous accompagner de votre père ou tuteur légal au casting.<br>";
            $msg .= "Cliquez sur ce lien : <br> <a href='". get_template_directory_uri()."/doc/AUTORISATION_PARENTALE_MO_2015.doc'> télécharger l'autorisation parentale</a> / ";
            $msg .= " <a href='".get_site_url()."/page/formulaire/".$candidat['codeins']."'>télécharger mon formulaire d'inscription </a> <br>";
            $msg .= "Infoline: 695 95 95 70 <br>";
            $msg .= "L’équipe Orangina";
            $msg .= "</html></body>";

            $header = "From: no-reply@missorangina-cm.com\r\n";
            add_filter('wp_mail_content_type',array(__CLASS__, 'set_html_content_type'));
            add_filter( 'wp_mail_from_name', array(__CLASS__,'custom_wp_mail_from_name') );

            $email = wp_mail($candidat['email'], 'Reconfirmation du lieu de casting et de votre formulaire d\'inscription', $msg, $header);

            remove_filter ('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));

            if($email){
                echo 'succes send';
            }

        endif;



    }


    public function confirmationAction(){
        $this->view->render_view('inscription/confirmation');
    }

    public function set_html_content_type(){
        return 'text/html';
    }

    function custom_wp_mail_from_name( $original_email_from ) {
        return 'L\'équipe Orangina';
    }

}