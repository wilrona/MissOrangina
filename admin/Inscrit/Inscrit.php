<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/09/2015
 * Time: 14:33
 */
require "List_View_Inscrit.php";
require "List_View_Inscrit_Quart.php";
require "List_View_Inscrit_Demi.php";
require "List_View_Inscrit_Final.php";
require "List_View_Inscrit_Gagnant.php";

class Inscrit extends Plugin_AdminController{

    public  function __construct(){
        parent::__construct(__CLASS__, 'add_menu_inscrit');
        parent::set_thickbox();
        add_action( 'admin_init', array(__CLASS__,'MY_Modal'));
        global $wpdb;
        $table_phase = $wpdb->prefix. 'miss_phase';
        $phases = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_phase WHERE active = %d", 1), ARRAY_A);
        foreach ($phases as $phase) {
            if($phase['etape'] >= 2):
                parent::__construct(__CLASS__, 'add_menu_inscrit_quart');
            endif;
            if($phase['etape'] >= 3):
                parent::__construct(__CLASS__, 'add_menu_inscrit_demi');
            endif;
            if($phase['etape'] >= 4): parent::__construct(__CLASS__, 'add_menu_inscrit_final'); endif;
            if($phase['etape'] >= 5): parent::__construct(__CLASS__, 'add_menu_inscrit_gagnant'); endif;
        }

    }

