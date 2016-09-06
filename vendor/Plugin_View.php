<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 11:32
 */

class Plugin_View{


    public  function render_view($name, $noinclude = false){

        if($noinclude == true){

            $route = ABSPATH .'wp-content/plugins/MissOrangina/views/'.$name.'.php';
            require_once($route);

        }else{

            $header = ABSPATH .'wp-content/plugins/MissOrangina/views/header.php';
            if(file_exists($header)) {
                require_once($header);
            }
            else{
                get_header();
            }

            $route = ABSPATH .'wp-content/plugins/MissOrangina/views/'.$name.'.php';
            require_once($route);

            $footer = ABSPATH .'wp-content/plugins/MissOrangina/views/footer.php';
            if(file_exists($footer)){
                require_once($footer);
            }else{
                get_footer();
            }
        }
    }

    public  function render_view_admin($name){

            $route = ABSPATH .'wp-content/plugins/MissOrangina/views/admin/'.$name.'.php';
            require_once($route);

    }

    public function url_for($var){
        $the_helper = new Plugin_Helpers();
        $my_helper = $the_helper->url_site($var);
        return $my_helper;
    }


    public function list_view($object){
        $receive_object = new $object;
        return $receive_object;
    }
}