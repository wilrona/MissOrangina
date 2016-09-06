<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 18:28
 */
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sandbox.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animsition.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-datepicker.css">
<style>
    .bg-yellow1 {
        background-image: url(<?php echo get_template_directory_uri(); ?>/img/Orangina-4x3m-Axe-1_02-Sans.jpg);
        height: 1200px !important;
        background-size: cover;
        position: absolute;
        bottom: 0;
        top: 255px;
        left: 0;
        right: 0;
    }

    .bg-yellow1 input{
        color: #000;
    }

    .owl-prev.disabled, .owl-prev.disabled:hover, .owl-next.disabled, .owl-next.disabled:hover{
        opacity: 0.5 !important;
    }
    .owl-prev.disabled, .owl-prev.disabled:hover, .owl-prev, .owl-prev:hover, .owl-next.disabled, .owl-next.disabled:hover, .owl-next, .owl-next:hover{
        background: #fed100 !important;
        color: #000 !important;
        font-size: 20px !important;
        border-radius: 10px !important;
        border: #fed100 !important;
    }

</style>

<div class="animsition item bg-yellow" data-animsition-in="fade-in-up-sm" data-animsition-out="fade-out-up-sm" data-animsition-in-duration="2000">
    <h1 id="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Miss orangina"/> </h1>
</div>


<div class="animsition item3 bg-yellow1" data-animsition-in="fade-in-down-sm" data-animsition-out="fade-out-down-sm" data-animsition-in-duration="3000">
    <h1 id="logo">2. Mets tes <span id="col">informations</span> &agrave; jour </h1>

    <div id="logo" class="container">
        <div class="alert alert-danger hidden">
            <h3>Certaines informations n'ont pas ete renseignees</h3>
        </div>
        <form class="form-horizontal" action="<?= $this->url_for('inscription/submit'); ?>" method="post">
            <div id="owl-demo" class="owl-carousel owl-theme text1">

            <div class="item view" id="1">
                    <h1>Etape 1</h1>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Nom de la candidate :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="nom" value="<?php echo $this->last_name; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Prenom de la candidate :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="prenom" value="<?php echo $this->first_name; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Date de naissance :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="datepickerbirth" name="dateNais">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Lieu de naissance :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="lieuNais">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Nationalite de la candidate :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="nationalite">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Adresse de la candidate :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="adresse">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Ville de la candidate :
                            <hr/></label>
                        <div class="col-lg-8">
                            <select class="form-control" name="ville">
                                <option value="">Selectionne ta ville</option>
                                <option value="Dla">Douala</option>
                                <option value="Dde">Yaounde</option>
                                <option value="Baf">Bafoussam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Boite postale :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="bp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Numero telephone :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="phone">
                        </div>
                    </div>

                </div>
            <div class="item" id="2">

                    <h1>Etape 2</h1>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Avez vous un compte Facebook, ou un compte Twitter ? Si oui, à quelle adresse ?
                            <br/>
                            <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                            <hr/></label>
                        <div class="col-lg-8">
                            <textarea name="" id="tweeter" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Profession ou études en cours :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="profession">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Quel est votre dernier diplôme obtenu :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="diplome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Si vous étiez élue Miss Orangina, quel serait votre rêve ?
                            <br/>
                            <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                            <hr/></label>
                        <div class="col-lg-8">
                            <textarea name="reve" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Intervenez-vous auprès d'une association caritative, si oui laquelle ?
                            <br/>
                            <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                            <hr/></label>
                        <div class="col-lg-8">
                            <textarea name="association" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Votre ambition dans la vie ?
                            <br/>
                            <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                            <hr/></label>
                        <div class="col-lg-8">
                            <textarea name="ambition" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
            <div class="item" id="3">
                    <h1>Etape 3</h1>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Langues étrangères parlées et niveau :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="langue">

                            <span class="help-block" style=" text-align:left !important; color:#000 !important;background-color: #f0ad4e; padding: 3px; font-size: 13px;">separer par une virgule</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Avez-vous déjà voyagé ? Si oui, dans quel(s) pays ?
                            <br/>
                            <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                            <hr/></label>
                        <div class="col-lg-8">
                            <textarea name="voyage" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Vos Loisirs :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="loisir">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Les sports pratiqués :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="sport">
                            <span class="help-block" style=" text-align:left !important; color:#000 !important;background-color: #f0ad4e; padding: 3px; font-size: 13px;">separer par une virgule</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Vos goûts musicaux  :
                            <hr/></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="likemusic">
                            <span class="help-block" style=" text-align:left !important; color:#000 !important;background-color: #f0ad4e; padding: 3px; font-size: 13px;">separer par une virgule</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Jouez-vous d'un instrument de musique ? Si oui, lequel, depuis combien de temps ?
                            <br/>
                            <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                            <hr/></label>
                        <div class="col-lg-8">
                            <textarea name="instrument" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Avez-vous déjà participé à un concours de beauté ?
                            <br/>
                            <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                            <hr/></label>
                        <div class="col-lg-8">
                            <textarea name="autreparti" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
            <div class="item" id="4">
                <h1>Etape 4</h1>
                <hr/>
                <div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Etes vous inscrite dans une agence de mannequin, si oui, laquelle ?
                        <br/>
                        <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                        <hr/>
                    </label>
                    <div class="col-lg-8">
                        <textarea name="agence" id="" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Couleur de pointrine  :
                        <hr/>
                    </label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="poitrine">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Taille confection  :
                        <hr/>
                    </label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="taille">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Pointure  :
                        <hr/>
                    </label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="pointure">
                    </div>
                </div><div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Couleur des yeux  :
                        <hr/></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="yeux">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Couleur des cheveux  :
                        <hr/></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="cheveux">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;"> Portez-vous des extensions/tissage ?
                        <br/>
                        <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                        <hr/>
                    </label>
                    <div class="col-lg-8">
                        <textarea name="extension" id="" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="item" id="5">
                <h1>Etape 5</h1>
                <hr/>
                <div class="form-group">
                    <label class="col-lg-4 control-label" style="text-align: left !important; font-size: 20px !important;">
                        Citez 3 qualités vous concernant
                        <br/>
                        <span class="help-block" style="color:#d9534f !important; background-color: #fff; padding: 5px; font-size: 13px;">A block of help.</span>
                        <hr/>
                    </label>
                    <div class="col-lg-8">
                        <textarea name="qualite" id="" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" id="regle">
                            J&#39;accepte le <a href="#" target="_blank" id="col">r&egrave;glement du concours Miss Orangina </a>
                        </label>
                    </div>
                </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="" id="deont">
                                J&#39;accepte de respecter la <a href="#" target="_blank" id="col">Charte de d&eacute;ontologie du concours Miss Orangina </a>
                            </label>
                        </div>
                    </div>
                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-10">
                        <?php wp_nonce_field("inscription", "nonce"); ?>
                        <input type="hidden" name="email" value="<?php echo $this->email; ?>"/>
                        <input type="hidden" name="idfacebook" value="<?php echo $this->id; ?>"/>
                        <button type="submit" class="btn btn-default " id="submit">Poursuivre votre inscription</button>
                    </div>
                </div>

            </div>




            </div>
        </form>


