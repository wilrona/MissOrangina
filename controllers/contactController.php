<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/10/2015
 * Time: 19:06
 */

namespace Controller\contact;


use Plugin_Controller;

class ContactController extends Plugin_Controller{


    function __construct()
    {
        parent::__construct();

    }


    public function indexAction(){
        if (wp_verify_nonce($_POST['nonce'], "contact") && isset($_POST)){
            $msg = "<html><body>";
            $msg .= "Bonjour,<br>";
            $msg .= "Vous avez un message en provenance du site Miss Orangina. <br><br>";
            $msg .= "Le message est de <b> ".$_POST['name']."</b> avec pour adresse email <b>".$_POST['email']."</b>. <br><br>";
            $msg .= '<b>Contenu du message :</b><br>';
            $msg .= '<p>'.$_POST['message'].'</p><br>';
            $msg .= "Le site Miss Orangina";
            $msg .= "</html></body>";

            $header = "From: formulaire.contact@missorangina-cm.com\r\n";
            add_filter('wp_mail_content_type',array(__CLASS__, 'set_html_content_type'));
            add_filter( 'wp_mail_from_name', array(__CLASS__,'custom_wp_mail_from_name') );

            wp_mail('contact@missorangina-cm.com', 'Contact depuis le site Miss Orangina', $msg, $header);

            remove_filter ('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
            header('location:/contact/confirmation');
        }else{
            header('/');
        }
    }

    public function confirmationAction(){
        $this->view->render_view('contact/confirmation');
    }

    public function set_html_content_type(){
        return 'text/html';
    }

    function custom_wp_mail_from_name( $original_email_from ) {
        return 'Le site Miss Orangina';
    }
}