    private function random($car) {
        $string = "";
        $chaine = "1234567890";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

    static function add_menu_inscrit(){
        $menu = array(
            array(
                'page_title' => 'Liste des inscrits',
                'menu_title' => 'Les inscrits',
                'capability' => 'publish_posts',
                'menu_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                'function' => array(__CLASS__, 'IndexInscrit'),
                'icon_url' => 'dashicons-groups',
                'position' => 7,
                'submenu' => array(
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                        'page_title' => 'Fiche d\'un candidat',
                        'menu_title' => 'Ajouter/Modifier Candidat',
                        'capability' => 'publish_posts',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_view_inscrit",
                        'function' => array(__CLASS__, 'FicheInscrit')
                    ),
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                        'page_title' => '',
                        'menu_title' => '',
                        'capability' => 'activate_plugins',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_add_to_phase",
                        'function' => array(__CLASS__, 'add_to_phase')
                    ),
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                        'page_title' => '',
                        'menu_title' => '',
                        'capability' => 'activate_plugins',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_remove_to_phase",
                        'function' => array(__CLASS__, 'remove_to_phase')
                    )
                )
            )
        );

        parent::menu_page_admin($menu);
    }

    static function add_to_phase(){
        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
            global $wpdb;
            $table_inscrit = $wpdb->prefix. 'miss_inscrit';
            $inscrit = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_inscrit WHERE id = %d", $_REQUEST['id']), ARRAY_A);
            $data = array();
            $location = '/';
            if($inscrit['etape'] <= 1){
                $data['etape'] = 2;
                $location = menu_page_url(PREFIX_PLUGINS_NAME."_inscrit", false );
            }
            if($inscrit['etape'] == 2){
                $data['etape'] = 3;
                $location = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit_quart", false );
            }
            if($inscrit['etape'] == 3){
                $data['etape'] = 4;
                $location = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit_demi", false );
            }
            if($inscrit['etape'] == 4){
                $data['etape'] = 5;
                $location = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit_final", false );
            }
            $wpdb->update($table_inscrit, $data, array('id' => $inscrit['id']));

            header('location:'.$location);
        }
    }

    static function remove_to_phase(){
        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
            global $wpdb;
            $table_inscrit = $wpdb->prefix. 'miss_inscrit';
            $inscrit = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_inscrit WHERE id = %d", $_REQUEST['id']), ARRAY_A);
            $data = array();
            $location = '/';
            if($inscrit['etape'] == 2){
                $data['etape'] = 1;
                $location = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit_quart", false );
            }
            if($inscrit['etape'] == 3){
                $data['etape'] = 2;
                $location = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit_demi", false );
            }
            if($inscrit['etape'] == 4){
                $data['etape'] = 3;
                $location = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit_final", false );
            }
            if($inscrit['etape'] == 5){
                $data['etape'] = 4;
//                $location = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit_final", false );
            }
            $wpdb->update($table_inscrit, $data, array('id' => $inscrit['id']));
            header('location:'.$location);
        }
    }


    static function add_menu_inscrit_quart(){
        $menu = array(
            array(
                'submenu' => array(
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                        'page_title' => 'Candidats de la phase de quart de final',
                        'menu_title' => 'Quart de final',
                        'capability' => 'publish_posts',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_view_inscrit_quart",
                        'function' => array(__CLASS__, 'Inscrit_Quart_Final')
                    )

                )
            )
        );

        parent::menu_page_admin($menu);
    }

    static function add_menu_inscrit_demi(){
        $menu = array(
            array(
                'submenu' => array(
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                        'page_title' => 'Candidats de la phase de demi de final',
                        'menu_title' => 'Demi de final',
                        'capability' => 'publish_posts',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_view_inscrit_demi",
                        'function' => array(__CLASS__, 'Inscrit_Demi_Final')
                    )
                )
            )
        );

        parent::menu_page_admin($menu);
    }

    static function add_menu_inscrit_final(){
        $menu = array(
            array(
                'submenu' => array(
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                        'page_title' => 'Candidats de la phase de la final',
                        'menu_title' => 'Final',
                        'capability' => 'publish_posts',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_view_inscrit_final",
                        'function' => array(__CLASS__, 'Inscrit_Final')
                    )

                )
            )
        );

        parent::menu_page_admin($menu);
    }

    static function add_menu_inscrit_gagnant(){
        $menu = array(
            array(
                'submenu' => array(
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_inscrit",
                        'page_title' => 'Candidats de la phase de la final',
                        'menu_title' => 'Gagnant',
                        'capability' => 'publish_posts',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_view_inscrit_gagnant",
                        'function' => array(__CLASS__, 'Inscrit_Gagnant')
                    )

                )
            )
        );

        parent::menu_page_admin($menu);
    }


    static function Inscrit_Quart_Final(){
        self::$view->render_view_admin("inscrit/quart");
    }


    static function Inscrit_Demi_Final(){
        self::$view->render_view_admin("inscrit/demi");
    }

    static function Inscrit_Final(){
        self::$view->render_view_admin("inscrit/final");
    }

    static function Inscrit_Gagnant(){
        self::$view->render_view_admin("inscrit/gagnant");
    }

    /*
    * Debut des actions de nos vues
    */
    static function IndexInscrit(){

        self::$view->render_view_admin("inscrit/index");
    }


    static function  FicheInscrit(){
        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_phase = $wpdb->prefix. 'miss_phase';
        $table_parrain = $wpdb->prefix. 'miss_parrain';
        $table_ville = $wpdb->prefix. 'miss_ville';
        $table_vote = $wpdb->prefix. 'miss_vote';

        self::$view->ville = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE 1", 1), ARRAY_A);

        if (wp_verify_nonce($_POST['nonce'], "candidat_update") && isset($_POST)) {

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
                'presentation' => null,
                'image' => null,
                'etape' => 0,
                'inscrit' => true,
                'datecreate' => null

            );
            $data = shortcode_atts($data, $_POST);

            $messages = array();
            if(empty($data['nom']))$messages['nom']="le nom est obligatoire";
            if(empty($data['prenom']))$messages['prenom']="le prenom est obligatoire";
            if(empty($data['dateNais'])){
                $messages['dateNais']="la date de naissance est obligatoire";
            }else{
                list($jour, $mois, $annee) = preg_split('[/]', $data['dateNais']);
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
                if($annees < 18 || $annees > 26)$messages['dateNais_Age']= "Age compris entre 18 et 25 ans pour participer à ce concours";

            }

            if(empty($data['lieuNais']))$messages['lieuNais']="le lieu de naissance est obligatoire";
//            if(empty($data['email']))$messages['email']="l'email est obligatoire pour recevoir votre formulaire d'inscription";
            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL) && !empty($data['email']))$messages['email']="la syntaxe de l'email n'est pas respectée";
            if(empty($data['nationalite']))$messages['nationalite']="la nationalité est obligatoire";
            if(empty($data['adresse']))$messages['adresse']="une adresse est obligatoire";
            if(empty($data['ville']))$messages['ville']="la selection de la ville est obligatoire";
            if(empty($data['phone']))$messages['phone']="le numéro de téléphone est obligatoire";

            $no_message = false;
            if(empty($messages)) $no_message = true;
            if(empty($messages)) {
                $error = true;

            }else{
                $error = implode('<br />', $messages);
            }

            list($jour, $mois, $annee ) = sscanf($data['dateNais'], "%d/%d/%d");
            $strconvert =  strtotime($annee .'-'. $mois .'-'. $jour .'');
            $data['dateNais'] = date("Y-m-d", $strconvert);

            if($no_message === true){
                $ville_candidat = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_ville WHERE id = %d", $data["ville"]), ARRAY_A);
                $data['presentation'] = stripslashes($data["presentation"]);
                if(!empty($data['id']) || $data['id'] != null){
                    $result = $wpdb->update($table_name, $data, array('id' => $data['id']));
                    $_REQUEST['id'] = $data['id'];
                }else{
                    $data["datecreate"] = current_time('mysql');
                    $data['codeins'] = $ville_candidat['abreviation']."".self::random(4);
                    $result = $wpdb->insert($table_name, $data);
                    $_REQUEST['id'] = $wpdb->insert_id;
                }
                self::$view->message = 'Enregitrement effectuée avec success';
            }else{
                self::$view->notice = $error;
                self::$view->item = $data;
            }

        }
        if(isset($_REQUEST['id'])){
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST["id"]), ARRAY_A);

            $phase = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_phase WHERE etape = %d", $item["etape"]), ARRAY_A);
            $phase_suivante = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_phase WHERE etape > %d", $item["etape"]), ARRAY_A);
            $etape = $item['etape'];
            $item['etapes'] = $phase['valeur'];
            $item['suivant'] = $phase_suivante['valeur'];

            $item['parrain'] = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_parrain WHERE idcandidat = %d AND parrain = true", $_REQUEST['id']), ARRAY_A);

            self::$view->item = $item;
            if(!$item){
                self::$view->item = $_REQUEST;
                self::$view->notice = "Information Introuvable";
            }else{
                self::$view->liste_phase = $wpdb->get_results($wpdb->prepare("SELECT valeur, etape FROM $table_phase as p WHERE etape > 1 AND etape <= %d ORDER BY etape", $etape), ARRAY_A);
                self::$view->candidat_vote = $wpdb->get_results($wpdb->prepare("SELECT COUNT(*) as nbr, etape FROM $table_vote WHERE idcandidat = %d ORDER BY etape", $_REQUEST["id"]), ARRAY_A);
            }
        }

        self::$view->render_view_admin("inscrit/fiche");
    }

    static function MY_Modal(){
        add_action('wp_ajax_inscrits', array(__CLASS__, 'inscrits'));
        add_action('wp_ajax_ville', array(__CLASS__, 'ville'));
        add_action('wp_ajax_age', array(__CLASS__, 'age'));
    }

    static function inscrits(){


        self::$view->render_view_admin("inscrit/modal_inscrit");
        exit();
    }

    static function ville(){

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_ville = $wpdb->prefix. 'miss_ville';

        self::$view->ville = $wpdb->get_results($wpdb->prepare("SELECT ville FROM $table_name WHERE %d GROUP BY ville", 1), ARRAY_A);

        self::$view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);
        $classement = false;
        if($_REQUEST['phase']){
            $phase = "?phase=".$_REQUEST['phase'];
            if($_REQUEST['classement']){
                $classement = true;
            }
        }else{
            $phase = '';
        }
        self::$view->phase = $phase;
        self::$view->phase_num = $_REQUEST['phase'];
        self::$view->classement = $classement;

        self::$view->render_view_admin("inscrit/modal_ville");
        exit();
    }

    static function age(){

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';

        self::$view->age = $wpdb->get_results($wpdb->prepare("SELECT YEAR(CURDATE())-YEAR(dateNais) as age FROM $table_name WHERE %d GROUP BY Age", 1), ARRAY_A);
        if($_REQUEST['phase']){
            $phase = "?phase=".$_REQUEST['phase'];
        }else{
            $phase = '';
        }
        self::$view->phase = $phase;
        self::$view->render_view_admin("inscrit/modal_age");
        exit();
    }

}