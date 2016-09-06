<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 18:28
 */
?>
<div class="page-header">
    <div class="l-container">
        <h1>Fiche d'inscription</h1>

    </div>
</div>

<div class="l-container l-container-page">
    <?php if(isset($this->messages)): ?>
        <div class="alert alert-danger">
            <h4>Certaines informations n'ont pas été renseignées</h4>
        </div>
    <?php endif; ?>
    <form action="" class="form-horizontal" method="post">
        <div class="form-group">
            <label for="" class="label-form control-label"><strong>Nom de la candidate</strong>
                <hr class="l-show">
            </label>
            <div class="input-form">
                <input type="text" class="form-control" name="nom" value="<?php if(!isset($this->messages['nom'])): echo $this->last_name; else: echo $this->data['nom']; endif; ?>" required="required">
                <?php if(isset($this->messages['nom'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['nom']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Prenom de la candidate :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="prenom" value="<?php if(!isset($this->messages['prenom'])): echo $this->first_name; else: echo $this->data['prenom']; endif; ?>" required="required">
                <?php if(isset($this->messages['prenom'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['prenom']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Date de naissance :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" id="datepickerbirth" name="dateNais" required="required" value="<?php if(isset($this->data['dateNais'])) echo $this->data['dateNais'];?>">
                            <span class="help-block <?php if(!isset($this->messages['dateNais_Age']) && !isset($this->messages['dateNais'])){?>hidden <?php }else{ ?>  help-danger <?php } ?>" id="info-birth">
                                <?php if(isset($this->messages['dateNais_Age'])): ?>
                                    <?php echo $this->messages['dateNais_Age']; ?>
                                <?php endif; ?>
                                <?php if(isset($this->messages['dateNais'])): ?>
                                    <?php echo $this->messages['dateNais']; ?>
                                <?php endif; ?>
                            </span>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Lieu de naissance :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="lieuNais" required="required" value="<?php if(isset($this->data['lieuNais'])) echo $this->data['lieuNais'];?>">
                <?php if(isset($this->messages['lieuNais'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['lieuNais']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Nationalité :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="nationalite" required="required" value="<?php if(isset($this->data['nationalite'])) echo $this->data['nationalite'];?>">
                <?php if(isset($this->messages['nationalite'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['nationalite']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Quartier de résidence :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="adresse" required="required" value="<?php if(isset($this->data['adresse'])) echo $this->data['adresse'];?>">
                <?php if(isset($this->messages['adresse'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['adresse']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Ville de la candidate :</strong>
                <hr/></label>
            <div class="input-form">
                <select class="form-control" name="ville" required="required">
                    <option value="">Selectionne ta ville</option>
                    <?php foreach ($this->ville as $ville):?>
                        <option value="<?= $ville['id'] ?>" <?php if(isset($this->data['ville']) && $this->data['ville'] == $ville['id']): ?> selected <?php endif; ?>><?= $ville['ville']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($this->messages['ville'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['ville']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Tel. Portable :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="phone" required="required" value="<?php if(isset($this->data['phone'])) echo $this->data['phone'];?>">
                <?php if(isset($this->messages['phone'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['phone']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php if(empty($this->email)) :?>
            <div class="form-group">
                <label class="label-form control-label"> <strong>Adresse émail :</strong>
                    <hr/></label>
                <div class="input-form">
                    <input type="email" class="form-control" placeholder="de préférence celle de votre compte facebook" name="email" required="required" value="<?php if(isset($this->data['email'])) echo $this->data['email'];?>">
                    <?php if(isset($this->messages['email'])): ?>
                        <span class="help-block help-danger"><?php echo $this->messages['email']; ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="email" value="<?php echo $this->email; ?>"/>
        <?php endif; ?>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Profession ou études en cours :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="profession" required="required" value="<?php if(isset($this->data['profession'])) echo $this->data['profession'];?>">
                <?php if(isset($this->messages['profession'])): ?>
                    <span class="help-block help-danger" ><?php echo $this->messages['profession']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"> <strong>Dernier diplome obtenue :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="diplome" required="required" value="<?php if(isset($this->data['diplome'])) echo $this->data['diplome'];?>">
                <?php if(isset($this->messages['diplome'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['diplome']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"><strong> Si vous êtes élue Miss Orangina, quel serait votre rêve ? :</strong>
                <br/>
                <hr/></label>
            <div class="input-form">
                <textarea name="dream" id="" cols="20" rows="5" class="form-control" placeholder="" maxlength="255" required="required"><?php if(isset($this->data['dream'])) echo $this->data['dream'];?></textarea>
                <?php if(isset($this->messages['dream'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['dream']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"><strong> Quelle est votre ambition dans la vie ?  :</strong>
                <br/>
                <hr/></label>
            <div class="input-form">
                <textarea name="ambition" id="" cols="20" rows="5" class="form-control" placeholder="" maxlength="255" required="required"><?php if(isset($this->data['ambition'])) echo $this->data['ambition'];?></textarea>
                <?php if(isset($this->messages['ambition'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['ambition']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="label-form control-label"><strong> Quels sont vos loisirs ? :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="loisir" required="required" value="<?php if(isset($this->data['loisir'])) echo $this->data['loisir'];?>">
                <?php if(isset($this->messages['loisir'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['loisir']; ?></span>
                <?php endif; ?>

            </div>
        </div>

        <div class="form-group">
            <label class="label-form control-label"><strong> Avez-vous déjà participé à un concours de beauté ? Si oui, à quelle occasion</strong>
                <br/>
                <hr/>
            </label>
            <div class="input-form">
                <textarea name="concours" id="" cols="20" rows="5" class="form-control" required="required" maxlength="500" placeholder="maximum 500 caracteres"><?php if(isset($this->data['concours'])) echo $this->data['concours'];?></textarea>
                <?php if(isset($this->messages['concours'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['concours']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label class="label-form control-label"><strong> Taille sans talons (en cm) :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="text" class="form-control" name="taille" required="required" value="<?php if(isset($this->data['taille'])) echo $this->data['taille'];?>">
                <?php if(isset($this->messages['taille'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['taille']; ?></span>
                <?php endif; ?>

            </div>
        </div>

        <div class="form-group">
            <label class="label-form control-label"><strong> Citez 03 de vos qualités :</strong>
                <br/>
                <hr/>
            </label>
            <div class="input-form">
                <textarea name="qualite" id="" cols="20" rows="5" class="form-control" required="required" maxlength="200" placeholder="maximum 255 caracteres"><?php if(isset($this->data['qualite'])) echo $this->data['qualite'];?></textarea>
                <?php if(isset($this->messages['qualite'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['qualite']; ?></span>
                <?php endif; ?>
            </div>
            <br/>
        </div>
        <div class="form-group">
            <label class="label-form control-label"><strong> Combien d’enfant (s) avez-vous ? :</strong>
                <hr/></label>
            <div class="input-form">
                <input type="number" class="form-control" name="enfant" required="required" min="0" value="<?php if(isset($this->data['enfant'])) echo $this->data['enfant'];?>">
                <?php if(isset($this->messages['enfant'])): ?>
                    <span class="help-block help-danger"><?php echo $this->messages['enfant']; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox" style="font-size: 17px;">
                <label>
                            <span class="checkbox-form">
                                <input type="checkbox" id="regle" required="required">
                                Je confirme que j'ai bien lu  <a href="<?php echo get_site_url()."/reglement"; ?>" target="_blank" id="col" class="link">le règlement du concours miss orangina 2015 </a> et je l'accepte en toute bonne conscience
                            </span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox" style="font-size: 17px;">
                <label>
                            <span class="checkbox-form">
                                <input type="checkbox" id="deont" required="required">
                                Je reconnais aussi avoir fourni les informations exactes me concernant
                            </span>
                </label>
            </div>
        </div>
        <div class="alert alert-danger hidden">
            <h4>Certaines informations n'ont pas été renseignées</h4>
        </div>
        <div class="form-group">
            <div class="input-form input-button">
                <?php wp_nonce_field("inscription", "nonce"); ?>
                <input type="hidden" name="idfacebook" value="<?php echo $this->id; ?>"/>
                <button type="submit" class="btn btn-contact btn-form disabled" id="submit">Poursuivre votre inscription</button>
            </div>
        </div>
    </form>
</div>

<script src="<?= plugins_url( 'assets/js/inputmask.js', PLUGINS_DIR_CURRENT ); ?>" type="text/javascript"></script>
<script src="<?= plugins_url( 'assets/js/jquery.inputmask.js', PLUGINS_DIR_CURRENT ); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?= plugins_url( 'assets/js/jquery.inputmask.bundle.min.js', PLUGINS_DIR_CURRENT ); ?>"></script>
<script>

    $(document).ready(function() {



        $('#datepickerbirth').on('change', function(){
            MyAge();
        });


        $('#datepickerbirth').inputmask("date", { placeholder:"__/__/____"});

        $("#deont, #regle").on('click', function(){
            if($("#deont").is(':checked') && $("#regle").is(':checked') ){
                var $vide = false;
//                $('input[type="text"], textarea').each(function(){
//                    if($.trim($(this).val()) == ''){
//                       $vide = true;
//                    }
//                });

                if($vide == false){
                    $("#submit").removeClass('disabled');
                    $('.alert').addClass('hidden');
                    MyAge();
                }else{
                        $('.alert').removeClass('hidden');
                        $("#submit").addClass('disabled');
                }

            }else{
                $("#submit").addClass('disabled');
                $('.alert').addClass('hidden');
            }
        });

        if($("#deont").is(':checked') && $("#regle").is(':checked') ){
            var $vide = false;
//                $('input[type="text"], textarea').each(function(){
//                    if($.trim($(this).val()) == ''){
//                       $vide = true;
//                    }
//                });

            if($vide == false){
                $("#submit").removeClass('disabled');
                $('.alert').addClass('hidden');
                MyAge();
            }else{
                $('.alert').removeClass('hidden');
                $("#submit").addClass('disabled');
            }

        }else{
            $("#submit").addClass('disabled');
            $('.alert').addClass('hidden');
        }

//
//        $('input[type="text"], textarea').on('change', function(){
//            if($("#deont").is(':checked') && $("#regle").is(':checked') ){
//                var $vide = false;
//                $('input[type="text"], textarea').each(function(){
//                    if($.trim($(this).val()) == ''){
//                        $vide = true;
//                    }
//                });
//
//                if($vide == false){
//                    $("#submit").removeClass('disabled');
//
//                    $('.alert').addClass('hidden');
//                    MyAge();
//                }else{
//                    $('.alert').removeClass('hidden');
//                    $("#submit").addClass('disabled');
//                }
//
//            }else{
//                $("#submit").addClass('disabled');
//                $('.alert').addClass('hidden');
//            }
//        });



    });

    function MyAge(){
        // on calcul l'âge
        var maintenant = new Date();
        var dateNais = $('#datepickerbirth').val();
        var data = dateNais.split('/');
        var maDateNaissance = new Date(data[2],data[1]-1,data[0]);
        var monAge = maintenant.getFullYear() - maDateNaissance.getFullYear();

        if (maDateNaissance.getMonth()>maintenant.getMonth()) {
            monAge+=1;
        } else if (maintenant.getMonth()==maDateNaissance.getMonth() && maDateNaissance.getDate()>=maintenant.getDate()) {
            monAge+=1;
        }

        if(monAge >= 18 && monAge <= 25){
            $('#info-birth').removeClass('hidden');
            $('#info-birth').addClass('help-success');
            $('#info-birth').removeClass('help-danger');
            $('#info-birth').text('Vous êtes éligible.');

        }else{
            $('#info-birth').removeClass('hidden');
            $('#info-birth').addClass('help-danger');
            $('#info-birth').removeClass('help-success');
            $('#info-birth').text('Vous n\'êtes pas éligible.');
            $("#submit").addClass('disabled');
        }
    }




</script>