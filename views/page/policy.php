<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 15/09/2015
 * Time: 12:00
 */

?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sandbox.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animsition.min.css">

<style>
    .bg-yellow1 {
        padding-top: 40px;
    }

    h2#col{
        text-decoration: underline;
        font-size: 25px;
    }


    #menu-1 .nav > li > a:after{
        background-color: #fff !important;
    }

    .nav > li > a, .nav > li > a:hover, .nav > li > a:focus{
        color: #fff;
    }
    .menu-1 nav li.facebook a:after {
        background: none;
    }

    .glyphicon-facebook:before{
        content: url(<?php echo plugins_url('assets/img/icone-facebook-100x100.png', ABSPATH . 'wp-content/plugins/MissOrangina/assets'); ?>)
    }

    .glyphicon-facebook:hover:before{
        content: url(<?php echo plugins_url('assets/img/icone-facebook-300x300-hover.png', ABSPATH . 'wp-content/plugins/MissOrangina/assets'); ?>)
    }
</style>

<div class="animsition item bg-yellow" data-animsition-in="fade-in-up-sm" data-animsition-out="fade-out-up-sm" data-animsition-in-duration="2000">
    <section class="menu-1 mbr-fixed-top mbr-nav-collapse" id="menu-1" style="
    position: absolute;
    right: 100px;
    font-size: 20px;
    color: #fff;
    z-index: 2;
">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="brand">
                        <span class="mbr-nav-toggle"></span>
                    </div>
                    <nav>
                        <ul class="nav nav-pills pull-right">
                            <li><a href="<?php echo get_site_url(); ?>" class="">Accueil</a></li>
                            <li><a href="<?php echo get_site_url()."/page/propos"; ?>">A Propos</a></li>
                            <li class="facebook"><a href="https://www.facebook.com/oranginacameroon" target="_blank"><span class="glyphicon glyphicon-facebook" style="margin-top: -4px;"></span></a></li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <h1 id="logo"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Miss orangina"/></a> </h1>
</div>

<div class="animsition item3 bg-yellow1" data-animsition-in="fade-in-down-sm" data-animsition-out="fade-out-down-sm" data-animsition-in-duration="3000">
    <h1 id="logo">Notre <span id="col">Politique de confidentialité</span>.</h1>

    <div class="container" id="logo">
        <div class="text1" style="width: 100%; font-size: 20px; text-align: left;">
            <h2 id="col">Collecte des renseignements personnels</h2>
           <p>
               Nous collectons les renseignements suivants : (cette liste n’est pas exhaustive)
           </p>
            <ul>
                <li>Nom</li>
                <li>Prenom</li>
                <li>Adresse postal</li>
                <li>Code postal</li>
                <li>Adresse Electronique</li>
                <li>Numero de telephone / telecopieur</li>
                <li>Age</li>
                <li>Profession</li>
            </ul>

            <p>
                Les renseignements personnels que nous collectons sont recueillies au travers du formulaire d’inscription à ce concours et grâce à l'interactivité́ établie entre vous et le <span id="col">concours Miss Orangina</span>.
                Aucune information transmise ne sera utilisée hors de ce concours sans votre autorisation  préalable.

            </p>



        </div>

    </div>


</div>


<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.animsition.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        var $animsition = $('.animsition');
        $animsition
            .animsition()
            .one('animsition.start', function () {
                $(this).append('');
                console.log('');
            })
            .one('animsition.end', function () {
                $('.target', this).html('');
                console.log('');
            });
    });
</script>