<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 23/09/2015
 * Time: 18:01
 */

class Dashboard extends Plugin_Dashboard{


    function __construct(){
        parent::__construct();

        // suppression de toutes le widget du dashboard par default
        parent::initDashboard();
        // surppression de l'aide
        parent::remove_help();

        add_action('wp_dashboard_setup', array(__CLASS__,'add_dashboard_widgets') );

        // suppression du welcome dans le dashboard
        parent::remove_welcome();

        #Ajout du welcome panel personnalise
        add_action('welcome_panel',array(__CLASS__,'st_welcome_panel'));

        # Affficher le panel welcome quand l'utilisateur se connecte
        parent::welcome_init();

    }

    static function add_dashboard_widgets()
    {

        add_meta_box('stat_inscrit', 'Statistique des inscriptions' ,array(__CLASS__,'widget_statistique_inscription'), 'dashboard', 'normal', 'high');
        add_meta_box('stat_votes', 'Statistique des votes globals' ,array(__CLASS__,'widget_statistique_vote_general'), 'dashboard', 'side', 'high');

        global $wpdb;
        $table_phase = $wpdb->prefix. 'miss_phase';
        $phases = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_phase WHERE active = %d", 1), ARRAY_A);

        foreach ($phases as $phase) {
            if($phase['etape'] >= 4){
                add_meta_box('stat_votes_final', 'Statistique des votes en  final' ,array(__CLASS__,'widget_statistique_vote_final'), 'dashboard', 'side', 'high');
            }
            if($phase['etape'] >= 3){
                add_meta_box('stat_votes_demi', 'Statistique des votes en 1/2 de final' ,array(__CLASS__,'widget_statistique_vote_demi'), 'dashboard', 'side', 'high');
            }
            if($phase['etape'] >= 2){
                add_meta_box('stat_votes_quart', 'Statistique des votes en 1/4 de final' ,array(__CLASS__,'widget_statistique_vote_quart'), 'dashboard', 'side', 'high');
            }
        }

//        add_meta_box($item['id'], $item['title'], $item['function'], 'dashboard', 'side', 'high');

    }


    static function st_welcome_panel() {
        self::$view->render_view_admin('dashboard/welcome');
    }



    static function widget_statistique_inscription() {

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_inscrit';
        $table_ville = $wpdb->prefix. 'miss_ville';
        self::$view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);


        self::$view->inscrit_complet = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");


        self::$view->inscrit_par_ville = $wpdb->get_results($wpdb->prepare("SELECT ville, COUNT(id) as nbr  FROM $table_name WHERE %d GROUP BY ville", 1), ARRAY_A);
        self::$view->inscrit_par_age = $wpdb->get_results($wpdb->prepare("SELECT YEAR(CURDATE())-YEAR(dateNais) as Age, COUNT(id) as nbr FROM $table_name WHERE %d GROUP BY Age ", 1), ARRAY_A);



        self::$view->render_view_admin('dashboard/inscription');
    }

    static function widget_statistique_vote_general() {

        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_vote';
        self::$view->votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) as nbr FROM $table_name WHERE %d", 1));

        self::$view->render_view_admin('dashboard/votes');
    }

    static function widget_statistique_vote_quart(){

        global $wpdb;
        $table_vote = $wpdb->prefix. 'miss_vote';
        $table_inscrit = $wpdb->prefix. 'miss_inscrit';

        $table_ville = $wpdb->prefix. 'miss_ville';
        self::$view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        self::$view->votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) as nbr FROM $table_vote WHERE etape = %d", 2));

        self::$view->vote_par_ville = $wpdb->get_results($wpdb->prepare("SELECT COUNT(v.id) as nbr, c.ville  FROM $table_vote as v, $table_inscrit as c  WHERE v.idcandidat = c.id and v.etape = %d GROUP BY ville", 2));

        self::$view->phase = 2;

        self::$view->render_view_admin('dashboard/votes_quarts');
    }

    static function widget_statistique_vote_demi(){

        global $wpdb;
        $table_vote = $wpdb->prefix. 'miss_vote';
        $table_inscrit = $wpdb->prefix. 'miss_inscrit';

        $table_ville = $wpdb->prefix. 'miss_ville';
        self::$view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        self::$view->votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) as nbr FROM $table_vote WHERE etape = %d", 3));

        self::$view->vote_par_ville = $wpdb->get_results($wpdb->prepare("SELECT COUNT(v.id) as nbr, c.ville  FROM $table_vote as v, $table_inscrit as c  WHERE v.idcandidat = c.id and v.etape = %d GROUP BY ville", 3));

        self::$view->phase = 3;

        self::$view->render_view_admin('dashboard/votes_demi');
    }

    static function widget_statistique_vote_final(){

        global $wpdb;
        $table_vote = $wpdb->prefix. 'miss_vote';
        $table_inscrit = $wpdb->prefix. 'miss_inscrit';

        $table_ville = $wpdb->prefix. 'miss_ville';
        self::$view->villes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);

        self::$view->votes = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) as nbr FROM $table_vote WHERE etape = %d", 4));

        self::$view->vote_par_ville = $wpdb->get_results($wpdb->prepare("SELECT COUNT(v.id) as nbr, c.ville  FROM $table_vote as v, $table_inscrit as c  WHERE v.idcandidat = c.id and v.etape = %d GROUP BY ville", 4));

        self::$view->phase = 4;

        self::$view->render_view_admin('dashboard/votes_final');
    }


}