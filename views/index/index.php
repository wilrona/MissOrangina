<?php include "slide.php"; ?>

<div class="l-container">
    <div class="body_left">

        <h2 class="h2"> Le concept du coucours Miss Oragina
        </h2>

        <div class="concept clearfix">
            <ul>
                <li>
                    <strong>Miss ORANGINA</strong> est un concours de Miss, organisé pour les jeunes filles urbaines, camerounaises,  allant de <strong>18 ans</strong> au moins et à <strong>25 ans</strong> au plus à la date du casting
                </li>
                <li>
                    Le concours a pour but de désigner <strong>la jeune fille la plus représentative</strong> des valeurs essentielles de la marque <strong>ORANGINA</strong>

                </li>
                <li>A savoir : La <strong>beauté naturelle</strong> (Teint et rondeurs africains), l’<strong>originalité</strong> (Talents, culture),  et  <strong>le prestige</strong> (chic et et élégance)</li>

            </ul>
        </div>
        <hr/>
        <div style="text-align: center;">
            <a href="<?php echo get_site_url()."/facebook"; ?>" data-toggle="modal" data-target="#myModal" data-backdrop="static" class="btn btn-contact" style="padding: 20px;"> <h2 style="margin-bottom: 0;">Inscris toi maintenant</h2></a>
        </div>
        <hr/>

        <h2 class="h2">Information sur le concours  Miss Orangina 2015</h2>

        <!-- tabs -->
        <div class="tabs-x tab-align-center tabs-above">
            <ul id="myTab-kv-11" class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#home-1" role="tab" data-toggle="tab">
                        Conditions de participation</a></li>
                <li><a href="#profile-2" role="tab" data-toggle="tab"></i>
                        Lieux de casting</a></li>
            </ul><br>
            <div id="myTabContent-kv-11" class="tab-content">
                <div class="tab-pane fade in active" id="home-1">
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
                <div class="tab-pane fade" id="profile-2">
                    <ul class="media-list">
                        <?php if(!empty($this->lieu)):
                            foreach($this->lieu as $lieu):
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
                                <?php
                            endforeach;
                        endif; ?>

                    </ul>
                </div>
            </div>
        </div>


    </div>
    <div class="body_right">
        <?php include "panel_right.php"; ?>
    </div>

</div>