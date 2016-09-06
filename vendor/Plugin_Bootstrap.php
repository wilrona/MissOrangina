<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 13:44
 */

class Plugin_Bootstrap extends Plugin_AdminController{

    function __construct(){
//        add_action('send_headers', array( __CLASS__, 'site_router' ));
        add_action('admin_enqueue_scripts',  array( __CLASS__, 'material_style_miss_orangina'));
        add_action('login_enqueue_scripts',  array( __CLASS__, 'material_style_miss_orangina'));

            add_action('admin_enqueue_scripts', array( __CLASS__, 'site_router' ));

    }

    # Ajout des elements de dashboard
    public function site_router(){
        wp_enqueue_style('dashboard');
        wp_print_styles('dashboard');
        wp_enqueue_script('dashboard');
        wp_print_scripts('dashboard');
        wp_enqueue_script('editor-expand');
        wp_enqueue_media();
    }

    # Ajout de mon template Admin
    function material_style_miss_orangina() {
        wp_enqueue_style('material-theme', plugins_url('assets/css/admin/material.css', ABSPATH . 'wp-content/plugins/MissOrangina/assets'));
        wp_enqueue_style('material-raleway', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700');
    }

    function right_admin_footer_text_output($text) {
        $text = 'Version 1.0';
        return $text;
    }

    # Modification du pied de page de l'admin du site pour decrire l'auteur
    function remove_footer_admin()
    {
        echo 'Realisee par accent com';
    }

    function exe_footer_admin(){
        add_filter('admin_footer_text', array(__CLASS__,'remove_footer_admin'));
        add_filter('update_footer', array(__CLASS__, 'right_admin_footer_text_output'), 11);
    }
}