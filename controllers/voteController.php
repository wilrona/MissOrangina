<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 22/10/2015
 * Time: 15:39
 */

namespace Controller\vote;

use Controller\facebook\facebookController;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

use Plugin_Controller;

require "facebookController.php";

class VoteController extends Plugin_Controller{

    public static $fbs;
    function __construct(){
        parent::__construct();
        $fbs = new facebookController();
        self::$fbs = $fbs->set_facebook();
    }

    public function votingAction($id){

        global $wpdb;
        $table_name = $wpdb->prefix.'miss_inscrit';
        $table_vote = $wpdb->prefix.'miss_vote';
        $table_mail = $wpdb->prefix.'miss_parrain';

        if(isset($_SESSION) && isset($_SESSION['token_fb_vote'])) {

            self::$fbs->setDefaultAccessToken($_SESSION['token_fb_vote']);

            $response = self::$fbs->get('/me?locale=en_US&fields=id,email');
            $userNode = $response->getGraphUser();

            $candidat = $wpdb->get_row("SELECT * FROM $table_name WHERE id = " . $id);
            $count_vote_candidat_user = $wpdb->get_var(
                "SELECT COUNT(*) FROM $table_vote WHERE idfacebook = '" . $userNode->getField(
                    'id'
                ) . "' AND etape = " . $candidat->etape
            );
            if ($count_vote_candidat_user) {
                header('location:/vote/status');
            } else {
                $result = $wpdb->insert(
                    $table_vote,
                    array(
                        'idcandidat' => $id,
                        'idfacebook' => $userNode->getField('id'),
                        'etape' => $candidat->etape
                    )
                );
                if ($result) {
                    $exist_email = $wpdb->get_var(
                        "SELECT COUNT(*) FROM $table_mail WHERE email = '" . $userNode->getField('email') . "'"
                    );
                    if ($exist_email == 0) {
                        $wpdb->insert($table_mail, array('email' => $userNode->getField('email'), 'parrain' => false));
                    }
                    header('location:/vote/confirmation');
                }
            }
        }else{
            session_destroy();
            header("location:/");
        }
    }

    public function confirmationAction(){
        $this->view->render_view('vote/confirmation');
    }

    public function statusAction(){
        $this->view->render_view('vote/status');
    }
}