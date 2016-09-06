<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 12:17
 */

?>
<?php header("Access-Control-Allow-Origin: *"); ?>
<div class="modal-header bg-warning">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Inscription</h4>
</div>
<style>
    .btn-facebook {
        -webkit-border-radius: 7;
        -moz-border-radius: 7;
        border-radius: 7px;
        font-family: Arial;
        color: #ffffff;
        font-size: 20px;
        background: #4e69a2;
        padding: 10px 20px 10px 20px;
        text-decoration: none;
    }

    .btn-facebook:hover {
        background: #223770;
        text-decoration: none;
    }
</style>
<div class="modal-body" style="text-align: center;">

    <a class="btn btn-facebook btn-lg" href="<?= $this->login; ?>">Inscription avec facebook </a>



</div>
