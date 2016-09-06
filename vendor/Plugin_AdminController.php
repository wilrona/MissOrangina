<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 20:33
 */



class Plugin_AdminController{

    static $view;

    public function __construct($class, $slug){
        add_action('admin_menu', array($class, $slug));
        self::$view = new Plugin_View();
    }

    /**
     * les memes parametres que la fonction add_menu_page pour le menu de la page
     *      no_menu_page: est un boolean pour activer/desactiver l'initialisation unique des sous menus
     * les memes parametres que la fonction add_submenu_page pour les sous menus
     *      submenu: est un tableau des sous menus que nous voulons initialiser
     * @param array $items
     */
    public function menu_page_admin($items = array()){
        foreach ($items as $item){
            if(!isset($item['no_menu_page']) || $item['no_menu_page'] == false){
                add_menu_page($item['page_title'], $item['menu_title'], $item['capability'], $item['menu_slug'], $item['function'], $item['icon_url'], $item['position']);
            }
            if(!empty($item['submenu']) && is_array($item['submenu'])){
                foreach($item['submenu'] as $sub_item){
                    add_submenu_page($sub_item['parent_slug'], $sub_item['page_title'], $sub_item['menu_title'], $sub_item['capability'], $sub_item['menu_slug'], $sub_item['function']);
                }
            }
        }
    }

    function set_thickbox(){
        add_action("admin_print_scripts", array(__CLASS__, 'js_libs'));
        add_action("admin_print_styles", array(__CLASS__, 'style_libs'));
    }


    function js_libs() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('thickbox');
    }

    function style_libs() {
        wp_enqueue_style('thickbox');
    }




}