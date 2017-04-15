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

    public function __construct($set = "", $var = true){

//        add_action( 'wp', array( __CLASS__, 'plugin_routing_with_home' ) );
        if($var == true){
            add_action('wp',array( __CLASS__, 'plugin_routing_with_home' ));
        }else{
            add_action('send_headers',array( __CLASS__, 'plugin_routing_without_home' ));
        }

        self::$setController = "";
        if(!empty($set)){
            self::$setController = $set;
        }

    }

    static  function checking(){
        if(is_page()){
            self::$page = 1;
        }
        print_r(self::$page);
    }


    static  function plugin_routing_with_home()
    {
        global $pagenow;
        if ("index.php" == $pagenow) {
            $route = str_replace($pagenow, '', $_SERVER ['SCRIPT_NAME']);

            if ($route != '/wp-admin/') {
                $url = array_filter(self::explode_uri());
                if(empty($url[0])):

                    if(!empty(self::$setController)){
                        $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'controllers/'.self::$setController.'Controller.php';
                        require_once($file);
                        $class = self::$setController . "Controller";
                        $controller = new $class();
                        $controller->indexAction();
                    }else{
                        $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'vendor/Plugin_Controller.php';
                        require_once($file);
                        $controller = new Plugin_Controller();
                        $controller->indexAction();
                    }
                    die();

                else:

                    $file = plugin_dir_path(PLUGINS_DIR_CURRENT).'controllers/' . $url[0] . 'Controller.php';

                    if (file_exists($file)):
                        require_once($file);
                        $class = "\\Controller\\".$url[0] . "\\".$url[0] . "Controller";
                        $controller = new $class;
                        if(isset($url[1])):
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
                                    $action = "erreurAction";
                                    $controller->{$action}();
                                    die();
                                }
                            }
                        else:
                            $action = "indexAction";
                            $controller->{$action}();
                            die();
                        endif;

                    else:
                    
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

                    endif;

                endif;


            }
        }
    }



    static  function plugin_routing_without_home()
    {
        global $pagenow;
        if ("index.php" == $pagenow) {
            $route = str_replace($pagenow, '', $_SERVER ['SCRIPT_NAME']);
            if ($route != '/wp-admin/') {

                $url = array_filter(self::explode_uri());

                if($url):

                    // condition special pour un site multilangue. Ne derange pas pour un fonction monolangue du siteweb
                    if(count($url) > 1 && ($url[0] == 'fr' || $url[0] == 'en')):
                        $i = 1;
                        foreach($url as $uri):
                            if($i < count($url)):
                                $url[$i-1] = $url[$i];
                            else:
                                $url[$i-1] = null;
                            endif;
                            $i = $i + 1;
                        endforeach;

                    endif;

                    $file = NAME_FOLDER_PLUGIN . 'controllers/' . $url[0] . 'Controller.php';

                    if (file_exists($file)):
                        require_once($file);
                        $class = $url[0] . "Controller";
                        $controller = new $class;

                        if (isset($url[1])):
                            $action = $url[1]."Action";

                            if (isset($url[2])):
                                if(method_exists($controller, $url[1])):
                                    $controller->{$action}($url[2]);
                                    die();
                                endif;
                            else:

                                if(method_exists($controller, $url[1])):
                                    $controller->{$action}();
                                    die();
                                endif;
                            endif;
                        else:
                            $action = "indexAction";
                            $controller->{$action}();
                            die();
                        endif;

                    endif;
                endif;
            }
        }
    }

    static  function explode_uri() {
        $route = str_replace('index.php', '', $_SERVER ['SCRIPT_NAME']);
        $url = ltrim(trim($_SERVER ['REQUEST_URI']), $route);
        return explode('/', $url);
    }

}