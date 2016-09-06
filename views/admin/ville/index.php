<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/10/2015
 * Time: 12:23
 */

?>

<div class="wrap">
    <h1>Villes</h1>

    <?php if (!empty($this->notice)): ?>
        <div id="notice" class="error"><p><?= $this->notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($this->message)): ?>
        <div id="message" class="updated"><p><?= $this->message ?></p></div>
    <?php endif;?>

    <div id="col-container">
        <div id="col-right">
            <form id="persons-table" method="POST">
                <input type="hidden" name="page" value="<?= $_REQUEST['page'] ?>"/>
                <?php
                wp_nonce_field("ville_create_search", "nonce");
                ?>
            <?php
            $table = $this->list_view("List_View_Ville");



            if( isset($_POST['s']) && wp_verify_nonce($_POST['nonce'], "ville_create_search") ) {
                $table->prepare_items($_POST['s']);
            }else{
                $table->prepare_items();
            }
            $table->search_box("Recherche", "ville");
            $table->display();
            ?>
            </form>
        </div>
        <div id="col-left">
            <div class="col-wrap">


                <div class="form-wrap">
                    <h3>Ajouter/modifier une ville</h3>
                    <form id="addtag" method="post" action="" class="validate">
                        <input type="hidden" name="action" value="add-ville">
                        <?php
                            wp_nonce_field("ville_create_update", "nonce");
                        ?>
                        <div class="form-field form-required term-name-wrap">
                            <input type="hidden" name="id" value="<?php echo $this->item['id'] ?>"/>
                            <label for="tag-name">Abreviation</label>
                            <input name="abreviation" id="tag-name" type="text" value="<?php echo $this->item['abreviation'] ?>" size="40" aria-required="true">
                        </div>
                        <div class="form-field form-required term-name-wrap">
                            <label for="tag-name">Nom de la ville</label>
                            <input name="ville" id="tag-name" type="text" value="<?php echo $this->item['ville'] ?>" size="40" aria-required="true">
                        </div>

                        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Ajouter une ville"></p>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>