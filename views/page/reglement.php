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
    h2#col{
        text-decoration: underline;
        font-size: 25px;
    }

    .bg-yellow1 {
        padding-top: 40px;
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
    <h1 id="logo">Reglement du concours <span id="col">Miss Orangina</span> </h1>

    <div class="container" id="logo">
        <div class="text1" style="width: 100%; font-size: 20px; text-align: left; height: 560px; overflow-y: auto;">
            <h2 id="col">PREAMBULE : Organisation et dénomination </h2>
            <p>
                En application de la <span id="col">loi n° 2015/012 du 16 Juillet 2015 fixant le régime des jeux de divertissement, d’argent et de hasard, la Société Anonyme des Brasseries du Cameroun « SABC »</span> dont le siège social est sis au 77, rue Prince Bell Douala B.P. 4036, ci-après dénommée <span id="col">« organisateur »</span>, lance pour l’édition 2015, le concours dénommé <span id="col">«MISS ORANGINA»</span>, ci-après désigné <span id="col">« le concours »</span>.
            </p>


            <h2 id="col">ARTICLE   1 : Objectif et Durée du jeu concours</h2>
            <p>SABC organise un grand concours national amateur de beauté dénommé <span id="col">« MISS ORANGINA»</span> et ayant pour objectif de désigner la jeune fille la plus représentative des valeurs essentielles de la marque Orangina à savoir: La beauté naturelle, l’originalité, le prestige, l’élégance et la capacité à communiquer des messages clés au grand public.

                <br/>Le concours s’étend sur la période allant du <span id="col">... au ... </span>.

                <br/>L’organisateur se réserve le droit d’avancer, de retarder ou de proroger la date de lancement ou la durée de ce jeu concours en avisant à l’avance le public.
            </p>

            <h2 id="col">ARTICLE 2 : Territoire</h2>
            <p>Le concours couvre uniquement les villes de Douala, Yaoundé et Buéa.
            </p>

            <h2 id="col">ARTICLE 3 : Participation au jeu concours</h2>
            <p>
                La participation au jeu concours <span id="col">« MISS ORANGINA»</span> est libre et gratuite ; elle est ouverte à toute jeune fille résidant ou de passage dans le territoire visé ci-dessus et désirant y participer, sous réserve des conditions suivantes : <br/>
                <ul>
                        <li>Etre de nationalité camerounaise ;</li>
                        <li>Etre âgée de 18 ans au moins et de 25 ans au plus  à la date du casting (avec l’accord parental pour les moins de 21 ans – Les candidates mineures se feront accompagner par leur père ou tuteur légal pour la signature de l’accord)</li>
                        <li>Etre célibataire, sans enfant ;</li>
                        <li>Avoir une taille d’ 1,68m au minimum (sans talons) pour un poids de 80 Kg  au plus.</li>
                        <li>Ne pas porter de tatouage et/ou de piercing visibles ;</li>
                        <li>Ne jamais avoir posé nue ou fait l’objet de publications où la candidate apparaitrait partiellement ou totalement dénudée ;</li>
                        <li>Ne pas avoir été antérieurement l’égérie  ou l’ambassadrice d’une autre marque ;</li>
                        <li>Bénéficier d’une bonne réputation et ne jamais avoir fait l’objet de poursuites judiciaires ;</li>
                        <li>Ne  pas participer au casting dans 2 villes différentes.</li>

                </ul>
                Ne peuvent participer à ce jeu concours :
                <ul>
                    <li>Les personnes morales ;</li>
                    <li>Les employés permanents ou occasionnels du groupe SABC et les membres de leurs familles ;</li>
                    <li>Les employés de l’agence publicitaire et les imprimeurs ayant travaillé sur ce concours ainsi que les membres de leurs familles.</li>

                </ul>
            </p>

            <h2 id="col">ARTICLE 4 : Modalités de participation</h2>
            <p>

                Pour participer au jeu concours <span id="col">« MISS ORANGINA»</span>, les candidates réunissant les conditions énumérées à l’article 3 des présentes devront retirer à la guérite d’un Centre de Distribution SABC des villes où se déroule la compétition ou télécharger les documents d’inscription (Fiche de participation et règlement du concours) sur le site web www.missorangina-cm.com et/ou la page Facebook Orangina Cameroon. Elles rempliront le formulaire d’inscription (Cf. Annexe n°2), en y joignant le jour du casting une photocopie de leur CNI ou de leur passeport en cours de validité et une autorisation  parentale (Cf. Annexe n°1)  le cas échéant. Elles remettront lesdits documents au responsable du casting de leur ville de résidence, le jour du casting.
                <br/>La participation au jeu concours <span id="col">« MISS ORANGINA»</span>, à quelque titre que ce soit, reste et demeure une activité récréative et non rémunérée.

                <br/>Le nombre de participantes est illimité et reste à l’entière discrétion de l’équipe d’organisation. Le défaut de validation d’une ou plusieurs candidatures n’est susceptible d’aucun recours.

                <br/>Par ailleurs, une même candidate ne peut participer au casting dans 2 villes différentes.


            </p>

            <h2 id="col">ARTICLE   5 : Etapes du jeu concours</h2>
            <p>
                Pour l’édition 2015 du jeu concours « MISS ORANGINA», la compétition se déroulera en 04 étapes :
                <ul>
                    <li>1ère étape : le  casting qui se tiendra dans les villes de Douala, Yaoundé et Buéa, à raison d’un casting par ville.</li>
                    <li>2ème étape : les éliminatoires (Trois ¼ de finales) qui se dérouleront également à Douala, Yaoundé et Buéa, à raison de 01 séance  par ville, selon un planning qui sera communiqué aux présélectionnées ;</li>
                    <li>3ème étape : la  demi-finale à raison d’une demi-finale par ville, dont la date et le lieu seront communiqués aux présélectionnées ;</li>
                    <li>4ème et dernière étape : la finale nationale qui se déroulera le 12 décembre au Castel Hall à Douala.</li>

                </ul>
            Cependant, l’organisateur se réserve le droit d’avancer, de retarder ou de proroger la date de et le lieu de la finale en avisant à l’avance le public.

            </p>

            <h2 id="col">ARTICLE   6 : Règles du Jeu concours</h2>
            <p>
                A l’exception des castings au cours desquels les candidates seront sélectionnées suivant les critères énumérés à l’article 3 des présentes,  le schéma de défilé des candidates pour les trois autres étapes décrites à l’article 5 est le suivant :
                <ul>
                <li>1er passage : tenue de plage,</li>
                <li>2ème passage : tenue traditionnelle ;</li>
                <li>3ème passage tenue de ville.</li>
                </ul>
            Aucune exigence n’est faite sur la couleur, sur la matière ou sur le modèle des tenues. Cependant les tenues provocantes ou trop dénudées sont à éviter.

            <br/>Tout désistement ou indisponibilité à participer à l’une des étapes de la compétition sera considérée comme une démission. Le cas échéant, les candidates démissionnaires seront remplacées suivant la liste d’attente. Le choix de la remplaçante  reste à la seule discrétion de l’organisateur.


            </p>
            <h2 id="col">ARTICLE   7 : Le Jury</h2>
            <p>
                L’élection se déroulera devant un jury de 03 membres et un public de fans et de supporters.

                <br/>Le vote du  jury compte à 60 %  tandis que celui du public compte à 40%.

                <br/>Le barème de notation du jury est arrêté comme suit :
                <ul>
                <li>Présentation physique (Taille, look, expression corporelle…)      05 points ;</li>
                <li>Allure (démarche, présence, enthousiasme, sympathie, rayonnement du visage…)  05 points;</li>
                <li>Connaissance de sa culture (Langue, cuisine, coutumes…)              (05 points ;</li>
                <li>Elocution (diction, langage, esprit, message)                                 05 points.</li>

            </ul>
            La note du jury doit ensuite être transcrite en pourcentage.

            <br/>Chaque personne dans le public a la possibilité de voter pour sa candidate préférée à l’aide des bulletins de vote qu’elle obtiendra à l’achat d’une boisson gazeuse « ORANGINA ».

            <br/>Tout achat d’une boisson « ORANGINA » donne donc droit à un bulletin de vote et à un vote.

            <br/>Après le dernier passage des candidates, ces bulletins seront collectés et dépouillés avec le calcul du pourcentage de vote obtenu par chaque candidate.

            <br/>Le pourcentage total de chaque candidate sera le résultat du vote du public et de la note du jury, tel que défini à l’alinéa 2 ci-dessus.

            <br/>Aux étapes 2 et 3, seules les 04 premières candidates  seront retenues et  classées par ordre de mérite. Elles seront ensuite désignées  Miss régionale, 1ere Dauphine, 2e Dauphine et 3e Dauphine.

            <br/>Pour la finale, il ne sera retenu qu’une Miss et deux (02) Dauphines.



            </p>
            <h2 id="col">Article 8 : Supports médiatiques</h2>
            <p>
                Le présent jeu concours sera supporté par les moyens de communication suivants :
                <ol>
                <li>Affichage routier ;</li>
                <li>Spot TV ;</li>
                <li>Flyers ;</li>
                <li>Site Web et page faceboook d’orangina Cameroun.</li>

            </ol>
            </p>
            <h2 id="col">ARTICLE 9 : Le passage des candidates</h2>
            <p>L’ordre de passage des candidates sur le podium se fera suivant les numéros qui leur seront attribués.</p>
            <h2 id="col">ARTICLE 10 : Prix </h2>
            <p>Il n’est prévu qu’un prix pour la « MISS ORANGINA » uniquement.

                <br/>Le prix attribué à  la « MISS ORANGINA » est constitué  d’un chèque ou d’un virement d’un montant de FCFA un million cinq cent mille (1.500.000). En tant qu’ambassadrice de la marque «ORANGINA », la « MISS ORANGINA » représentera ladite marque sur le plan national pour une période de 01 ans (suivant les modalités du contrat y relatif).
                <br/>La 1er Dauphine remporte : 700 000 Fcfa et la 2ème Dauphine : 500 000 Fcfa
            </p>
            <h2 id="col">Article 11 : Acceptation du règlement et des valeurs attachées au Concours</h2>
            <p>
                Toute inscription et/ou participation au concours « MISS ORANGINA » pour l’édition 2015 vaut acceptation pure et simple du présent Règlement dans son intégralité.

                <br/>Les candidates prennent en outre l’engagement d’adhérer totalement et sans réserve aux valeurs et principes défendus par la marque « ORANGINA ». Toutes contrevenantes aux valeurs de la marque « ORANGINA » et au présent Règlement, seront immédiatement suspendues du jeu Concours.

            </p>
            <h2 id="col">ARTICLE 12 : Droit à l’image</h2>
            <p>
                L’organisateur se réserve le droit, à sa seule discrétion, de choisir parmi les participantes (candidates inscrites, membres du jury et autres), ceux dont il voudrait recueillir le témoignage pour une éventuelle diffusion dans les médias (télévision, radio, presse écrite, internet…) ou à l’occasion de toute action de promotion ou de communication.
                <br/>Tout participant ou tout parent de participante mineure accepte donc à l’avance que son image, ses nom et prénom ainsi que sa voix  ou ceux de son enfant soient utilisés par l’organisateur et/ou ses agences de publicité à des fins de communications commerciales dans toute publicité, tout document ou support publicitaire écrit ou audiovisuel, sans restriction ni réserve et sans que cela ne leur confère, une rémunération, un droit ou un avantage quelconque autre que ceux prévus au présent règlement général.
                <br/>Cette condition étant substantielle, elle est réputée acceptée par l’inscription et/ou la participation au Concours.

            </p>
            <h2 id="col">ARTICLE 13 : Loi applicable – Litige – clause attributive de compétence</h2>
            <p>
                Le présent règlement est soumis aux lois en vigueur de la République du Cameroun tant pour sa validité, pour son exécution que pour son interprétation.
                <br/>Les candidats admettent sans réserve que le simple fait de s’inscrire et/ou de participer à ce Concours les soumet obligatoirement à la loi Camerounaise.
                <br/>Les différends ou litiges qui viendraient à se produire à l’occasion du présent Règlement seront résolus à l’amiable et à défaut, exclusivement par voie d’arbitrage, conformément aux lois en vigueur sur le territoire de la République du Cameroun et au Règlement du Centre d’Arbitrage du GICAM (CAG) en vigueur au moment de la survenance du litige et auquel les parties déclarent adhérer sans réserves.
                <br/>La sentence arbitrale est définitive et exécutoire à l’égard des parties.

            </p>
            <h2 id="col">Article 14 : Propriété intellectuelle</h2>
            <p>Tous les droits de propriété intellectuelle afférents à la présente promotion appartiennent à SABC. </p>

            <h2 id="col">Article 15 : Dépôt et Communication du Règlement     </h2>
            <p>
                Le présent règlement est déposé en l’Etude de Maître Evelyne YOSSA, Huissier de justice près les Tribunaux et la Cour d'Appel du Littoral à Douala, B.P. 6951 Tél. 233 43 23 41, qui a reçu mandat pour accomplir toutes les formalités aux noms et pour le compte de l’organisateur.

                <br/>Il peut être consulté par toute personne qui en fait la demande.

            </p>
            <hr/>
            <p style="text-align: right">
                Fait à Douala, le 21 Septembre 2015

<!--                <br/><strong>Le Directeur Général,</strong>-->
<!---->
<!--                <br/><strong>Francis BATISTA</strong>-->

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