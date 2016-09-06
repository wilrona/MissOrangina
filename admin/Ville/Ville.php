<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/10/2015
 * Time: 12:15
 */

require "List_View_Ville.php";

class Ville extends Plugin_AdminController{
    public  function __construct(){
        parent::__construct(__CLASS__, 'add_menu_casting');
    }
    public function add_menu_casting(){
        $menu = array(
            array(
                'submenu' => array(
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_casting",
                        'page_title' => 'Gerer les villes',
                        'menu_title' => 'Gerer les villes',
                        'capability' => 'publish_posts',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_add_ville",
                        'function' => array(__CLASS__, 'listeVille')
                    )
                )
            )
        );

        if(current_user_can('install_plugins')){
            parent::menu_page_admin($menu);
        }
    }
    public function ListeVille(){
        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_ville';
        if(wp_verify_nonce($_POST['nonce'], "ville_create_update") && isset($_POST['action']) && $_POST['action'] == 'add-ville'){
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $wpdb->update($table_name, array('id' => $_POST['id'], 'ville' => $_POST['ville'], 'abreviation' => $_POST['abreviation']), array('id' => $_POST['id']));
            }else{
                $wpdb->insert($table_name, array('ville' => $_POST['ville'], 'abreviation' => $_POST['abreviation']));
            }
            header('location:'.menu_page_url(PREFIX_PLUGINS_NAME."_add_ville", false ));
        }
        if(isset($_REQUEST['id'])){
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST["id"]), ARRAY_A);
            self::$view->item = $item;
            if(!$item){
                self::$view->item = $_REQUEST;
                self::$view->notice = "Information Introuvable";
            }
        }
        self::$view->render_view_admin("ville/index");
    }

}