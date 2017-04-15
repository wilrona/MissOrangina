<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true);
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
    <link href="<?= plugins_url( 'assets/img/ico.png', PLUGINS_DIR_CURRENT ); ?>" rel="icon">
    <link rel="stylesheet" href="<?= plugins_url( 'assets/css/style.plugin.css', PLUGINS_DIR_CURRENT ); ?>">
    <link rel="stylesheet" href="<?= plugins_url( 'assets/css/custom.css', PLUGINS_DIR_CURRENT ); ?>">
    <script src="<?= plugins_url( 'assets/js/jquery-1.9.1.min.js', PLUGINS_DIR_CURRENT ); ?>" type="text/javascript"></script>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php
 $url = array('missorangina-cm.com');
    if(in_array($_SERVER['HTTP_HOST'], $url)){
        wp_redirect('http://www.missorangina-cm.com');
    }
?>
<div class="site-container">
    <div class="site-pusher">
        <header class="header">
            <div class="header_top">
                <div class="header_left pull-left m-show">
                    <a href="" class="header_icon  "  id="header_icon"></a>
                </div>
                <div class="header_left pull-left l-show" style="text-align:right;font-size: 1.2em;font-family: 'Flavour'; color:#004899">
                    <span><span class="btn btn-social btn-phone"><i class="fa fa-phone"></i> </span><span class="info"> Infoline: 695 95 95 70</span></span>
                </div>
                <div class="header_right pull-right">
                    <div class="s-show">
                        <a href="#" class="btn" data-toggle="modal" data-target="#myModal" data-backdrop="static"><i class="fa fa-share-alt fa-lg"></i></a>
                    </div>
                    <div class="s-hidden">
                        <ul class="ul-social ul-list-inline">
                            <li>	<a href="http://www.facebook.com/oranginacameroon" target="_blank" class="btn btn-social btn-facebook"><i class="fa fa-facebook-f"></i></a></li>
                            <li>	<a href="https://www.youtube.com/channel/UCAv3_bGI7ZrKCqDf59oin5Q" target="_blank" class="btn btn-social btn-twitter"><i class="fa fa-youtube-play"></i></a></li>
                        </ul>
                    </div>

                </div>
                <a href="<?php echo get_site_url(); ?>" class="header_logo"></a>

            </div>
            <div class="header_menu">
                <nav class="menu">
                    <h1 class="menu_title m-show">Miss Orangina 2017</h1>
                    <hr class="m-show">
                    <ul class="scroll">
                        <li><a href="<?php echo get_site_url(); ?>">		Accueil</a></li>
                        <li><a href="<?php echo get_site_url()."/propos"; ?>">		A propos</a></li>
                        <li><a href="<?php echo get_site_url()."/galerie-photo"; ?>">		Galerie</a></li>
                        <li><a href="<?php echo get_site_url()."/reglement"; ?>">		Règlement</a></li>
                    </ul>
                </nav>
                <span class="info l-hidden">Infoline: 695 95 95 70</span>
            </div>
        </header>
        <div class="site-content">