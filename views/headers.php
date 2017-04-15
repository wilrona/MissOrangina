<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true);
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="<?= plugin_dir_url( 'assets/css/bootstrap.min.css', __FILE__ ) ?>">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/style.plugin.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/mbr-additional.css">

    <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>