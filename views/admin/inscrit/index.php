<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/09/2015
 * Time: 15:10
 */

?>


<div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Les inscrits <a href="<?php echo menu_page_url( PREFIX_PLUGINS_NAME."_view_inscrit", false ); ?>" class="add-new-h2">Ajouter</a></h2>

    <?php if (!empty($this->notice)): ?>
        <div id="notice" class="error"><p><?= $this->notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($this->message)): ?>
        <div id="message" class="updated"><p><?= $this->message ?></p></div>
    <?php endif;?>

<!--    <ul class="subsubsub">-->
<!--        --><?php //$menu_page = menu_page_url(PREFIX_PLUGINS_NAME."_inscrit", false ); ?>
<!--        --><?php
//            if($_GET['orderby']){
//                $orderby = "&orderby=".$_GET['orderby'];
//            }
//            if($_GET['order']){
//                $order = "&order=".$_GET['order'];
//            }
//        ?>
<!--        <li class="all"><a href="--><?//= $menu_page."".$orderby."".$order; ?><!--" --><?php //if(!isset($_GET['inscrit'])): ?><!--class="current"--><?php //endif; ?><!-- >Tous</a> |</li>-->
<!--        <li class="publish"><a href="--><?//= $menu_page."&inscrit=1".$orderby."".$order; ?><!--" --><?php //if(isset($_GET['inscrit']) && $_GET['inscrit'] == 1): ?><!--class="current"--><?php //endif; ?><!-- >Inscription terminée</a> |</li>-->
<!--    </ul>-->


    <form id="persons-table" method="POST">
        <input type="hidden" name="page" value="<?= $_REQUEST['page'] ?>"/>

        <?php
        $table = $this->list_view("List_View_Inscrit");
        if(isset($_POST['s']) || isset($_GET['inscrit']) ) {
            $table->prepare_items($_POST['s'], $_GET['inscrit']);
        }else{
            $table->prepare_items();
        }
        $table->search_box("Recherche", "inscrit");

        ?>

        <ul class="subsubsub" style="float: right; margin-right: 70px;">
            <li class="all"><strong>Etat des candidats inscrits</strong> |</li>
            <li class="all"><a href="/etat/listeinscrit" target="_blank" >Tous</a> |</li>
            <li class="all"><a href="/wp-admin/admin-ajax.php?action=ville&amp;width=750&amp;height=300" class="thickbox">Par ville</a> |</li>
            <li class="all"><a href="/wp-admin/admin-ajax.php?action=age&amp;width=750&amp;height=300" class="thickbox">Par age</a></li>
        </ul>

        <?php
        $table->display();
        ?>

    </form>
</div>