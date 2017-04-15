

                    <footer class="footer-site">
                        <div class="l-container-footer">
                            <div class="lady">

                            </div>
                            <div class="slogan">
                                <img src="<?= plugins_url( 'assets/img/slogan.png', PLUGINS_DIR_CURRENT ); ?>" class="aligncenter" alt="">
                            </div>
                            <div class="formulaire">

                                <hr class="s-show">
                                <form action="<?php echo get_site_url()."/contact"; ?>" method="post">
                                    <h3>LAISSEZ UN MESSAGE</h3>
                                    <div class="form-control">
                                        <input type="text" name="name" placeholder="Votre nom">
                                    </div>
                                    <div class="form-control">
                                        <input type="text" name="email" placeholder="Votre adresse mail">
                                    </div>
                                    <div class="form-control">
                                        <textarea name="message" id="" cols="30" rows="10"  placeholder="Votre message"></textarea>
                                    </div>
                                    <div class="form-control clearfix">
                                        <?php wp_nonce_field("contact", "nonce"); ?>
                                        <button type="submit" class="btn btn-contact pull-right">ENVOYER</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr style="margin:0;">
                        <div class="foot">
                            <ul class="ul-list-inline">
                                <li>All Copyrights Reserved |</li>
                                <li>2017 |</li>
                                <li><a href="http://www.accentcom.agency/" style="color: #fff; font-family: 'Verdana', Georgia, serif;" target="_blank">Accent Com</a></li>
                            </ul>
                            <br>
                        </div>
                    </footer>

                </div>
                <div class="site-cache"></div>
            </div>
        </div>


<!--                <!-- Modal HTML -->
<!--                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<!--                    <div class="modal-dialog">-->
<!--                        <div class="modal-content">-->
<!--                            <div class="modal-header">-->
<!--                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<!--                                <h1 class="modal-title">Nous suivre sur les reseaux sociaux</h1>-->
<!--                            </div>-->
<!--                            <div class="modal-body">-->
<!--                                ...-->
<!--                            </div>-->
<!--                            <div class="modal-footer">-->
<!--                                <button type="button" class="btn" data-dismiss="modal">Fermee</button>-->
<!--                            </div>-->
<!--                        </div><!-- /.modal-content -->
<!--                    </div><!-- /.modal-dialog -->
<!--                </div><!-- /.modal -->

        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
        <script src="<?= plugins_url( 'assets/js/bootstrap.min.js', PLUGINS_DIR_CURRENT ); ?>" type="text/javascript"></script>

<!--        <script type="text/javascript" src="--><?//= plugins_url( 'assets/js/jssor.slider-20.min.js', PLUGINS_DIR_CURRENT ); ?><!--"></script>-->
        <script type="text/javascript" src="<?= plugins_url( 'assets/js/tabs.js', PLUGINS_DIR_CURRENT ); ?>"></script>
        <!-- use jssor.slider-20.debug.js instead for debug -->
<!--        <script type="text/javascript" src="--><?//= plugins_url( 'assets/js/jssor.js', PLUGINS_DIR_CURRENT ); ?><!--"></script>-->
        <script type="text/javascript" src="<?= plugins_url( 'assets/js/app.js', PLUGINS_DIR_CURRENT ); ?>"></script>
    </body>
</html>