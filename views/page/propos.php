<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/09/2015
 * Time: 22:59
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
    <h1 id="logo"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Miss orangina"/> </a></h1>
</div>

<div class="animsition item3 bg-yellow1" data-animsition-in="fade-in-down-sm" data-animsition-out="fade-out-down-sm" data-animsition-in-duration="3000">
    <h1 id="logo">A PROPOS DE <span id="col">MISS ORANGINA 2015</span>.</h1>

    <div class="container" id="logo" style="height: 560px; overflow-y: auto;">
        <div class="text1" style="width: 100%; font-size: 20px; text-align: left;">
            <h2 id="col"> Le Concept</h2>
            <ul>
                <li>
                    <span id="col">Miss ORANGINA</span> est un concours de Miss, organisé pour les jeunes filles urbaines, camerounaises,  allant de <span id="col">18 ans</span> au moins et à <span id="col">25 ans</span> au plus à la date du casting
                </li>
                <li>
                    Le concours a pour but de désigner <span id="col">la jeune fille la plus représentative</span> des valeurs essentielles de la marque <span id="col">ORANGINA</span>

                </li>
                <li>A savoir : La <span id="col">beauté naturelle</span> (Teint et rondeurs africains), l’<span id="col">originalité</span> (Talents, culture),  et  <span id="col">le prestige</span> (chic et et élégance)</li>

            </ul>
            <h2 id="col">Période de la compétition</h2>
            <p>Du 14 octobre au 12 décembre 2015</p>
            <h2 id="col">Etapes de la compétition</h2>
            <p>Les Casting, ¼ de finale,½ Finale se dérouleront à Douala, Bafoussam et Yaoundé du 14 octobre au 05 décembre 2015
                La finale aura lieu à Douala pendant le  12 décembre 2015.
            </p>
            <?php if(!empty($this->lieu)): ?>
            <h2 id="col">Lieu des castings</h2>
            <p>
                <ul>
                    <?php foreach($this->lieu as $lieu): ?>
                    <li>
                        <span id="col">
                            <?php if($lieu['ville'] == "DA"){
                                echo 'Douala';
                            }elseif($lieu['ville'] == "YE"){
                                echo 'Yaounde';
                            }else{
                                echo 'Bafoussam';
                            } ?> :
                        </span>
                        le <?php echo $lieu['datelieu'] ?> à <?php echo $lieu['lieu'] ?> <?php if(!empty($lieu['heure'])): ?>à partir de <?php echo $lieu['heure']; endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </p>

            <?php endif; ?>

            <h2 id="col">Les conditions de participation</h2>
            <ol>
                <li>Etre de nationalité camerounaise</li>
                <li>Etre âgée de 18 ans au moins et 25 ans au plus à la date du casting (Pour les candidates mineures,  se munir d’une autorisation parentale, de la photocopie de la CNI et Acte de naissance du parent)
                </li>
                <li>Etre célibataire</li>
                <li>Ne pas porter de tatouage ni de piercing visibles</li>
                <li>Ne jamais avoir posé nue ou fait l’objet de publications ou la candidate apparaitrait partiellement
                    ou totalement dénudée.
                </li>
                <li>Ne pas avoir été antérieurement l’égérie ou l’ambassadrice d’une autre marque</li>
                <li>Bénéficier d’une bonne réputation et ne jamais avoir fait l’objet de poursuites judicaires pénales
                </li>
                <li>Pour le compte de Miss Orangina, une même candidate ne peut participer au casting dans 3 villes différentes
                </li>
            </ol>
            <h2 id="col"> Mécanisme</h2>
            <ul>
                <li>
                    L’élection se déroule devant un public de fans et de supporters auxquels il est permis de voter pour leur candidate préférée à travers un ticket obtenu à l’achat d’une boisson Orangina 0.33 l (ou 60 cl pour l’Ouest).
                </li>
                <li>
                    Chaque personne a la possibilité de voter plusieurs fois.
                </li>
                <li>La sélection des candidates retenues au casting se fera uniquement par le Jury.</li>
                <li>La sélection des candidates pour les ¼ de finales et les ½ finales, se fera par le système de vote suivant : 40% par le public et 60% par le jury.</li>
                <li>La sélection des candidates pour la finale se fera par le système de vote suivant : 40% pour le public (Public sites finale et internet)  et 60% par le jury.</li>
            </ul>
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