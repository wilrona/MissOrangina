<?php

/*
Plugin Name: Miss Orangina
Description: Plugin pour le concours Miss Orangina
Version: 1.0
Author: Ndi Ronald Steve
License: A "Slug" license name e.g. GPL2
*/

ob_start();


#creation des tables de la base de donnee
require "config/DataTable.php";

register_activation_hook(__FILE__, array('DataTable', 'create_datatable_MissOrangina'));

define('PREFIX_PLUGINS_NAME', 'missorangina');
define('PLUGINS_DIR_CURRENT', __FILE__);
define('URL_ASSET', ABSPATH .'wp-content/plugins/MissOrangina/assets/');
define('APPID', '1186368814711610');
define('APPSECRET', '66b579d4e8441d68949dd30e9e4636f7');
define('APPVERS', 'v2.4');




//# ajouter son propre panneau d'aide
//add_action('in_admin_header', 'wpse_124979_add_help_tabs');
//
//function wpse_124979_add_help_tabs() {
//    if ($screen = get_current_screen()) {
//        $help_tabs = $screen->get_help_tabs();
//        $screen->remove_help_tabs();
//
//        $screen->add_help_tab(array(
//                'id' => 'my_help_tab',
//                'title' => 'My Help',
//                'content' => '<p>My help content...</p>',
//            ));
//
//        if(count($help_tabs))
//            foreach ($help_tabs as $help_tab)
//                $screen->add_help_tab($help_tab);
//    }
//}

#intialisation de mon autoloader
require "vendor/Autoloader.php";
Autoloader::register();

# envoie dans le header du fichier css pour notre template
$bootstrap = new Plugin_Bootstrap();
$bootstrap->exe_footer_admin();


if(is_admin()){
    wp_enqueue_script('bootstrapjs', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ), array(), "1.0.0", true);
    wp_enqueue_script('inputdata1', plugins_url( 'assets/js/inputmask.js', __FILE__ ), array(), "1.0.0", true);
    wp_enqueue_script('inputdata2', plugins_url( 'assets/js/jquery.inputmask.js', __FILE__ ), array(), "1.0.0", true);
    wp_enqueue_script('inputdata3', plugins_url( 'assets/js/jquery.inputmask.bundle.min.js', __FILE__ ), array(), "1.0.0", true);
    wp_enqueue_script('customjs', plugins_url( 'assets/js/script.js', __FILE__ ), array(), "1.0.0", true);
}

//# Supprimer les menus dans l'interface admin
function remove_menu_pages() {
    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php');
//    remove_menu_page('edit.php?post_type=page');
    remove_menu_page('upload.php');
    remove_menu_page('tools.php');
}
add_action('admin_menu', 'remove_menu_pages' );

//$menu[0]
// $submenu['themes.php'][10]
// $submenu['ms-admin.php'][1] = manage_network
// $submenu['ms-admin.php'][5] = manage_sites
// $submenu['ms-admin.php'][10] = manage_network_users
// $submenu['ms-admin.php'][20] = manage_network_themes
// $submenu['ms-admin.php'][25] = manage_network_options
// $submenu['ms-admin.php'][30] = manage_network
//$menu[1] = Séparateur
//$menu[2] = Dashboard
// $submenu['index.php'][0] = Dashboard
// $submenu['index.php'][5] = My Sites
// $submenu['index.php'][10] = Updates
//$menu[4] = Séparateur
//$menu[5] = Posts
// $submenu['edit.php'][5]  = Posts
// $submenu['edit.php'][10]  = Add New
//$submenu['edit.php'][$i++] = taxonomy (mots clés, catégories, ...)
//$menu[10] = Media
// $submenu['upload.php'][5] = Library
// $submenu['upload.php'][10] = Add New
//$menu[15] = Links
// $submenu['link-manager.php'][5] = Links
// $submenu['link-manager.php'][10] = Add New
//$submenu['link-manager.php'][15] = Link Categories
//$menu[20] = Pages
// $submenu['edit.php?post_type=page'][5] = Pages
// $submenu['edit.php?post_type=page'][10] = Add New
//$submenu['edit.php?post_type=page'][$i++] = taxonomy (aucune par défaut))
//$menu[25] = Comments
////Vos taxonomies
//$menu[$ptype_menu_position] = Nom de la taxonomie
// $submenu["edit.php?post_type=$ptype"][5]  = Nom de la taxonomie
// $submenu["edit.php?post_type=$ptype"][10]  = Add New
//$submenu["edit.php?post_type=$ptype"][$i++] = taxonomy
//$menu[59] = Séparateur
//$menu[60] = Appearance
// $submenu['themes.php'][5]  = Themes
// $submenu['themes.php'][10] = Menus
//$menu[65] = Plugins
// $submenu['plugins.php'][5]  = Plugins
// $submenu['plugins.php'][10] = Add New
//$submenu['plugins.php'][15] = Editor
//// si l'utilisateur a des droits d'administrateur
//$menu[70] = Users
// $submenu['users.php'][5] = Users
// $submenu['users.php'][10] = Add New
//$submenu['users.php'][15] = Your Profile
//// si l'utilisateur n'a pas les droits d'administrateur
//$menu[70] = Profile
// $submenu['profile.php'][5] = Your Profile
// $submenu['profile.php'][10] = Add New User
//$menu[75] = Tools
// $submenu['tools.php'][5] = Tools
// $submenu['tools.php'][10] = Import
// $submenu['tools.php'][15] = Export
// $submenu['tools.php'][25] = Delete Site
// $submenu['tools.php'][50] = Network
//$menu[80] = Settings
// $submenu['options-general.php'][10] = General
// $submenu['options-general.php'][15] = Writing
// $submenu['options-general.php'][20] = Reading
// $submenu['options-general.php'][25] = Discussion
// $submenu['options-general.php'][30] = Media
// $submenu['options-general.php'][35] = Privacy
// $submenu['options-general.php'][40] = Permalinks
//$menu[99] = Séparateur

//supprimer le sous menu "dashboard-> mise a jour"
function remove_submenu() {
    global $submenu;
    global $menu;
    unset($submenu['index.php'][10]);
    unset($menu[4]);
}
add_action('admin_head', 'remove_submenu');


# Supprimer les elements de la bar d'admin qui apparrait tout en haut
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
//    $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
//    $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
//    $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab

}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


#initalisation de la classe de gestion des routes
# il prend en parametre true ou false
#       true: par default, il permet de prendre le controle de la homepage est decident d'en creer un
#               a partir du plugin. Exemple: Nous voulons que notre plugin initialise une page d'accueil
#       false: si nous vonlons laisser la gestion du homepage au theme en cours
new Plugin_Route('index');

# initalisation des interfaces de gestion pour l'administrateur
new Dashboard();
new Phase();
new Inscrit();
new Casting();
new Ville();