
<?php include "slide.php"; ?>

<div class="l-container">
    <div class="body_left">
        <h2 class="h2"> Miss Orangina 2015 <?php if($this->etape == 2): ?> <?php echo '( 1/4 de Finale )'; elseif($this->etape == 3): echo '( 1/2 Finale )';  ?> <?php endif; ?></h2>

        <div class="concept clearfix" style="text-align: center;">
            <br/>
                        <h3>Votez avec votre compte Facebook</h3>

            <br/>
        </div>
        <br/>
        <!-- tabs -->
        <div class="tabs-x tab-align-center tabs-above">
            <ul id="myTab-kv-11" class="nav nav-tabs" role="tablist">
                <?php $count = 0; foreach ($this->candidat_ville as $ville): ?>
                    <?php foreach ($this->villes as $villes):
                        if($villes['id'] == $ville['ville'] and !in_array($villes['id'], $this->lieu_id)): ?>
                        <li <?php if($count == 0): ?> class="active" <?php endif; ?>><a href="#<?= $ville['ville'] ?>" role="tab" data-toggle="tab"> <?= $villes['ville'] ?></a></li>
                    <?php $count++; endif;
                    endforeach; ?>
                <?php endforeach; ?>
            </ul><br>
            <div id="myTabContent-kv-11" class="tab-content">
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
    <div class="body_right">
        <?php include "panel_right.php"; ?>
    </div>

</div>


