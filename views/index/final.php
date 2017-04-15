<?php include "slide.php"; ?>

<div class="l-container">
    <div class="body_left">
        <h2 class="h2"><small>Candidates</small> Miss Orangina 2017 </h2>
        <?php  if($this->etape == 4):?>
        <div class="concept clearfix" style="text-align: center;">
            <br/>
            <!--<h3>Votez avec votre compte Facebook</h3>

            <br/>-->
        </div>
        <br/>
        <?php endif; ?>
        <!-- tabs -->
        <div class="tabs-x tab-align-center tabs-above">
            <ul id="myTab-kv-11" class="nav nav-tabs" role="tablist">
                            <li class="active" ><a href="#final" role="tab" data-toggle="tab">
                                   <?php  if($this->etape == 4):?>
                                    Nos Finalistes
                                   <?php elseif($this->etape == 5): ?>
                                    Nos Gagnantes
                                    <?php endif; ?>
                                </a></li>

            </ul><br>
            <div id="myTabContent-kv-11" class="tab-content">
                    <div class="tab-pane fade in active" id="final">
                        <?php foreach ($this->candidat as $candidat):?>
                                <div class="user-card">
                                    <div class="card-container">
                                        <div class="card">
                                            <div class="front" <?php if($candidat['gagnant'] == 1) : ?>style="box-shadow: 0 0 37px 0 rgba(252, 219, 0, 0.8);" <?php endif; ?>>
                                                <div class="cover">
                                                    <img src="<?= $candidat['image'] ?>"/>
                                                </div>
                                                <!--<div class="user">
                                                    <img class="img-circle" src="img/rotating_card_profile3.png"/>
                                                </div>-->
                                                <div class="content">
                                                    <div class="main">
                                                        <h3 class="name"><?= $candidat['nom'] ?> <?= $candidat['prenom'] ?></h3>
<!--                                                        <p class="profession" style="margin-bottom: 0; border-bottom: 1px solid #eee;">--><?//= $candidat['Age'] ?><!-- ans</p>-->
                                                        <p class="profession">
                                                            <?php
                                                            if($this->etape == 4):
                                                            foreach ($this->villes as $villes) {
                                                                if($villes['id'] == $candidat['ville']){
                                                                    echo $villes['ville'];
                                                                }
                                                            }
                                                            endif;
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="footer clearfix">
                                                        <?php if($this->etape == 4): ?>
                                                        <!--<div class="vote">
                                                            <span class="right">Votes</span>
                                                            <span class="left">
                                                                <?php
/*                                                                $exist = false;
                                                                foreach ($this->candidat_vote as $vote):
                                                                    if($vote['idcandidat'] == $candidat['id']):
                                                                        $exist = true;
                                                                        */?>
                                                                        <?/*= $vote['nbr'] */?>

                                                                    <?php
/*
                                                                    endif; endforeach;

                                                                if($exist == false){
                                                                    echo '0';
                                                                }

                                                                */?>

                                                                </span>

                                                        </div>-->

                                                        <?php
                                                        else:
                                                            if($candidat['gagnant'] == 1){
                                                                $passage = 'Miss Orangina';
                                                            }
                                                            if($candidat['gagnant'] == 2){
                                                                $passage = '1ere Dauphine';
                                                            }
                                                            if($candidat['gagnant'] == 3){
                                                                $passage = '2eme Dauphine';
                                                            }
                                                            if($candidat['gagnant'] == 4){
                                                                $passage = '3eme Dauphine';
                                                            }

                                                           echo $passage;

                                                        endif; ?>

                                                    </div>
                                                </div>
                                            </div> <!-- end front panel -->
                                            <div class="back" <?php if($candidat['gagnant'] == 1) : ?>style="    box-shadow: 0 0 37px 0 rgba(252, 219, 0, 0.8);" <?php endif; ?>>
                                                <div class="content">
                                                    <div class="main" style="text-align:center">
                                                        <h4 class="name"><?= $candidat['nom'] ?> <?= $candidat['prenom'] ?></h4>
                                                        <hr>
<!--                                                        <a href="--><?php //echo get_site_url(); ?><!--/vote/profil/--><?php //echo $candidat['id'];  ?><!--" data-toggle="modal" data-target="#myModal" data-backdrop="static" class="btn btn-block btn-primary">Details</a>-->
                                                       <!-- <?php /*if($this->etape == 4): */?>
                                                            <a href="<?php /*echo get_site_url(); */?>/facebook/vote/<?php /*echo $candidat['id'];  */?>" data-toggle="modal" data-target="#myModal" data-backdrop="static" class="btn btn-block btn-contact">Votez ici</a>
                                                        --><?php /*endif; */?>
                                                        <?php if($this->etape == 5): ?>
                                                        <span class="name" style=" background: url('<?= plugins_url( 'assets/img/logo.png', PLUGINS_DIR_CURRENT ); ?>') no-repeat center; width: 100%;height: 125px;display: block;background-size: 100px;"></span>
                                                        <span class="name" style="font-size: 21px;font-weight: bold;font-family: Flavour; color:#004899;">
                                                            <?php
                                                            if($candidat['gagnant'] == 1){
                                                                $passage = 'Miss Orangina';
                                                            }
                                                            if($candidat['gagnant'] == 2){
                                                                $passage = '1ere Dauphine';
                                                            }
                                                            if($candidat['gagnant'] == 3){
                                                                $passage = '2eme Dauphine';
                                                            }
                                                            if($candidat['gagnant'] == 4){
                                                                $passage = '3eme Dauphine';
                                                            }
                                                            ?>
                                                            <?= $passage ?>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div> <!-- end back panel -->
                                        </div> <!-- end card -->
                                    </div> <!-- end card-container -->
                                </div>


                            <?php endforeach; ?>
                    </div>
            </div>
        </div>
    </div>
    <div class="body_right">
        <?php include "panel_right.php"; ?>
    </div>

</div>


