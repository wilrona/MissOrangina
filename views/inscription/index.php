<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 15:32
 */
?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
<style>
    .mbr-parallax-background{
        background-image: url("<?php echo get_template_directory_uri(); ?>/img/1280x689px_Miss_Orangina_Sans.jpg");
        background-color: transparent;
        background-size: cover;
        background-position: 50% 0px;
    }
    .info{
        color: #fff;
    }

    .info h2{
        background: rgb(10,26,114);
        padding: 10px;
        border-radius: 0 0 30px 30px;
        text-align: center;
        font-size: 35px;
        z-index: 2;
        position: relative;
    }

    .info ul li:before
    {
        content: '✔';
        margin-left: -48px;
        margin-right: 20px;
        color: yellow;
    }
    .info ul li{
        margin-bottom: 15px;
    }
    .info ul{
        border: 2px solid #fff;
        margin-top: -32px;
        border-top: none;
        padding: 10px;
        padding-top: 34px;
        font-size: 25px;
        border-radius: 0 0 30px 30px;
        padding-left: 70px;
        text-indent: 2px;
        list-style: none;
        list-style-position: outside;
        background: #4c6972;
        z-index: 0;
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

<section class="menu-1 mbr-fixed-top mbr-nav-collapse" id="menu-1">
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


<section class="mbr-box mbr-section mbr-section--full-height mbr-section--bg-adapted mbr-parallax-background" id="header2-1">



    <div class="mbr-box__magnet mbr-box__magnet--sm-padding mbr-box__magnet--center-right">
        <div class="mbr-overlay" style="opacity: 0; background-image: none; background-color: rgb(34, 34, 34);"></div>
        <div class="mbr-section__container container">
            <div class="mbr-box mbr-box--stretched"><div class="mbr-box__magnet mbr-box__magnet--center-left text1">

                    <div class="col-sm-6 info">

                        <h2>Conditions de participation</h2>
                            <ul>
                                <li>Tu es de nationalité camerounaise</li>
                                <li>Tu es âgée de 18 ans au moins et 25 ans au plus à la date du casting</li>
                                <li>Tu es célibataire</li>
                                <li>Tu n'as pas été antérieurement l 'égérie ou l'ambassadrice d'une autre marque</li>
                                <li>Tu n'as jamais fait l'objet de poursuites judiciaires</li>
                            </ul>

                    </div>
                    <div class="col-sm-6 info">
                        <h2>Lieux de casting</h2><br/>
                        <div class="list-group">
                            <?php if(!empty($this->lieu)): $count = 0;
                                foreach($this->lieu as $lieu): ?>
                                    <?php if($count > 0): ?>
                                        <hr/>
                                    <?php endif; ?>
                                    <div class="list-group-item active">
                                        <h1 class="list-group-item-heading"><?php echo $lieu['lieu'] ?> à <?php if($lieu['ville'] == "DLA"){
                                                echo 'Douala';
                                            }elseif($lieu['ville'] == "YDE"){
                                                echo 'Yaounde';
                                            }else{
                                                echo 'Buea';
                                            } ?></h1>
                                        <p class="list-group-item-text">
                                            <?php echo $lieu['datelieu']; if(!empty($lieu['heure'])):  ?> à partir de <?php echo $lieu['heure']; endif; ?>
                                        </p>
                                    </div>
                            <?php $count++; endforeach; endif; ?>
                        </div>
                    </div>
                    
            </div></div>
        </div>
        <div class="mbr-arrow--floating text-center  container ">
            <div class="mbr-section__container col-sm-12" style="">
                <a class="mbr-arrow__link btn btn-default btn-lg" href="<?php echo get_site_url()."/facebook"; ?>" data-toggle="modal" data-target="#myModal" data-backdrop="static" style="margin-bottom: 20px !important;">Inscris-toi</a>
            </div>
            <div class="col-sm-12" style="color: #fff; font-family: 'Flavour';">
                Infoline: 695 95 95 70
            </div>
        </div>
    </div>
</section>

