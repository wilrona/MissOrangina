<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 23/09/2015
 * Time: 18:07
 */

class Plugin_Dashboard{

    static $view;

    function __construct(){
        self::$view = new Plugin_View();
    }

    /**
     * Initalialisation du tableau de bord de ton application
     */
    public function initDashboard(){
        # Personnalisation du dashboard
        add_action('wp_dashboard_setup', array(__CLASS__, 'remove_dashboard_widgets') );
    }


    /**
     * Liste des elements du tableau de bord par defaut a initialiser
     */
    static function remove_dashboard_widgets()
    {
        global $wp_meta_boxes;

        // Tableau de bord général
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // Presse-Minute
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Commentaires récents
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Extensions
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // Liens entrant
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // Billets en brouillon
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // Blogs WordPress
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Autres actualités WordPress
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); // Active sur le site
    }


    /**
     * suppression des menus d'aide par default
     */
    static  function remove_contextual_help() {
        $ecran = get_current_screen();
        $ecran->remove_help_tabs ();
    }


    /**
     * Cette fonction execute la suppression de l'element d'aide par defaut de wordpress
     */
    static  function remove_help(){
        add_action('admin_head', array(__CLASS__,'remove_contextual_help'));
    }

    /**
     * Suppression du welcome page par default
     */
    static function remove_welcome(){
        remove_action('welcome_panel','wp_welcome_panel');
    }

    static function welcome_init(){
        add_action('after_switch_theme',array(__CLASS__,'st_welcome_init'));
    }

    # Affficher le panel welcome quand l'utilisateur se connecte
    static function st_welcome_init() {
        global $wpdb;
        $wpdb->update($wpdb->usermeta,array('meta_value'=>1),array('meta_key'=>'show_welcome_panel'));
    }





}