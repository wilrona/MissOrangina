<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 12:24
 */

namespace Controller\facebook;


use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Plugin_Controller;

require_once(plugin_dir_path(PLUGINS_DIR_CURRENT).'/vendor/Facebook/autoload.php');


class facebookController extends Plugin_Controller {

   public static $fb;

    function __construct(){
        parent::__construct();
    //    self::$fb = new Facebook([
    //            'app_id' => APPID,
    //            'app_secret' => APPSECRET,
    //            'default_graph_version' => APPVERS
    //        ]);
    }

//    function get_fb(){
//        return self::$fb;
//    }

    public function set_facebook(){
        $fb = new Facebook([
                'app_id' => APPID,
                'app_secret' => APPSECRET,
                'default_graph_version' => APPVERS
            ]);
        return $fb;
    }


    public function indexAction(){

        $fb = $this->set_facebook();
        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl('http://'. $_SERVER['HTTP_HOST'] .'/facebook/login_callback', $permissions);
        $this->view->login = $loginUrl;
        $this->view->render_view('facebook/index', true);
    }


    public function login_callbackAction(){
        $fb = $this->set_facebook();
        $helper = $fb->getRedirectLoginHelper();
        try{
            $accessToken = $helper->getAccessToken();
        }catch(FacebookResponseException $e){
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        }catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if(isset($accessToken)){
            $_SESSION['token_fb'] = (string) $accessToken;
            header('location:/inscription/like');
        }
        elseif ($helper->getError()) {
            session_destroy();
            header('location:/');
        }
    }


    public function vote_callbackAction($id){

        $fb = $this->set_facebook();
        $helper = $fb->getRedirectLoginHelper();
        try{
            $accessToken = $helper->getAccessToken();
        }catch(FacebookResponseException $e){
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        }catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $id = explode("?",$id);
//        print_r($id[0]);

        if(isset($accessToken)){
            $_SESSION['token_fb_vote'] = (string) $accessToken;
            header('location:/vote/voting/'.$id[0]);

        }
        elseif($helper->getError()) {
            header('location:/');
        }
    }

    public function profilAction($id){
        global $wpdb;
        $table_name = $wpdb->prefix.'miss_inscrit';
        $table_vote = $wpdb->prefix.'miss_vote';
        $candidat = $wpdb->get_row("SELECT *, YEAR(CURDATE())-YEAR(dateNais) as Age FROM $table_name WHERE id =".$id." ");

        $this->view->vote = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) as nbr FROM $table_vote WHERE etape = %d AND idcandidat = %d", $candidat->etape, $candidat->id));
        $this->view->candidat = $candidat;

        $helper = self::$fb->getRedirectLoginHelper();

        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl('http://'. $_SERVER['HTTP_HOST'] .'/facebook/vote_callback/'.$candidat->id, $permissions);
        $this->view->login = $loginUrl;

        $this->view->render_view('vote/profil', true);
    }

    public function voteAction($id){
        global $wpdb;
        $table_name = $wpdb->prefix.'miss_inscrit';

        $candidat = $wpdb->get_row("SELECT *, YEAR(CURDATE())-YEAR(dateNais) as Age FROM $table_name WHERE id =".$id." ");
        $this->view->candidat = $candidat;
        session_start();

        $fb = $this->set_facebook();
        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl('http://' . $_SERVER['HTTP_HOST'] .'/facebook/vote_callback/'.$candidat->id, $permissions);
        $this->view->login = $loginUrl;

        $this->view->render_view('vote/to_vote', true);

    }

}