</div>



<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.animsition.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/inputmask.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.inputmask.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.inputmask.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var $animsition = $('.animsition');
        $animsition
            .animsition()
            .one('animsition.start',function(){
                $(this).append('');
                console.log('');
            })
            .one('animsition.end',function(){
                $('.target', this).html('');
                console.log('');
            });

        $("#owl-demo").owlCarousel({
            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
            pagination: false,
                singleItem:true,
            autoPlay:false,
            navigationText : ["Etape precedente","Etape suivante"],
            rewindNav : false,
            scrollPerPage : false,
            autoHeight : true
        });

        $('#datepickerbirth').inputmask("date", { placeholder:"__/__/____"});

        if($(".owl-prev").hasClass("disabled")){
            $(".owl-prev").addClass("hidden");
        }

        $("#owl-demo .owl-next").on('click', function(){
            if($("#owl-demo .owl-prev").hasClass("hidden")){
                $("#owl-demo .owl-prev").removeClass("hidden");
            }
        });

        $("#owl-demo .owl-prev").on('click', function(){
            if($("#owl-demo .owl-next").hasClass("hidden")){
                $("#owl-demo .owl-next").removeClass("hidden");
            }
        });

        $("#owl-demo .owl-prev").on('click', function(){
            if($("#owl-demo .owl-prev").hasClass("disabled")){
                $("#owl-demo .owl-prev").addClass("hidden");
            }
        });

        $("#owl-demo .owl-next").on('click', function(){
            if($("#owl-demo .owl-next").hasClass("disabled")){
                $("#owl-demo .owl-next").addClass("hidden");
            }
        });

//        $("#deont,#regle").on('click', function(){
//
//            if($("#deont").is(':checked') && $("#regle").is(':checked') ){
//                var $vide = false;
//                $('input[type="text"], textarea').each(function(){
//                    if($.trim($(this).val()) == ''){
//                       $vide = true;
//                    }
//                });
//
//                if($vide == false){
//                        $("#submit").removeClass('disabled');
//                        $('.alert').addClass('hidden');
//                }else{
//                        $('.alert').removeClass('hidden');
//                        $("#submit").addClass('disabled');
//                }
//
//            }else{
//                $("#submit").addClass('disabled');
//                $('.alert').addClass('hidden');
//            }
//        });
//
//        $('input[type="text"], textarea').on('change', function(){
//
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
//                    $('.alert').addClass('hidden');
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
//
    });





</script>