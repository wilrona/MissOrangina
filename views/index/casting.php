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
                        Conditions de participation</a></li>

            </ul><br>
            <div id="myTabContent-kv-11" class="tab-content">
                <div class="tab-pane fade" id="home-1">
                    <div class="concept">
                        <ul>
                            <li>Tu es de nationalité camerounaise</li>
                            <li>Tu es âgée de 18 ans au moins et 25 ans au plus à la date du casting</li>
                            <li>Tu es célibataire</li>
                            <li>Tu n'as pas été antérieurement l 'égérie ou l'ambassadrice d'une autre marque</li>
                            <li>Tu n'as jamais fait l'objet de poursuites judiciaires</li>
                            <li>...</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade in active" id="profile-2">
                    <ul class="media-list">
                        <?php if(!empty($this->lieu)):
                            foreach($this->lieu as $lieu):
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
                </div>
            </div>
        </div>

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
    </div>
    <div class="body_right">
        <?php include "panel_right.php"; ?>
    </div>

</div>