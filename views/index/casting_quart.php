<?php include "slide.php"; ?>

<div class="l-container">
    <div class="body_left">

        <h2 class="h2"> Les inscriptions se poursuivent
        </h2>

        <!-- tabs -->
        <div class="tabs-x tab-align-center tabs-above">
            <ul id="myTab-kv-11" class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#profile-2" role="tab" data-toggle="tab"></i>
                        Lieu de casting</a></li>
                <li><a href="#home-1" role="tab" data-toggle="tab">
                        Sélection de 1/4 de finale</a></li>

            </ul><br>
            <div id="myTabContent-kv-11" class="tab-content">
                <div class="tab-pane fade" id="home-1">
                    <h3 style="text-align: center; text-decoration: underline;">Votez avec votre compte Facebook</h3>
<!--                    debut du contenu des candidates-->
                    <div class="tabs-x-2 tab-align-center tabs-above">
                        <ul id="myTab-kv-11-2" class="nav nav-tabs" role="tablist"  style="background: none; padding: 0;">
                            <?php $count = 0; foreach ($this->candidat_ville as $ville): ?>
                                <?php foreach ($this->villes as $villes):
                                    if($villes['id'] == $ville['ville']): ?>
                                        <li <?php if($count == 0): ?> class="active" <?php endif; ?>><a href="#<?= $ville['ville'] ?>" role="tab" data-toggle="tab"> <?= $villes['ville'] ?></a></li>
                                        <?php $count++; endif;
                                endforeach; ?>
                            <?php endforeach; ?>

                        </ul><br>
                        <div id="myTabContent-kv-11-2" class="tab-content">
                            <?php $count = 0; foreach ($this->candidat_ville as $ville):

                                if(!in_array($ville['ville'], $this->lieu_id)):
                                    ?>
                                    <div class="tab-pane fade <?php if($count == 0): ?> in active <?php endif; ?>" id="<?= $ville['ville'] ?>">
                                        <?php foreach ($this->candidat as $candidat):
                                            if($candidat['ville'] == $ville['ville']): ?>

                                                <div class="user-card">
                                                    <div class="card-container">
                                                        <div class="card">
                                                            <div class="front">
                                                                <div class="cover">
                                                                    <img src="<?= $candidat['image'] ?>"/>
                                                                </div>
                                                                <!--<div class="user">
                                                                    <img class="img-circle" src="img/rotating_card_profile3.png"/>
                                                                </div>-->
                                                                <div class="content">
                                                                    <div class="main">
                                                                        <h3 class="name"><?= $candidat['nom'] ?> <?= $candidat['prenom'] ?></h3>
                                                                        <!--                                                        <p class="profession">--><?//= $candidat['Age'] ?><!-- ans</p>-->
                                                                    </div>
                                                                    <div class="footer clearfix">
                                                                        <div class="vote">
                                                                            <span class="right">Votes</span>
                                                            <span class="left">
                                                                <?php
                                                                $exist = false;
                                                                foreach ($this->candidat_vote as $vote):
                                                                    if($vote['idcandidat'] == $candidat['id']):
                                                                        $exist = true;
                                                                        ?>
                                                                        <?= $vote['nbr'] ?>

                                                                    <?php

                                                                    endif; endforeach;

                                                                if($exist == false){
                                                                    echo '0';
                                                                }

                                                                ?>


                                                                </span>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div> <!-- end front panel -->
                                                            <div class="back">
                                                                <div class="content">
                                                                    <div class="main" style="text-align:center">
                                                                        <h4 class="name"><?= $candidat['nom'] ?> <?= $candidat['prenom'] ?></h4>
                                                                        <hr>
                                                                        <!--                                                        <a href="--><?php //echo get_site_url(); ?><!--/vote/profil/--><?php //echo $candidat['id'];  ?><!--" data-toggle="modal" data-target="#myModal" data-backdrop="static" class="btn btn-block btn-primary">Details</a>-->
                                                                        <!--                                                        <span class="name">OU</span>-->
                                                                        <a href="<?php echo get_site_url(); ?>/facebook/vote/<?php echo $candidat['id'];  ?>" data-toggle="modal" data-target="#myModal" data-backdrop="static" class="btn btn-block btn-contact">Votez ici</a>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end back panel -->
                                                        </div> <!-- end card -->
                                                    </div> <!-- end card-container -->
                                                </div>


                                                <?php $count++;  endif; endforeach; ?>
                                    </div>
                                <?php endif; endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in active" id="profile-2">
                    <ul class="media-list">
                        <?php if(!empty($this->lieu_1)):
                            foreach($this->lieu_1 as $lieu):
                                if($lieu['passe'] != 1):
                                    ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <h2 class="media-heading"><?php echo $lieu['lieu'] ?> à
                                                <?php
                                                foreach ($this->villes as $ville) {
                                                    if($ville['id'] == $lieu['ville']){
                                                        echo $ville['ville'];
                                                    }
                                                }
                                                ?>
                                            </h2>
                                            <?php echo $lieu['datelieu']; if(!empty($lieu['heure'])):  ?> à partir de <?php echo $lieu['heure']; endif; ?>

                                        </div>
                                    </li>

                                    <hr>
                                <?php       endif;
                            endforeach;
                        endif; ?>
                    </ul>


                    <div class="concept clearfix" style="text-align: center;">
                        <br/>
                        <!--            <h3>Inscrivez-vous pour le prochain Casting </h3>-->
                        <a href="<?php echo get_site_url()."/facebook"; ?>" data-toggle="modal" data-target="#myModal" data-backdrop="static" class="btn btn-contact" style="padding: 20px;    padding: 5px 20px;
    font-size: 10px;
    border-radius: 15px;"> <h2 style="margin-bottom: 0;">inscris-toi</h2></a>
                        <br/>
                        <br/>
                    </div>
                    <br/>

                    <div class="concept">
                        <br/>
                        <h2 style="text-align: center; color:#fff; text-decoration: underline;">Conditions de participation</h2>
                        <ul>

                            <li>Tu es célibataire</li>
                            <li>Tu es de nationalité camerounaise</li>
                            <li>Tu n'as jamais fait l'objet de poursuites judiciaires</li>
                            <li>Tu es âgée de 18 ans au moins et 25 ans au plus à la date du casting</li>
                            <li>Tu n'as pas été antérieurement l 'égérie ou l'ambassadrice d'une autre marque</li>
                            <li>...</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    </div>
    <div class="body_right">
        <?php include "panel_right.php"; ?>
    </div>

</div>