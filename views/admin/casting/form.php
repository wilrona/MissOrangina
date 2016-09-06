<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 20/09/2015
 * Time: 10:40
 */
//    wp_enqueue_style('dashboard');
//    wp_print_styles('dashboard');
//    wp_enqueue_script('dashboard');
//    wp_print_scripts('dashboard');
//    wp_enqueue_script('editor-expand');
?>


<div class="wrap">
    <h2>
<?php
        if(empty($this->item['id'])):
?>
    Ajouter un nouveau lieu
<?php
        else:
?>
    Modifier le lieu

<?php
        endif;
?>

        <a href="<?php echo menu_page_url( PREFIX_PLUGINS_NAME."_casting", false ); ?>" class="add-new-h2">Retour à la liste</a>
        </h2>
    <div id="lost-connection-notice" class="error hidden below-h2">
        <p><span class="spinner"></span> <strong>Connexion perdue.</strong> L’enregistrement a été désactivé jusqu’à ce que vous soyez reconnecté.	<span class="hide-if-no-sessionstorage">Nous sauvegardons cet article dans votre navigateur, par sécurité.</span>
        </p>
    </div>

    <?php if (!empty($this->notice)): ?>
        <div id="notice" class="error"><p><?= $this->notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($this->message)): ?>
        <div id="message" class="updated"><p><?= $this->message ?></p></div>
    <?php endif;?>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <form name="ticket" method="post" id="lieu" autocomplete="off">
                    <?php
                    wp_nonce_field("casting_post", "nonce");
                    ?>
                        <input type="hidden" name="id" value="<?php echo $this->item['id'] ?>"/>
                <?php
                if(!empty($this->item['id']) || $this->item['id'] != 0):
                    ?>
                    <input type="hidden" name="action"/>
                <?php
                endif;
                ?>

                <div id="post-body-content">
                    <div id="titlediv">
                        <div id="titlewrap">
                            <label class="screen-reader-text" id="title-prompt-text" for="title">Saisissez le lieu</label>
                            <input type="text" name="lieu" size="30" value="<?php echo esc_html($this->item['lieu']) ?>" id="title" spellcheck="true" autocomplete="off" required="required">
                        </div>
                    </div>
                    <hr/>
                    <div id="titlediv">
                        <div id="titlewrap">
                            <label><h2 style="margin-bottom: 5px !important;">Saisissez la date</h2></label>
                            <input type="text" name="datelieu" size="100%" value="<?php echo $this->item['datelieu'] ?>" spellcheck="true" autocomplete="off" id="title" required="required">
                        </div>
                    </div>
                    <hr/>
                    <div id="titlediv">
                        <div id="titlewrap">
                            <label><h2 style="margin-bottom: 5px !important;">Saisissez l'heure (HH:MM)</h2></label>
                            <input type="text" name="heure" size="100%" value="<?php echo $this->item["heure"] ?>" spellcheck="true" autocomplete="off" id="title" required="required">
                        </div>
                    </div>


                </div>
                <div id="postbox-container-1" class="postbox-container">
                    <div id="side-sortables" class="meta-box-sortables ui-sortable">
                        <div id="submitdiv" class="postbox ">
                            <div class="handlediv" title="Cliquer pour inverser."><br></div><h3 class="hndle ui-sortable-handle"><span>Publier</span></h3>
                            <div class="inside">
                                <div class="submitbox" id="submitpost">

                                    <div id="minor-publishing">

                                        <div id="misc-publishing-actions">
                                            <div class="misc-pub-section"><label>Selectionner la ville&nbsp;:</label>

                                                <select name="ville" id="" required="required">
                                                    <option value="">select ville</option>
                                                    <?php foreach($this->ville as $ville): ?>
                                                        <option value="<?= $ville['id'] ?>" <?php if($this->item['ville'] == $ville['id']){ ?> selected="selected"  <?php } ?>><?= $ville['ville']; ?></option>

                                                    <?php endforeach; ?>
                                                </select>

                                                </div>

                                        </div>
                                        <div id="misc-publishing-actions">
                                            <div class="misc-pub-section"><label>Selectionner la phase:</label>

                                                <select name="etape" id="" required="required">
                                                    <option value="">select la phase</option>
                                                    <?php if($this->phase):
                                                        foreach($this->phase as $phase): ?>
                                                    <option value="<?php echo $phase['etape'] ?>" <?php if($phase['etape'] == $this->item['etape']){ ?> selected="selected"  <?php } ?>><?php echo $phase['valeur'] ?></option>
                                                    <?php  endforeach; endif;?>
                                                </select>

                                            </div>

                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <input type="submit" class="button button-primary button-large" value="Enregistrer">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>





</div>