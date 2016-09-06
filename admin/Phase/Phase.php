<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 21:03
 */

require "List_View_Phase.php";

class Phase extends Plugin_AdminController{

    public function __construct(){
        parent::__construct(__CLASS__, "add_menu_phase");
    }

    public function add_menu_phase(){
        $menu = array(
            array(
                'page_title' => 'Les phases du concours',
                'menu_title' => 'Phase concours',
                'capability' => 'publish_posts',
                'menu_slug' => PREFIX_PLUGINS_NAME."_phase",
                'function' => array(__CLASS__, 'IndexPhase'),
                'icon_url' => 'dashicons-networking',
                'position' => 3
            )
        );

        if(current_user_can('install_plugins')) {
            parent::menu_page_admin($menu);
        }
    }


    /*
     * Debut des actions de nos vues
     */
    public function IndexPhase(){
        global $wpdb;
        $table_name = $wpdb->prefix.'miss_phase';
        $default = array(
            'action_active' => 0
        );

        $data = array(
            'active' => null,
            'used' => 0
        );


        if(isset($_REQUEST['action_active']) && !empty($_REQUEST['action_active'])){
            $item = shortcode_atts($default, $_REQUEST);
            $current_items = $wpdb->get_row("SELECT active, etape, used FROM $table_name WHERE id = ".$item['action_active']."");
            if (!empty($current_items)){
                if($current_items->etape == 0){
                    $etape = $current_items->etape + 1;
                    $count_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE etape > {$etape} AND active = 1");

                    if($count_items == 0){
                        if($current_items->active == true){
                            $data['active'] = false;
                            $data['used'] = 1;
                            $last_used = $wpdb->get_row("SELECT * FROM $table_name WHERE used = 1");
                            $wpdb->update($table_name, array('used' => 0), array('id' => $last_used->id));
                        }else{
                            $data['active'] = true;
                            $data['used'] = 0;
                        }
                        $result = $wpdb->update($table_name, $data, array('id' => $item["action_active"]));

                        if($result){

                            self::$view->message = "Votre phase a été mise à jour avec succès";

                        }else{

                            self::$view->notice = "il y'a eu des erreurs lors de la mise à jour de votre information";
                        }
                    }else{
                        self::$view->notice = "Une phase superieure a la phase de casting est active";
                    }

                }else{
                    $etape_sup = $current_items->etape;
                    $etape_inf = $current_items->etape - 1;

                    $count_items_inf = $wpdb->get_row("SELECT * FROM $table_name WHERE etape = {$etape_inf}");

                    $count_items_sup = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE etape > {$etape_sup} AND active = 1");
                    $save = false;
                    if($count_items_inf->active == true){
                        if($count_items_sup == 0){
                            $count_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE active = 1 AND  etape <= $count_items_inf->etape");
                            if($count_items > 1){
                                self::$view->notice = "Des phases inferieures (02) sont actives";
                            }else{
                                $save = true;
                            }
                        }else{
                            self::$view->notice = "Une phase superieure a la phase suivante est active";
                        }
                    }else{
                        if($count_items_sup != 0){
                            if($current_items->active == true){
                                $save = true;
                            }else{
                                self::$view->notice = "Une phase superieure a la phase suivante est active";
                            }

                        }else{
                            $count_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE active = 1 AND etape < $count_items_inf->etape");
                            if($count_items >= 1){
                                self::$view->notice = "La phase precedente n'est pas actives";
                            }else{
                                $save = true;
                            }
                        }
                    }


                    if($save == true){
                        if($current_items->active == true){
                            $data['active'] = false;
                            $data['used'] = 1;
                            $last_used = $wpdb->get_row("SELECT * FROM $table_name WHERE used = 1");
                            $wpdb->update($table_name, array('used' => 0), array('id' => $last_used->id));
                        }else{
                            $data['active'] = true;
                            $data['used'] = 0;
                        }
                        $result = $wpdb->update($table_name, $data, array('id' => $item["action_active"]));

                        if($result){

                            self::$view->message = "Votre phase a été mise à jour avec succès";

                        }else{

                            self::$view->notice = "il y'a eu des erreurs lors de la mise à jour de votre information";
                        }
                    }

                }

            }
        }

        self::$view->render_view_admin("phase/index");
    }
}