<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 08:03
 */


class Plugin_Route{

    static $setController;
    static $page = 0;

    function __construct($set = "", $var = true){

        add_action( 'wp', array( __CLASS__, 'plugin_routing_with_home' ) );
        if($var == true){
            add_action('init',array( __CLASS__, 'plugin_routing_with_home' ));
        }else{
            add_action('init',array( __CLASS__, 'plugin_routing_without_home' ));
        }

        self::$setController = "";
        if(!empty($set)){
            self::$setController = $set;
        }

    }



    public function checking(){
        if(is_page()){
            self::$page = 1;
        }
        print_r(self::$page);
    }


    public function plugin_routing_with_home()
    {
        global $pagenow;


        if ("index.php" == $pagenow) {
            $route = str_replace($pagenow, '', $_SERVER ['SCRIPT_NAME']);
            if ($route != '/wp-admin/') {
                $url = array_filter(self::explode_uri());
                $first_param = explode("?",$url[0]);

                $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'controllers/' . $first_param[0] . 'Controller.php';
                if (file_exists($file)) {
                    require_once($file);
                    $class = "\\Controller\\".$first_param[0] . "\\".$first_param[0] . "Controller";
                    $controller = new $class;
                    $action = explode("?",$url[1]);
                    $action = $action[0]."Action";
                    if (isset($url[2])) {

                        if(method_exists($controller, $action)) {

                            $controller->{$action}($url[2]);
                            die();
                        }

                    } else {
                        if (isset($url[1])) {
                            if(method_exists($controller, $action)) {
                                $controller->{$action}();
                                die();
                            }
                        }else{
                            $action = "IndexAction";
                            $controller->{$action}();
                            die();
                        }
                    }
                } elseif (empty($url[0])) {
                    if(!empty(self::$setController)){
                        $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'controllers/'.self::$setController.'Controller.php';
                        require_once($file);
                        $controller = new IndexController();
                        $controller->indexAction();
                    }else{
                        $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'vendor/Plugin_Controller.php';
                        require_once($file);
                        $controller = new Plugin_Controller();
                        $controller->indexAction();
                    }
                    die();
                }elseif($url[0]){
                    if(is_page()){
                        $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'controllers/pageController.php';
                        if(file_exists($file)){
                            require_once($file);
                            $class = "\\Controller\\page\\pageController";
                            $page = new $class;
                            $action = $url[0]."Action";
                            if(method_exists($page, $action)){
                                $page->{$action}();
                                die();
                            }else{
                                if(is_page($url[0])){
                                    $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'vendor/Plugin_Controller.php';
                                    require_once($file);
                                    $controller = new Plugin_Controller();
                                    $controller->pageAction();
                                    die();
                                }else{
                                    $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'vendor/Plugin_Controller.php';
                                    require_once($file);
                                    $controller = new Plugin_Controller();
                                    $controller->erreurAction();
                                    die();
                                }

                            }
                        }else{
                            $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'vendor/Plugin_Controller.php';
                            require_once($file);
                            $controller = new Plugin_Controller();
                            $controller->pageAction();
                            die();
                        }

                    }

                    if(is_404()){
                        $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'vendor/Plugin_Controller.php';
                        require_once($file);
                        $controller = new Plugin_Controller();
                        $controller->erreurAction();
                        die();
                    }
                }
            }
        }
    }



    public function plugin_routing_without_home()
    {
        global $pagenow;
        if ("index.php" == $pagenow) {
            $route = str_replace($pagenow, '', $_SERVER ['SCRIPT_NAME']);
            if ($route != '/wp-admin/') {

                $url = array_filter(self::explode_uri());

                $file = ABSPATH . 'wp-content/plugins/MissOrangina/controllers/' . $url[0] . 'Controller.php';
                if (file_exists($file)) {
                    require_once($file);
                    $class = $url[0] . "Controller";
                    $controller = new $class;
                    $action = $url[1]."Action";
                    if (isset($url[2])) {
                        if(method_exists($controller, $url[1])) {
                            $controller->{$action}($url[2]);
                            die();
                        }
                    } else {
                        if (isset($url[1])) {
                            if(method_exists($controller, $url[1])) {
                                $controller->{$action}();
                                die();
                            }
                        }else{
                            $action = $url[0]."Action";
                            $controller->{$action}();
                            die();
                        }
                    }
                }
            }
        }
    }

    public function explode_uri() {
        $route = str_replace('index.php', '', $_SERVER ['SCRIPT_NAME']);
        $url = ltrim(trim($_SERVER ['REQUEST_URI']), $route);
        return explode('/', $url);
    }

}