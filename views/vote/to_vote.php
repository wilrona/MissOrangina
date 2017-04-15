<?php header("Access-Control-Allow-Origin: *"); http_response_code(200); ?>
<div class="modal-header">
    <h1 class="modal-title" style="text-align: center;">Vous êtes sur le point de voter la candidate<br/><?= $this->candidat->nom ?> <?= $this->candidat->prenom ?></h1>
</div>
<div class="modal-footer">
    <a href="<?= $this->login; ?>" class="btn btn-contact" style="font-size: 20px;">Votez ici</a>
    <button type="button" class="btn" data-dismiss="modal">Annuler</button>
</div>