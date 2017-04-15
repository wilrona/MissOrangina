<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 11:29
 */


class Plugin_Controller{

    function __construct(){
        // session_start();
        $this->view = new Plugin_View();
    }

    public function indexAction(){
        $this->view->render_view('default/index');
    }

    public function pageAction(){

        $this->view->render_view('default/page');
    }


    public function erreurAction(){
        $this->view->render_view('default/404');
    }

}