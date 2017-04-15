<?php
ob_start();
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 20/09/2015
 * Time: 09:52
 */

require "List_View_Casting.php";

class Casting extends Plugin_AdminController{

    public  function __construct(){
        parent::__construct(__CLASS__, 'add_menu_casting');
    }

    static function add_menu_casting(){
        $menu = array(
            array(
                'page_title' => 'Liste des lieux',
                'menu_title' => 'Lieux',
                'capability' => 'publish_posts',
                'menu_slug' => PREFIX_PLUGINS_NAME."_casting",
                'function' => array(__CLASS__, 'IndexLieuCasting'),
                'icon_url' => 'dashicons-location',
                'position' => 6,
                'submenu' => array(
                    array(
                        'parent_slug' => PREFIX_PLUGINS_NAME."_casting",
                        'page_title' => 'Ajouter un lieu',
                        'menu_title' => 'Ajouter un lieu',
                        'capability' => 'publish_posts',
                        'menu_slug' => PREFIX_PLUGINS_NAME."_add_casting",
                        'function' => array(__CLASS__, 'FormCasting')
                    )
                )
            )
        );

        if(current_user_can('install_plugins')){
            parent::menu_page_admin($menu);
        }
    }


    public function IndexLieuCasting(){
        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_lieu';
        $item = $_REQUEST;
        if(isset($_REQUEST['passe']) && !empty($_REQUEST['passe'])){
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST["passe"]), ARRAY_A);
            if($item['passe'] == 0 || $item['passe'] == null){
                $result = $wpdb->update($table_name, array('passe' => 1), array('id' => $item["id"]));
            }else{
                $result = $wpdb->update($table_name, array('passe' => 0), array('id' => $item["id"]));
            }
            if($result){
                self::$view->message = "L'état du lieux a été modifié";
            }
            header('location:'.menu_page_url(PREFIX_PLUGINS_NAME."_casting", false ).'');
        }

        self::$view->render_view_admin("casting/index");
    }

    public function FormCasting(){


        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_lieu';
        $table_phase = $wpdb->prefix. 'miss_phase';
        $table_ville = $wpdb->prefix. 'miss_ville';

        $default = array(
              'id' => 0 ,
			  'ville' => null ,
			  'datelieu' => null ,
			  'heure' => null ,
			  'lieu' => null ,
            'etape' => null,
            'passe' => 0

        );

        if (wp_verify_nonce($_POST['nonce'], "casting_post")) {

            $item = shortcode_atts($default, $_POST);
            if($item["id"] == 0 || empty($item["id"])) {
                $result = $wpdb->insert($table_name, $item);
                $_REQUEST['id'] = $wpdb->insert_id;
                if($result) {

                    self::$view->message = "Votre lieu a été enregistré avec succes";

                } else {

                    self::$view->notice = "il y'a eu des erreurs lors de la sauvegarde de votre information";

                }

            }else{


                $wpdb->update($table_name, $item, array('id' => $item["id"]));

                self::$view->message = "Votre lieu a été mise à jour avec succès";


            }

        }




        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST["id"]), ARRAY_A);
            self::$view->item = $item;
            if(!$item){
                self::$view->item = $_REQUEST;
                self::$view->notice = "Information Introuvable";
            }
        }
        self::$view->ville = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_ville WHERE %d", 1), ARRAY_A);
        self::$view->phase = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_phase WHERE etape > %d", 0), ARRAY_A);

        self::$view->render_view_admin("casting/form");
    }
}
ob_end_flush();