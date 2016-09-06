<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 22/09/2015
 * Time: 12:19
 */

require_once(ABSPATH . 'wp-content/plugins/MissOrangina/vendor/Plugin_helpers.php' );

$plugin = new Plugin_Helpers;

?>

<div class="wrap">
    <h2>Fiche du candidat No <strong><?php echo $this->item['codeins']; ?></strong>  <a href="
    <?php if(!isset($_REQUEST['return'])){ echo menu_page_url( PREFIX_PLUGINS_NAME."_inscrit", false );}
        elseif(isset($_REQUEST['return']) && $_REQUEST['return'] == 2){ echo menu_page_url( PREFIX_PLUGINS_NAME."_view_inscrit_quart", false ); }
        elseif(isset($_REQUEST['return']) && $_REQUEST['return'] == 3){ echo menu_page_url( PREFIX_PLUGINS_NAME."_view_inscrit_demi", false ); }
        elseif(isset($_REQUEST['return']) && $_REQUEST['return'] == 4){ echo menu_page_url( PREFIX_PLUGINS_NAME."_view_inscrit_final", false ); }?>" class="add-new-h2"> Retour à la liste</a></h2>

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
            <form name="candidat" method="post" autocomplete="off">
                <?php
                    wp_nonce_field("candidat_update", "nonce");
                ?>


                <div id="post-body-content">
                    <hr>
                        <div id="titlediv">
                            <div id="titlewrap">
                                <label for="title"><strong>Numero du candidat :</strong> </label>
                                <input type="text" name="name" disabled size="30" value="<?php echo $this->item['codeins']; ?>" id="title" spellcheck="true" autocomplete="off">
                                <input type="hidden" name="codeins" size="30" value="<?php echo $this->item['codeins']; ?>">
                            </div>
                            <div id="titlewrap">
                                <label for="title">Nom : </label>
                                <input type="text" name="nom"  size="30" value="<?php echo $this->item['nom']; ?>" id="title" spellcheck="true" autocomplete="off">
                            </div>
                            <div id="titlewrap">
                                <label for="title">Prenom : </label>
                                <input type="text" name="prenom" size="30" value="<?php echo $this->item['prenom']; ?>" id="title" spellcheck="true" autocomplete="off">
                            </div>
                            <div id="titlewrap">
                                <label for="title">Date de naissance <strong><?php if($this->item['dateNais']) echo "- (".$plugin->date_naiss($this->item['dateNais']).' ans)' ?></strong> : </label>
                                <input type="text" name="dateNais" size="30" value="<?php if($this->item['dateNais']) echo date("d-m-Y", strtotime($this->item['dateNais'])); ?>" id="title" class="datepickerbirth" spellcheck="true" autocomplete="off">
                            </div>
                            <div id="titlewrap">
                                <label for="title">Lieu de naissance : </label>
                                <input type="text" name="lieuNais" size="30" value="<?php echo $this->item['lieuNais']; ?>" id="title" spellcheck="true" autocomplete="off">
                            </div>
                            <div id="titlewrap">
                                <label for="title">Nationalité : </label>
                                <input type="text" name="nationalite" size="30" value="<?php echo $this->item['nationalite']; ?>" id="title" spellcheck="true" autocomplete="off">
                            </div>
                            <div id="titlewrap">
                                <label for="title">Email Adresse : </label>
                                <?php if(!$this->item['idfacebook'] || empty($this->item['email'] )): ?>
                                <input type="text" name="email" size="30" value="<?php echo $this->item['email']; ?>" id="title" spellcheck="true" autocomplete="off">
                                <?php else: ?>
                                    <input type="text" name="email" disabled size="30" value="<?php echo $this->item['email']; ?>" id="title" spellcheck="true" autocomplete="off">
                                    <input type="hidden" name="email" size="30" value="<?php echo $this->item['email']; ?>" id="title" spellcheck="true" autocomplete="off">
                                <?php endif; ?>
                            </div>
                            <div id="titlewrap">
                                <label for="title">Adresse personnelle : </label>
                                <input type="text" name="adresse" size="30" value="<?php echo $this->item['adresse']; ?>" id="title" spellcheck="true" autocomplete="off">
                            </div>
                            <div id="titlewrap">
                                <label for="title">Ville : </label>
                                <select name="ville" id="" style="width: 100%;">
                                    <?php foreach ($this->ville as $villes): ?>
                                        <option value="<?php echo $villes['id']; ?>" <?php if($villes['id'] == $this->item['ville']): ?> selected <?php endif; ?>> <strong><?= $villes['ville'] ?></strong></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div id="titlewrap">
                                <label for="title">Telephone portable : </label>
                                <input type="text" name="phone" size="30" value="<?php echo $this->item['phone']; ?>" id="title" spellcheck="true" autocomplete="off">
                            </div>
                        </div>
                        <?php
                        $content = $this->item['presentation'];
                        $editor_id = 'presentation';

                        wp_editor( $content, $editor_id, array(
                                '_content_editor_dfw' => true,
                                'drag_drop_upload' => true,
                                'tabfocus_elements' => 'content-html,save-post',
                                'editor_height' => 200,
                                'tinymce' => array(
                                    'resize' => false,
                                    'wp_autoresize_on' => true,
                                    'add_unload_trigger' => false,
                                ),
                                'wpautop'       => false,
                                'media_buttons' => false,
                                'textarea_name' => $editor_id,
                                'textarea_rows' => 10,
                                'teeny'         => false
                            )  );
                        ?>

                    <table class="form-table">
                        <tr>
                            <td style="width: 500px !important;"><h3>Profession ou diplome en cours</h3></td>
                            <td><?php echo $this->item['profession']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Dernier diplome obtenue</h3></td>
                            <td><?php echo $this->item['diplome']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Si vous êtes élue Miss Orangina, quel serait votre rêve ?</h3></td>
                            <td><?php echo $this->item['dream']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Quelle est votre ambition dans la vie ?</h3></td>
                            <td><?php echo $this->item['ambition']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Quels sont vos loisirs ?</h3></td>
                            <td><?php echo $this->item['loisir']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Avez-vous déjà participé à un concours de beauté ? Si oui, à quelle occasion</h3></td>
                            <td><?php echo $this->item['concours']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Taille sans talons (en cm)</h3></td>
                            <td><?php echo $this->item['taille']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Citez 03 de vos qualités</h3></td>
                            <td><?php echo $this->item['qualite'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 500px !important;"><h3>Combien d’enfant (s) avez-vous ?</h3></td>
                            <td><?php echo $this->item['enfant'] ?></td>
                        </tr>
                    </table>

                </div>
                <div id="postbox-container-1" class="postbox-container">

                    <div id="side-sortables" class="meta-box-sortables ui-sortable">
                        <div id="submitdiv" class="postbox ">
                            <div class="handlediv" title="Cliquer pour inverser."><br></div><h3 class="hndle ui-sortable-handle"><span>Publier</span></h3>
                            <div class="inside">
                                <div class="submitbox" id="submitpost">

                                    <div id="minor-publishing" style="text-align: center;">
                                        <div id="misc-publishing-actions">
                                            <div class="misc-pub-section"><label>Etape traversée :</label>
                                                   <strong> <?php
                                                       if($this->item['etapes']):
                                                            echo $this->item['etapes'];
                                                       else:
                                                            echo 'Aucune';
                                                       endif;
                                                       ?>
                                                   </strong>
                                            </div>
                                            <div class="misc-pub-section"><label>Etape suivante :</label>
                                                <strong> <?php
                                                    if($this->item['suivant']):
                                                        echo $this->item['suivant'];
                                                    else:
                                                        echo 'Aucune';
                                                    endif;
                                                     ?>
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>




                                </div>
                            </div>
                        </div>


                        <?php if(!empty($this->liste_phase)): ?>
                        <div id="submitdiv" class="postbox ">
                            <div class="handlediv" title="Cliquer pour inverser."><br></div><h3 class="hndle ui-sortable-handle"><span>Votes</span></h3>
                            <div class="inside">
                                <div class="submitbox" id="submitpost">

                                    <div id="minor-publishing" style="text-align: center;">
                                        <div id="misc-publishing-actions">
                                            <?php foreach($this->liste_phase as $phase): ?>
                                                <?php foreach($this->candidat_vote as $vote):
                                                ?>
                                                    <div class="misc-pub-section"><label><?php echo $phase['valeur'] ?> :</label>
                                                        <strong>
                                                        <?php
                                                        if($vote['etape'] == $phase['etape']):
                                                    ?>

                                                            <?php echo $vote['nbr']; ?>
                                                    <?php else:
                                                        ?>
                                                            0
                                                        <?php
                                                        endif; ?>

                                                            vote(s)</strong>

                                                    </div>
                                            <?php endforeach;
                                                endforeach;
                                            ?>
                                        </div>
                                        <div class="clear"></div>
                                    </div>




                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div id="submitdiv" class="postbox ">
                            <div class="handlediv" title="Cliquer pour inverser."><br></div><h3 class="hndle ui-sortable-handle"><span>Photo de la candidate</span></h3>
                            <div class="inside">
                                <div class="submitbox" id="submitpost">

                                    <div id="minor-publishing" style="text-align: center; padding: 10px;">

                                        <img src="<?php if($this->item['image']){ ?> <?php echo $this->item['image']; } ?>" <?php if($this->item['image']){  echo 'alt="image candidat No '.$this->item['codeins'].'"';  }?>  <?php if($this->item['image']){ ?> width="250" <?php } ?> id="view_imgcandidat"/>
                                        <input type="hidden" id="imgcandidat" name="image" value="<?= $this->item['image']; ?>"/><br/>
                                        <?php if(current_user_can('install_plugins')): ?>
                                            <?php
                                                if(!empty($this->item['image'])):
                                            ?>
                                                <a href="#" id="add_imgcandidat"> Modifier l'image du candidat
                                            <?php
                                                else:
                                            ?>
                                                <a href="#" id="add_imgcandidat">    Ajouter une image du candidat
                                            <?php
                                                endif;
                                            ?>
                                            </a>
                                        <?php endif; ?>

                                    </div>
                                    <?php if(current_user_can('install_plugins')): ?>
                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <input type="hidden" name="datecreate" value="<?php echo $this->item['datecreate']; ?>"/>
                                            <input type="hidden" name="etape" value="<?php echo $this->item['etape']; ?>"/>
                                            <input type="hidden" name="id" value="<?php echo $this->item['id']; ?>"/>
                                            <input type="submit" class="button button-primary button-large" value="Enregistrer les modifications">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div id="submitdiv" class="postbox ">
                            <div class="handlediv" title="Cliquer pour inverser."><br></div><h3 class="hndle ui-sortable-handle"><span>Liste des amis</span></h3>
                            <div class="inside">
                                <div class="submitbox" id="submitpost">

                                    <div id="minor-publishing" style="text-align: center;">
                                        <?php
                                            if($this->item['parrain']):
                                                ?>
                                                <ul>
                                                <?php
                                                foreach($this->item['parrain'] as $parrain){
                                                   ?>
                                                    <li><h3><?php echo $parrain['email']; ?></h3></li>

                                                <?php
                                                    }
                                                ?>
                                                </ul>
                                            <?php
                                            else:
                                                ?>
                                                    <h2>Aucun Ami</h2>
                                            <?php
                                            endif;
                                        ?>
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
