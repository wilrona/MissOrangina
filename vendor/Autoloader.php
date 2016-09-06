<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 14:22
 */

class Autoloader{

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class_name){

        $route = ABSPATH .'wp-content/plugins/MissOrangina/vendor/'.$class_name.'.php';
        if(file_exists($route)){
            require_once($route);
        }

        $route = ABSPATH .'wp-content/plugins/MissOrangina/vendor/'.$class_name.'/'.$class_name.'.php';
        if(file_exists($route)){
            require_once($route);
        }

        $route = ABSPATH .'wp-content/plugins/MissOrangina/admin/'.$class_name.'/'.$class_name.'.php';
        if(file_exists($route)){
            require_once($route);
        }

//        $route = ABSPATH .'wp-content/plugins/MissOrangina/config/'.$class_name.'.php';
//        if(file_exists($route)){
//            require_once($route);
//        }
    }
}
