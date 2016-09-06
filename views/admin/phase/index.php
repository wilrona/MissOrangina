<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 05:52
 */
?>

<div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Les phases du concours </h2>

    <?php if (!empty($this->notice)): ?>
        <div id="notice" class="error"><p><?= $this->notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($this->message)): ?>
        <div id="message" class="updated"><p><?= $this->message ?></p></div>
    <?php endif;?>

    <form id="persons-table" method="POST">
        <input type="hidden" name="page" value="<?= $_REQUEST['page'] ?>"/>
        <a href="#"></a>
        <?php
            $table = $this->list_view("List_View_Phase");



            if( isset($_POST['s']) ) {
                $table->prepare_items($_POST['s']);
            }else{
                $table->prepare_items();
            }
            $table->search_box("Recherche", "phase");
            $table->display();
        ?>
    </form>
</div>