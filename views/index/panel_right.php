<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5&appId=1186368814711610";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<?php //if($this->current_etape->etape >= 2 && !empty($this->lieu)): ?>
<!--<h2 class="h2">Lieu des selections</h2>-->
<!--<div style="border-top:1px solid #e3e3e3; padding-top: 15px;">-->
<!--    <ul class="media-list">-->
<!--        --><?php //if(!empty($this->lieu)):
//            foreach($this->lieu as $lieu):
//                    ?>
<!--                    <li class="media" style="padding:10px; background:#e3e3e3;">-->
<!--                        <div class="media-body">-->
<!--                            <h4 class="media-heading">--><?php //echo $lieu['lieu'] ?><!-- à-->
<!--                                --><?php
//                                foreach ($this->villes as $ville) {
//                                    if($ville['id'] == $lieu['ville']){
//                                        echo $ville['ville'];
//                                    }
//                                }
//                                ?>
<!--                            </h4>-->
<!--                            --><?php //echo $lieu['datelieu']; if(!empty($lieu['heure'])):  ?><!-- à partir de --><?php //echo $lieu['heure']; endif; ?>
<!---->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                    <hr>-->
<!--                --><?php
//                endforeach;
//        endif; ?>
<!--    </ul>-->
<!--</div>-->
<?php //endif; ?>

<h2 class="h2">Nos vidéos</h2>
<div>
    <?php  echo do_shortcode('[yt4wp-playlist playlist_id="PLrnelROL6oze04SCpZX3kbQACkJQUAiSR"]'); ?>
</div>
<!--<div class="video">-->
<!--    <i class="fa fa-play icon"></i>-->
<!--</div>-->
<hr/>
<h2 class="h2">Retrouvez-nous sur Facebook</h2>
<p>
<div class="fb-page" data-href="https://www.facebook.com/MissOranginaLaPage" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/orangina"><a href="https://www.facebook.com/orangina">Orangina</a></blockquote></div></div>
</p>
    