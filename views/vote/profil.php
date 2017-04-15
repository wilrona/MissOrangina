<?php header("Access-Control-Allow-Origin: *"); http_response_code(200);?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 class="modal-title">Profil du candidat</h1>
</div>
<div class="modal-body profil clearfix">
    <div class="left">
        <?php if($this->candidat->image): ?>
        <img src="<?= $this->candidat->image; ?>" alt="" class="aligncenter">
        <?php else: ?>
        <img src="<?= plugins_url('assets/img/women-default.png', PLUGINS_DIR_CURRENT ); ?>" alt="" class="aligncenter">
        <?php endif; ?>
						<span class="nbrVote"><strong>Nombre de vote</strong> <br>

						<span class="right">Vote</span><span class="left"><?php if($this->vote): echo $this->vote; else: echo 0; endif; ?></span>

						</span>
        <?php if($this->candidat->etape < 5): ?>
        <a href="<?= $this->login; ?>" class="btn" style="font-size: 20px;">Votez ici</a>
        <?php endif; ?>
    </div>
    <div class="right">
        <?php if($this->candidat->etape == 5): ?>
        <div style="text-align:center;">
							<span class="name" style="font-size: 21px;
						font-weight: bold;
						font-family: Flavour; color:#004899;">
                                <?php
                                if($this->candidat->gagnant == 1){
                                    $passage = 'Miss Orangina';
                                }
                                if($this->candidat->gagnant == 2){
                                    $passage = '1ere Dauphine';
                                }
                                if($this->candidat->gagnant == 3){
                                    $passage = '2eme Dauphine';
                                }
                                if($this->candidat->gagnant == 4){
                                    $passage = '3eme Dauphine';
                                }
                                ?>
                                <?= $passage ?></span>
						<span class="name" style=" background: url('<?= plugins_url( 'assets/img/logo.png', PLUGINS_DIR_CURRENT ); ?>') no-repeat center; width: 100%; height: 125px;
						display: block;
						background-size: 100px;"></span>
        </div>
        <?php endif; ?>
        <table class="table">
            <thead>
            <tr>
                <th><?= $this->candidat->nom ?> <?= $this->candidat->prenom ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <ul class="ul-list-inline">
                        <li> <strong>Age : <?= $this->candidat->Age ?> ans</strong> </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="max-height:400px; overflow-x:hidden; overflow-y:auto;">
                    <h3>Qui suis je ?</h3>
                    <p style="text-align: justify;">
                        <?= $this->candidat->presentation ?>
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn" data-dismiss="modal">Fermer</button>
</div>