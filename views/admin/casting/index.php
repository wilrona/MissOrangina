<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 20/09/2015
 * Time: 10:01
 */
?>


<div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Listes des lieux <a href="<?php echo menu_page_url( PREFIX_PLUGINS_NAME."_add_casting", false ); ?>" class="add-new-h2">Ajouter</a></h2>

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
        $table = $this->list_view("List_View_Casting");

        $table->prepare_items();

        $table->display();
        ?>
    </form>
</div>