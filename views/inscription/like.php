<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 14/09/2015
 * Time: 15:32
 */
?>

<!--<div id="fb-root"></div>-->
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.4&appId=882839271744044";
        fjs.parentNode.insertBefore(js, fjs);

        if($('.pluginConnectButtonDisconnected').hasClass('hidden_elem')){
            alert('ok');
        }
    }(document, 'script', 'facebook-jssdk'));
</script>

<div class="page-header">
    <div class="l-container">
        <h1>Page officiel orangina cameroun</h1>

    </div>
</div>

<div class="l-container l-container-page" style="text-align: center">

        <h2 class="h2"> Like la page officielle d 'orangina cameroun sur facebook </h2>
        <div class="concept clearfix" style="text-align: center; background: none;">
            <div class="fb-page" data-href="https://www.facebook.com/orangina" data-width="400" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/orangina"><a href="https://www.facebook.com/orangina">Orangina</a></blockquote></div></div>

        </div>
        <br/>
        <div style="text-align: center;">
            <a href="<?php echo get_site_url()."/inscription/form"; ?>" class="btn btn-contact" style="padding: 20px;"> <h2 style="margin-bottom: 0;">Suivre</h2></a>
        </div>

</div>
